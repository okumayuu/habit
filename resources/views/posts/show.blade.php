<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>
    <body class="antialiased">
        <h1 class='title'>
            {{ $post->title }}
        </h1>
        <div class='content'>
            <div class='content_post'>
                <h3>本文</h3> 
                <p class=='body'>{{ $post->body }}</p>
            </div>
        </div>
        <div class="edit">
            <a href="/posts/{{ $post->id }}/edit">edit</a>
        </div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</html>