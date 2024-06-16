<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Follow;
use App\Models\Category;
use App\Models\Todo;

class FollowController extends Controller
{
    public function follow(Request $request,Follow $follow,User $user,Category $category,Todo $todo,Post $post) {
        $followee=$request->user_id;
        
        $user_id = \Auth::id();
        $user->followee()->attach($user_id);
        return redirect()->back();
        // return redirect("/posts/$category->id");
        // return redirect(route('category.index', ['category' => $category->id,]));//$categoryの部分が暗黙の結合によって格納されるパラメータ
    }

    public function unfollow(User $user,Follow $follow,Category $category,Todo $todo) {
        
        
        $user_id = \Auth::id();
        $user->followee()->detach($user_id);
        return redirect()->back();
        // return redirect("/posts/$category->id");
        
        // return redirect(route('category.index', ['category' => $category->id,]));
    }
}
