<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Habit</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>
    <body style="text-align: center" class="antialiased">
        <h1>Habit</h1>
        <h3>{{ $category_name }}</h3>
        <a href='/posts/create'>create</a>
        <div class='posts'>
            @foreach($posts as $post)
            <div class='post'>
                <a href="/posts/{{ $post->id }}"><h2 class='title'>{{ $post->title }}</h2></a>
                <p class=='body'>{{ $post->body }}</p>
                <small class=='user'>{{ $post->user->name }}</small>
                
                @if($loginUser->id==$post->user_id)
                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost({{ $post->id }})">delete</button> 
                    </form>
                @else
                @endif
                
                @if($loginUser->id==$post->user_id)
                @else
                    @if($loginUser->isFollowing($post->user_id))
                        <form action={{"/unfollow/".$post->user_id}} id="form_{{ $post->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="user_id" value="{{ $post->user_id }}">
                            <button type="submit" >unfollow</button>
                        </form>
                    @else
                        <form action={{"/follow/".$post->user_id}} id="form_{{ $post->id }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $post->user_id }}">
                            <button type="submit" >follow</button>
                        </form>
                    
                    @endif
                @endif
            </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $posts->links() }}
        </div>
        <script>
            function deletePost(id) {
                'use strict'
        
                if (confirm('削除すると復元できません。本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
        
        <h3>Todo</h3>
        
        <div>
            
            @foreach($todos as $todo)
                @if($loginUser->id==$todo->user_id)
                    @if($todo->category->id==$category_id)
                        <p class=='todo'>{{ $todo->todo }}</p>
                        <small class=='category'>{{ $todo->category->name }}</small>
                        <form action="/delete/{{ $todo->id}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                            <button type='submit'>削除</button>
                        </form>
                    @else
                    @endif
                @else
                @endif
            @endforeach
            
        </div> 
        
        
        
        
        
        <div class="back">[<a href="/">back</a>]</div>
        
    </body>
</html>