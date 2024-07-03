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
}
