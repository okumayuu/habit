<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Todo;
use App\Models\Target;
use App\Http\Requests\TargetRequest;

class TargetController extends Controller
{
    
    public function store(Target $target, TargetRequest $request, Category $category)
    {
        $input = $request['target'];
        $input['user_id'] = auth()->user()->id;
        $target->fill($input)->save();
        return redirect('/posts/' .$input['category_id']);
    }
    
    public function edit(Category $category, Todo $todo, Target $target)
    {
        $user = \Auth::user();
        $category_id = $category->id;
        
        // 指定されたユーザーとカテゴリに対応するターゲットを取得
        $target = Target::where('category_id', $category_id)->where('user_id', $user->id)->first();
        
        if (!$target) {
            // ターゲットが存在しない場合、デフォルトで新しいターゲットを作成
            $target = new Target();
            $target->category_id = $category_id;
            $target->user_id = $user->id;
            $target->target = '';  // デフォルト値
        }
    
        return view('targets.edit')->with([
            'loginUser' => $user,
            'todos' => $todo->get(),
            'category_name' => $category->name,
            'category_id' => $category_id,
            'target' => $target,
        ]);
    }

    
    
    public function update(Target $target, TargetRequest $request, Category $category)
    {
        $user = auth()->user();
        $category_id = $category->id;
    
        // 指定されたカテゴリとユーザーに関連するターゲットを取得または新規作成
        $target = Target::firstOrNew([
            'category_id' => $category_id,
            'user_id' => $user->id,
        ]);
    
        // フォームの入力をターゲットに適用
        $input = $request->input('target');
        $target->fill($input)->save();
    
        return redirect('/posts/' . $category_id)->with('status', '目標を更新しました！');
    }


}


