<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            "post" => ["required", "string"],
        ]);
        $post = Post::create([
            "user_id" => Auth::user()->id,
            "post" => $request->post,
        ]);
        return $this->Ok([
            "Post" => $post,
            "User" => $post->user_id
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::all()->where("id", $id)->first();
        return $this->Ok([
            "post" => $post,
            "user_id" => Auth::user()->id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
