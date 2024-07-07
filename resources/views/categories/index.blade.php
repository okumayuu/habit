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
        <h3>目標：{{$target_target}}</h3>
        <a href='/posts/{{$category_id}}/create'>create</a>
        <div class='posts'>
            @foreach($posts as $post)
            <div class='post'>
                <a href="/posts/{{ $post->id }}"><h2 class='title'>{{ $post->title }}</h2></a>
                <p class=='body'>{{ $post->body }}</p>
                <small class=='user'>{{ $post->user->name }}</small>
                <h3>コメント</h3>
                @foreach ($post->comments as $comment)
                    <div>
                        <p>
                            {{ $comment->comment }}
                            {{ $comment->user->name }}
                        </p>
                        @if(auth()->id() == $comment->user_id)
                            <form action="/comments/{{$comment->id}}" id="form_{{ $comment->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="deleteMessage({{ $comment->id }})">削除</button>
                            </form>
                        @endif
                    </div>
                @endforeach
                
                <form action="/posts/{{$post->id}}/comments" id="form_{{ $post->id }}" method="POST">
                    @csrf
                    <textarea name="comment" placeholder="コメントを入力"></textarea>
                    <button type="submit">コメントする</button>
                </form>
                
                <p>いいね数: {{ $post->likes->count() }}</p>
                @if ($post->likes->where('user_id', $loginUser->id)->count())
                <form action="/posts/{{$post->id}}/unlike" id="form_{{ $post->id }}" method="POST">
                    @csrf
                    <button type="submit">いいねを取り消す</button>
                </form>
                @else
                <form action="/posts/{{$post->id}}/like" id="form_{{ $post->id }}" method="POST">
                    @csrf
                    <button type="submit">いいね</button>
                </form>
                @endif
                @if($loginUser->id==$post->user_id)
                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="deleteMessage({{ $post->id }})">delete</button> 
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
            function deleteMessage(id) {
                'use strict'
        
                if (confirm('削除すると復元できません。本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
        
        <h3>Todo</h3>
        <form action="/todo" method="post" class="mt-10">
          @csrf
            <label>
                <input placeholder="category's todo..." type="text" name="todo[todo]"/>
            </label>
            <div>
                <select hidden name="todo[category_id]">
                        
                        <option value="{{ $category_id }}">{{ $category_name }}</option>
                        
                </select>
            </div>
            <button type="submit" >追加する</button>
        </form>
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