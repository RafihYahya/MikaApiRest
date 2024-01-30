<?php

use App\Http\Controllers\PostActionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CheckAuthUserController;
use App\Http\Controllers\ReturnAuthUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class,'login']);
Route::post('/register', [AuthController::class,'register']);
Route::post('/logout', [AuthController::class,'logout']);
Route::get('/post/{id}', [PostsController::class,'show']);
Route::get('/posts/{name}', [PostsController::class,'showAllWhere']);


//PROTECTED ROUTES 
/////////////////////////////////////////////////////////////////////////////////////////

Route::middleware('auth:sanctum')->post('/post/create', [PostsController::class,'create']);
Route::middleware('auth:sanctum')->get('/whoami', [ReturnAuthUserController::class,'index']);
Route::middleware('auth:sanctum')->get('/posts', [PostsController::class,'showAll']);



Route::middleware('auth:sanctum')->get('/alllikedposts', [PostsController::class,'showAllAuthUserLikedPost']);
Route::middleware('auth:sanctum')->get('/alldislikedposts', [PostsController::class,'showAllAuthUserDisLikedPost']);
Route::middleware('auth:sanctum')->get('/alllovedposts', [PostsController::class,'showAllAuthUserLovedPost']);



Route::middleware('auth:sanctum')->delete('/post/delete/{id}',[PostsController::class,'deleteSingletonPost']);
Route::middleware('auth:sanctum')->put('/post/update/{id}',[PostsController::class,'updateSingletonPost']);



Route::middleware('auth:sanctum')->post('/post/like/{postId}',[PostActionController::class,'AddLikeToPost']);
Route::middleware('auth:sanctum')->delete('/post/removelike/{postId}',[PostActionController::class,'RemoveLikeFromPost']);

Route::middleware('auth:sanctum')->post('/post/dislike/{postId}',[PostActionController::class,'AddDisLikeToPost']);
Route::middleware('auth:sanctum')->post('/post/love/{postId}',[PostActionController::class,'AddLoveToPost']);
Route::middleware('auth:sanctum')->post('/post/comment/{postId}',[PostActionController::class,'AddCommentToPost']);




