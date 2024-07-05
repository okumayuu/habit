<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Post;

class LikeController extends Controller
{
    public function likePost(Post $post,Like $like)
    {
        $like->post_id = $post->id;
        $like->user_id = auth()->user()->id;
        $like->save();

        return back()->with(['post' => $post]);
    }

    public function unlikePost($post)
    {
        $like = Like::where('post_id', $post)->where('user_id', auth()->user()->id)->first();
        $like->delete();

        return back()->with(['post' => $post]);
    }
    
}
