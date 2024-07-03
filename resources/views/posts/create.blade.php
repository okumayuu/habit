<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Habit</title>
    </head>
    <body style="text-align: center">
        <h1>投稿画面</h1>
        @if($target && $target->category_id == $category_id && $target->user_id == auth()->user()->id)
        <form action="/posts/{{$category_id}}" method="POST">
            @csrf
            <div class="title">
                <h2>Title</h2>
                <input type="text" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            <div class="body">
                <h2>Body</h2>
                <textarea name="post[body]" placeholder="今日も1日お疲れさまでした。">{{ old('post.body') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
            
            <div>
                <label>{{$category_name}}</label>
                    <select hidden name="post[category_id]">
                        
                        <option value="{{ $category_id }}">{{ $category_name }}</option>
                        
                    </select>
            </div>
            
            <input type="submit" value="保存"/>
        </form>
        @else
        <form action="/posts/{{$category_id}}/target" method="POST">
            @csrf
            <h2>Target</h2>
            <input type="text" name="target[target]" placeholder="目標設定" value="{{ old('target.target') }}"/>
            <p class="target__error" style="color:red">{{ $errors->first('target.target') }}</p>
            <div>
                <label>{{$category_name}}</label>
                    <select hidden name="target[category_id]">
                        
                        <option value="{{ $category_id }}">{{ $category_name }}</option>
                        
                    </select>
            </div>
            <input type="submit" value="保存"/>
        </form>
        @endif
        <div class="back">[<a href="/posts/{{$category_id}}">back</a>]</div>
    </body>
</html>