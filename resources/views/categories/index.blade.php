<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $category_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center">
                <div class="w-1/4 p-4">
                    <!-- Todo List -->
                    <h3 class="text-lg font-semibold mb-3">Todo</h3>
        
                    <!-- Todo追加フォーム -->
                    <form action="/todo" method="POST" class="space-y-4">
                        @csrf
                        <!-- Todo入力 -->
                        <div class="flex justify-between items-center p-2 bg-white rounded shadow">
                            <div>
                                <input placeholder="Todo..." type="text" name="todo[todo]" class="w-full p-2 border rounded" required/>
                                @if ($errors->has('todo.todo'))
                                    <div style="color:red;">
                                        {{ $errors->first('todo.todo') }}
                                    </div>
                                @endif
                            </div>
                        
                            <!-- 隠しカテゴリー選択 -->
                            <div>
                                <select hidden name="todo[category_id]">
                                    <option value="{{ $category_id }}">{{ $category_name }}</option>
                                </select>
                            </div>
                        
                            <!-- 追加ボタン -->
                            <button type="submit" class=" text-white py-2 px-4 rounded-full hover:bg-green-200">
                                <svg  class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="#4CAF50"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-pencil-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                    <path d="M13.5 6.5l4 4" />
                                    <path d="M16 19h6" />
                                    <path d="M19 16v6" />
                                </svg>
                            </button>
                        </div>
                    </form>
                    
                    <!-- Todoリストの表示 -->
                    <div class="mt-6 space-y-3">
                        @foreach($todos as $todo)
                            @if($loginUser->id == $todo->user_id && $todo->category->id == $category_id)
                                <div class="flex justify-between items-center p-2 bg-white rounded shadow">
                                    <!-- Todoとカテゴリの表示 -->
                                    <div>
                                        <p class="text-sm font-medium">{{ $todo->todo }}</p>
                                        <div class="flex items-center">
                                            <small class="text-gray-500 mr-4">{{ $todo->category->name }}</small>
                                        </div>
                                    </div>
                    
                                    <!-- 完了ボタン（削除） -->
                                    <form action="/delete/{{ $todo->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600">
                                          <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                          </svg>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endforeach
                    </div>
        
                </div>
                <!-- Main Content -->
                <div class="w-1/2 p-4">
                    <div class="bg-white p-6 rounded shadow-lg">
                        <div class="flex items-center justify-between mb-4">
                            <!-- 目標の文章を中央に配置 -->
                            <h2 class="text-xl font-semibold text-center flex-grow text-center">{{ $target_target }}</h2>
                    
                            <!-- 目標がnullでない場合のみeditアイコンを右端に配置 -->
                            @if($target_target !== null)
                                <a href='/posts/{{$category_id}}/target/edit' class="text-white p-2 rounded-full hover:bg-green-200 inline-flex items-center">
                                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="#4CAF50">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    
                        <div class="flex justify-center">
                            <a href='/posts/{{$category_id}}/create' class="bg-green-200 text-white p-2 rounded-full hover:bg-green">
                                <svg  class="h-6 w-6 text-white"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-square-rounded-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" />
                                    <path d="M15 12h-6" />
                                    <path d="M12 9v6" />
                                </svg>
                            </a>
                        </div>
                    </div>


                <!-- 投稿一覧画面 -->
                    
                    <div class="max-w-4xl mx-auto p-4">
                        @foreach($posts as $post)
                            <div class="bg-white p-6 rounded-lg shadow-sm mb-4">
                                <h2 class="text-lg font-bold mb-2">{{ $post->title }}</h2>
                                <p class="mb-4">{{ $post->body }}</p>
                                <small class="text-gray-500">{{ $post->user->name }}</small>
                                
                                <div class="flex items-center space-x-2">
                                    <!-- いいね！ボタン -->
                                    @if ($post->likes->where('user_id', $loginUser->id)->count())
                                        <form action="/posts/{{$post->id}}/unlike" id="form_{{ $post->id }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="hover:underline">
                                                <svg  class="h-8 w-8 text-pink-500" width="24" height="24" viewBox="0 0 24 20" fill="currentColor">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M6.979 3.074a6 6 0 0 1 4.988 1.425l.037 .033l.034 -.03a6 6 0 0 1 4.733 -1.44l.246 .036a6 6 0 0 1 3.364 10.008l-.18 .185l-.048 .041l-7.45 7.379a1 1 0 0 1 -1.313 .082l-.094 -.082l-7.493 -7.422a6 6 0 0 1 3.176 -10.215z" />
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <form action="/posts/{{$post->id}}/like" id="form_{{ $post->id }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="hover:underline">
                                                <svg class="h-8 w-8 text-pink-500" width="24" height="24" viewBox="0 0 24 20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                
                                    <!-- コメント表示ボタン -->
                                    <button id="show-comments-button" class="hover:underline">
                                        <svg  class="h-8 w-8 text-pink-500"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="#4CAF50"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-message-circle">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M3 20l1.3 -3.9c-2.324 -3.437 -1.426 -7.872 2.1 -10.374c3.526 -2.501 8.59 -2.296 11.845 .48c3.255 2.777 3.695 7.266 1.029 10.501c-2.666 3.235 -7.615 4.215 -11.574 2.293l-4.7 1" />
                                        </svg>
                                    </button>
                                </div>

                                
                                <!-- コメントセクション（初期状態は非表示） -->
                                <div id="comments-section" class="space-y-2 mt-4 hidden">
                                    <div class="space-y-2">
                                        @foreach ($post->comments as $comment)
                                            <div class="bg-gray-100 p-3 rounded-lg">
                                                <p>{{ $comment->comment }}</p>
                                                <small class="text-gray-500">{{ $comment->user->name }}</small>
                                                @if(auth()->id() == $comment->user_id)
                                                    <form action="/comments/{{$comment->id}}" id="form_{{ $comment->id }}" method="POST" class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="deleteMessage({{ $comment->id }})" class="text-red-500 hover:underline">削除</button>
                                                    </form>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                
                                    <!-- コメント投稿フォーム -->
                                    <form action="/posts/{{$post->id}}/comments" id="form_{{ $post->id }}" method="POST" class="mt-4">
                                        @csrf
                                        <textarea name="comment" placeholder="コメントを入力" class="w-full p-2 border rounded-lg mb-2"></textarea>
                                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">コメントする</button>
                                    </form>
                                </div>
                                
                                <!-- jQueryを使用して、ボタンを押したらコメントセクションを表示 -->
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <script>
                                    $(document).ready(function() {
                                        // ボタンをクリックするとコメントセクションが表示される
                                        $('#show-comments-button').on('click', function() {
                                            $('#comments-section').toggleClass('hidden'); // hiddenクラスをトグル
                                        });
                                    });
                                </script>

                                
                                <p class="mt-4">いいね！: {{ $post->likes->count() }}</p>
                    
                                @if($loginUser->id == $post->user_id)
                                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="POST" class="mt-2 inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="deleteMessage({{ $post->id }})" class="text-red-500 hover:underline">delete</button> 
                                    </form>
                                @endif
                                
                                @if($loginUser->id != $post->user_id)
                                    @if($loginUser->isFollowing($post->user_id))
                                        <form action={{"/unfollow/".$post->user_id}} id="form_{{ $post->id }}" method="post" class="mt-2 inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="user_id" value="{{ $post->user_id }}">
                                            <button type="submit" class="text-blue-500 hover:underline">unfollow</button>
                                        </form>
                                    @else
                                        <form action={{"/follow/".$post->user_id}} id="form_{{ $post->id }}" method="post" class="mt-2 inline-block">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $post->user_id }}">
                                            <button type="submit" class="text-blue-500 hover:underline">follow</button>
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
                                'use strict';
                            
                                if (confirm('削除すると復元できません。本当に削除しますか？')) {
                                    document.getElementById(`form_${id}`).submit();
                                } else {
                                    // キャンセルが選択された場合、何もしません
                                    return false;
                                }
                            }
                    </script>
                    <div class="back">[<a href="/">back</a>]</div>
                    
                </div>
                <!-- Profile Sidebar -->
                <div class="w-1/6 p-4">
                    <div class="bg-white p-6 rounded shadow-lg">
                        <div class="flex items-center mb-4">
                            <a href='/profile' class="ml-4">
                                <p class="text-lg font-semibold">{{ $loginUser->name }}</p>
                            </a>
                        </div>
        
                        <h3 class="text-md font-semibold mb-3">登録した習慣表示</h3>
                        <div class="space-y-2">
                            @foreach($loginUser->categories as $category)
                                <a href='/posts/{{$category->id}}' class="block py-2 px-4 bg-blue-100 rounded hover:bg-blue-200">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>