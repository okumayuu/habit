<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostRequest; 
use App\Models\Category;
use App\Models\Todo;


class CategoryController extends Controller
{
    public function index(Category $category,Todo $todo)
    {
        $user=\Auth::user();
        $todo_user= Todo::where('user_id', $user->id)->get();
        
        return view('categories.index')->with(['posts' => $category->getByCategory(),'loginUser'=>$user,'todos'=>$todo->get(),'category_name'=>$category->name,'category_id'=>$category->id]);
    }

}