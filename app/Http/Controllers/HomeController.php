<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Todo;


class HomeController extends Controller
{
    public function home(Category $category,Todo $todo)
    {
        $user = \Auth::user();
        $todo = Todo::where('user_id', $user->id)->get();  // user_idが自分のtodoを全部取得
        $category =Category::all();  // カテゴリーテーブルにあるものすべて取得
     
        
        
        return view('home.home')->with([
            'user' => $user,
            'usersposts' => $user->posts(),
            'categories' => $category,
            'todos' => $todo
            ]);
    }
    
    
}