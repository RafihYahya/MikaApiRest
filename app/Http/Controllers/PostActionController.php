<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Love;
use App\Models\Post;
use App\Models\Dislike;
use App\Models\Postcomments;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;

class PostActionController extends Controller
{
    use HttpResponses;
    public function AddLikeToPost($postId)
    {
        $like3 = Post::where([
            "id" => intval($postId),
        ])->first();


        if (!empty($like3)) {
            $like2 = Like::where([
                "user_id" => Auth::user()->id,
                "post_id" => intval($postId),
            ])->first();
            if ($like2) {
                return $this->Err("Already Liked This Post", 403);
            }
            $like = Like::create([
                "user_id" => Auth::user()->id,
                "post_id" => intval($postId),
            ]);
            return $this->Ok([
                "like" => $like,
            ]);

        } else {
            return $this->Err("Post Doesn't Exist", 403);
        }


    }

    public function RemoveLikeFromPost($postId)
    {
        $like = Like::where([
            "post_id" => $postId,
            "user_id" => Auth::user()->id
        ]);
        if (empty($like)) {
            $like->delete();
            return $this->Ok([
                "post_id" => $postId,
                "user" => Auth::user()->id
            ]);
        } else {
            return $this->Err(
                "No Like To Remove",
                403
            );
        }
    }
    public function AddDisLikeToPost($postId)
    {
        $dislike3 = Post::where([
            "id" => intval($postId),
        ])->first();
        if (!empty($dislike3)) {
            $dislike2 = Dislike::where([
                "user_id" => Auth::user()->id,
                "post_id" => intval($postId),
            ])->first();
            if ($dislike2) {
                return $this->Err("Already Disliked This Post", 403);
            }
            $dislike = Dislike::create([
                "user_id" => Auth::user()->id,
                "post_id" => intval($postId),
            ]);
            return $this->Ok([
                "like" => $dislike,
            ]);

        } else {
            return $this->Err("Post Doesn't Exist", 403);
        }
    }
    public function AddLoveToPost($postId)
    {
        $love3 = Post::where([
            "id" => intval($postId),
        ])->first();



        if (!empty($love3)) {
            $love2 = Love::where([
                "user_id" => Auth::user()->id,
                "post_id" => intval($postId),
            ])->first();
            if ($love2) {
                return $this->Err("Already Loved This Post", 403);
            }
            $love = Love::create([
                "user_id" => Auth::user()->id,
                "post_id" => intval($postId),
            ]);
            return $this->Ok([
                "like" => $love,
            ]);

        } else {
            return $this->Err("Post Doesn't Exist", 403);
        }
    }
    public function AddCommentToPost($postId, Request $request)
    {
        $comment2 = Post::where([
            "id" => intval($postId),
        ])->first();

        if (!empty($comment2)) {

            $comment = Postcomments::create([
                "user_id" => Auth::user()->id,
                "comment" => $request->body,
                "post_id" => intval($postId),
            ]);
            return $this->Ok([
                "like" => $comment,
            ]);

        } else {
            return $this->Err("Post Doesn't Exist", 403);
        }
    }
}
