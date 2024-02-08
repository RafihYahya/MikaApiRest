<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Love;
use App\Models\Post;
use App\Models\User;
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

            $user = User::where(["id" => $like->user_id])->first();
            $user->likeNum = ($user->likeNum) + 1;
            
            $post = Post::where(["id" => $like->post_id])->first();
            $post->likeNum = ($post->likeNum) + 1;


            $user->save();
            $post->save();

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
        ])->first();
        if (!empty($like)) {
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
    public function RemoveDislikeFromPost($postId)
    {
        $dislike = Dislike::where([
            "post_id" => $postId,
            "user_id" => Auth::user()->id
        ])->first();
        if (!empty($dislike)) {
            $dislike->delete();
            return $this->Ok([
                "post_id" => $postId,
                "user" => Auth::user()->id
            ]);
        } else {
            return $this->Err(
                "No Dislike To Remove",
                403
            );
        }
    }
    public function RemoveLoveFromPost($postId)
    {
        $love = Love::where([
            "post_id" => $postId,
            "user_id" => Auth::user()->id
        ])->first();
        if (!empty($love)) {
            $love->delete();
            return $this->Ok([
                "post_id" => $postId,
                "user" => Auth::user()->id
            ]);
        } else {
            return $this->Err(
                "No Love To Remove",
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

            $user = User::where(["id" => $dislike->user_id])->first();
            $user->dislike = ($user->dislikeNum) + 1;
            
            $post = Post::where(["id" => $dislike->post_id])->first();
            $post->dislike = ($post->dislikeNum) + 1;


            $user->save();
            $post->save();

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

            $user = User::where(["id" => $love->user_id])->first();
            $user->loveNum = ($user->loveNum) + 1;
            
            $post = Post::where(["id" => $love->post_id])->first();
            $post->loveNum = ($post->loveNum) + 1;


            $user->save();
            $post->save();

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

            $user = User::where(["id" => $comment->user_id])->first();
            $user->commentNum = ($user->commentNum) + 1;
            
            $post = Post::where(["id" => $comment->post_id])->first();
            $post->commentNum = ($post->commentNum) + 1;


            $user->save();
            $post->save();

            return $this->Ok([
                "like" => $comment,
            ]);

        } else {
            return $this->Err("Post Doesn't Exist", 403);
        }
    }
    public function RemoveCommentFromPost($postId)
    {
        $comment = Postcomments::where([
            "post_id" => $postId,
            "user_id" => Auth::user()->id
        ])->first();
        if (!empty($comment)) {
            $comment->delete();
            return $this->Ok([
                "post_id" => $postId,
                "body" => $comment->comment,
                "user" => Auth::user()->id
            ]);
        } else {
            return $this->Err(
                "No Comment To Remove",
                403
            );
        }
    }

    public function ShowAllActionsPost($postId)
    {

        $post = Post::where(["id" => $postId])->first();
        if (!empty($post)) {
            $likes = Like::all()->where("post_id", $postId);
            $dislikes = Dislike::all()->where("post_id", $postId);
            $loves = Love::all()->where("post_id", $postId);
            return $this->Ok([
                "Likes_Count" => $likes->count(),
                "Dislikes_Count" => $dislikes->count(),
                "Loves_Count" => $loves->count(),
                "Likes" => $likes,
                "Dislikes" => $dislikes,
                "Loves" => $loves,

            ]);
        } else {
            return $this->Err("No Post Found", 404);
        }
    }
}
