<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
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
        $post = Post::where("id", $id)->first();
        if (is_null($post)) {
            return $this->Err("No Post With Such Id Exist", 405);
        } else {
           return  $this->Ok([
                "post" => $post,
            ]);
        }
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
    public function showAll()
    {
        $post = Post::all()->where("user_id", Auth::user()->id);
        return $this->Ok([
            "post" => $post,
            "owner" => Auth::user()->name
        ]);
    }
    public function showAllWhere(string $name)
    {
        $user = User::where("name", $name)->first();
        if (is_null($user)) {
            return $this->Err("Name Doesn't Exist. Try Another One", 405);
        } else {
            $post = Post::all()->where("user_id", $user->id);
            return $this->Ok([
                "post" => $post,
                "owner" => $user->name
            ]);
        }
    }
}
