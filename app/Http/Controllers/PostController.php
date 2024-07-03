<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostRequest; 
use App\Models\Category;


class PostController extends Controller
{
    public function index(Post $post)
    {
        $loginuser=\Auth::user();
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit(),'loginUser'=>$loginuser]);
    }
    
    public function category1(Category $category)
    {
        $loginuser=\Auth::user();
        return view('posts.category1')->with(['posts' => $category->getPaginateByLimit(),'loginUser'=>$loginuser]);//Categoryモデルをインスタンス化してcategory_idごとに投稿を取得する処理を変数postsに入れる
    }

    public function show(Post $post)
    {
        return view('posts.show')->with(['post' => $post]);
    }


    public function create(Category $category)
    {
        
        return view('posts.create')->with(['categories' => $category->get()]);
    }

    public function store(Post $post, PostRequest $request,Category $category)
    {
        $input = $request['post'];
        $input['user_id']= auth()->user()->id;
        $input += ['user_id' => $request->user()->id];
        $post->fill($input)->save();
        return redirect('/posts/' .$input['category_id']);
    }
    
    public function edit(Post $post)
    {
        return view('posts.edit')->with(['post' => $post]);
    }
    public function update(Request $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
    
        return redirect()->back();
    }
    public function delete(Post $post)
    {
        $post->delete();
        
        return redirect()->back();
    }
}