<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Post $post, Comment $comment)
    {
        $post->comments()->create([
            'comment' => $request->comment,
            'user_id' => auth()->id(),
        ]);
        return back();
    }
    
    public function delete(Comment $comment)
    {
        $comment->delete();
        return back()->with('message', 'コメントが削除されました。');
        
    }
}
