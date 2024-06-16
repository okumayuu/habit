<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Todo;




class TodoController extends Controller
{
    public function store(Request $request, Todo $todo)
    {
        
        $user_id = auth()->user()->id;
        $input = $request['todo'];
        
        $input['user_id'] = $user_id;
        $todo->fill($input)->save();
        
        return redirect('/');
    }
    
    public function delete(Todo $todo)
    {
        $todo->delete();
        
        return redirect('/');
    }
}