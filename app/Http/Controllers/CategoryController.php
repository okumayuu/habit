<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostRequest; 
use App\Models\Category;
use App\Models\Todo;
use App\Models\Target;


class CategoryController extends Controller
{
    public function index(Category $category,Todo $todo,Target $target)
    {
        $user = \Auth::user();
        $todo_user = Todo::where('user_id', $user->id)->get();
        $category_id = $category->id;
        $target = Target::where('category_id', $category_id)->where('user_id', $user->id)->first();
        return view('categories.index')->with([
            'posts' => $category->getByCategory(),
            'loginUser'=>$user,
            'todos'=>$todo->get(),
            'category_name'=>$category->name,
            'category_id'=>$category->id,
            'target_target'=>$target->target,
            ]);
    }
    
    public function create(Category $category,Todo $todo,Target $target)
    {
        $user = \Auth::user();
        $todo_user = Todo::where('user_id', $user->id)->get();
        $category_id = $category->id;
        $target = Target::where('category_id', $category_id)->where('user_id', $user->id)->first();
        $category_name = Category::find($category_id)->name;
        
        return view('posts.create')->with([
            'loginUser'=>$user,
            'todos'=>$todo->get(),
            'category_name'=>$category_name,
            'category_id'=>$category->id,
            'target'=>$target,
            ]);
    }
    
    public function store(Post $post, PostRequest $request,Category $category)
    {
        $input = $request['post'];
        $input['user_id']= auth()->user()->id;
        $input += ['user_id' => $request->user()->id];
        $post->fill($input)->save();
        return redirect('/posts/' .$input['category_id']);
    }

}