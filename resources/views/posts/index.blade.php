<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Habit</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-gray-100 text-gray-900">

    <header class="bg-white shadow p-5 text-center">
        <h1 class="text-3xl font-bold">Habit</h1>
    </header>

    <main class="max-w-4xl mx-auto mt-8">
        <div class="text-right mb-4">
            <a href='/posts/create' class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Create</a>
        </div>

        <div class='posts space-y-6'>
            @foreach($posts as $post)
            <div class='post bg-white p-6 rounded shadow-md'>
                <p class="user text-gray-700 font-medium mb-2">{{ $post->user }}</p>
                <a href="/posts/{{ $post->id }}" class="text-2xl font-semibold text-blue-600 hover:underline">{{ $post->title }}</a>
                <p class="body mt-4 text-gray-600">{{ $post->body }}</p>
                
                <div class="mt-4 flex items-center space-x-4">
                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost({{ $post->id }})" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">Delete</button> 
                    </form>

                    @if($loginUser->isFollowing($post->user_id))
                        <form action={{"/unfollow/".$post->user_id}} id="form_{{ $post->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="user_id" value="{{ $post->user_id }}">
                            <button type="submit" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">Unfollow</button>
                        </form>
                    @else
                        <form action={{"/follow/".$post->user_id}} id="form_{{ $post->id }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $post->user_id }}">
                            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Follow</button>
                        </form>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <div class='paginate mt-8'>
            {{ $posts->links() }}
        </div>
    </main>

    <footer class="text-center mt-10">
        <div class="back text-blue-500 hover:underline">[<a href="/">back</a>]</div>
    </footer>

    <script>
        function deletePost(id) {
            'use strict'
            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
    </script>
</body>
</html>
