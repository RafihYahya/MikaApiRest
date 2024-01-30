<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Love;
use App\Models\Post;
use App\Models\User;
use App\Models\Dislike;
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
            return $this->Ok([
                "post" => $post,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateSingletonPost(string $id, Request $request)
    {
        $post2 = Post::where([
            "user_id" => Auth::user()->id,
            "id" => $id,
        ])->first();
        if ($post2) {
            $post2->post = $request->body;
            $post2->save();
            return $this->Ok([
                "post" => $post2,
            ]);

        } else {
            return $this->Err("This Post Doesn't Exist", 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteSingletonPost(string $id)
    {
        $post2 = Post::where([
            "user_id" => Auth::user()->id,
            "id" => $id,
        ])->first();

        if ($post2) {
            $post = Post::where([
                "id" => $id,
                "user_id" => Auth::user()->id,
            ])->delete();
            return $this->Ok([
                "post" => $post2,
            ]);
        } else {
            return $this->Err("Already Deleted This Post Or it never existed", 403);

        }

    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function showAll()
    {
        $post = Post::all()->where("user_id", Auth::user()->id);
        return $this->Ok([
            "post" => $post,
            "owner" => Auth::user()->name
        ]);
    }
    public function showAllAuthUserLikedPost()
    {
        $likedposts = Like::all()->where("user_id", Auth::user()->id);
        $postList = collect();
        foreach ($likedposts->pluck("post_id")->toArray() as $e) {
            $postList = $postList->push(Post::all()->where("id", $e));
        }
        return $this->Ok([
            "post" => $postList,
        ]);
    }
    public function showAllAuthUserDislikedPost()
    {
        $dislikedposts = Dislike::all()->where("user_id", Auth::user()->id);
        $postList = collect();
        foreach ($dislikedposts->pluck("post_id")->toArray() as $e) {
            $postList = $postList->push(Post::all()->where("id", $e));
        }
        return $this->Ok([
            "post" => $postList,
        ]);
    }
    public function showAllAuthUserLovedPost()
    {
        $lovedposts = Love::all()->where("user_id", Auth::user()->id);
        $postList = collect();
        foreach ($lovedposts->pluck("post_id")->toArray() as $e) {
            $postList = $postList->push(Post::all()->where("id", $e));
        }
        return $this->Ok([
            "post" => $postList,
        ]);
    }
    public function showAllAuthUserLovedUsers()
    {
        $lovedposts = Love::all()->where("user_id", Auth::user()->id);
        $userList = collect();
        foreach ($lovedposts->pluck("user_id")->toArray() as $e) {
            $postList = $postList->push(User::all()->where("id", $e));
        }
        return $this->Ok([
            "post" => $userList,
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
