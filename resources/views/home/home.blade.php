<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Habit</title>
        
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    </head>
    <body style="text-align: center">
        <h1>Habit</h1>
        
        <div class='categories'>
            @foreach($user->categories as $category)
                <a href='/posts/{{$category->id}}'>{{ $category->name }}</a>
            @endforeach
        </dev>
    
        
        
        
        
        
        <h3>Plofile</h3>
        <a href='/profile'>
            {{ Auth::user()->name }}
            <!--ログインユーザーのユーザー名表示-->
        </a>
        
        <h3>Todo</h3>
        <form action="/todo" method="post" class="mt-10">
          @csrf
            <label>
                <input placeholder="todo..." type="text" name="todo[todo]"/>
            </label>
            <div>
                <select name="todo[category_id]">
                    @foreach($user->categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" >追加する</button>
        </form>   
        <div>
            @foreach($todos as $todo)
                <p class=='todo'>{{ $todo->todo }}</p>
                <small class=='category'>{{ $todo->category->name }}</small>
                <form action="/delete/{{ $todo->id}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <button type='submit'>完了</button>
                </form>
            @endforeach
        </div> 
        
          
            
    
         
    </body>