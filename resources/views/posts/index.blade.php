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
        <a href='/posts/create'>create</a>
        <div class='posts'>
            @foreach($posts as $post)
            <div class='post'>
                <p class=='user'>{{ $post->user }}</p>
                <a href="/posts/{{ $post->id }}"><h2 class='title'>{{ $post->title }}</h2></a>
                <p class=='body'>{{ $post->body }}</p>
                <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deletePost({{ $post->id }})">delete</button> 
                </form>
                
            
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
            </div>
            @endforeach
        </div>
        <div class='paginate'>
            {{ $posts->links() }}
        </div>
        <script>
            function deletePost(id) {
                'use strict'
        
                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
        <div class="back">[<a href="/">back</a>]</div>
        
    </body>
</html>