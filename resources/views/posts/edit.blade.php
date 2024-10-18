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
                <!--投稿作成画面-->
                <div class="w-1/2 p-4">
                    <div class="bg-white p-6 rounded shadow-lg">
                        <h2 class="text-xl font-semibold mb-4">{{ $category_name }}</h2>
                    </div>
                    
                    <div class="max-w-4xl mx-auto p-4">
                        <form action="/posts/{{$category_id}}/target" method="POST">
                            @csrf
                            <h2>目標編集画面</h2>
                            <input type="text" name="target[target]" value="{{ old('target.target') }}"/>
                            <div>
                                <label>{{$category_name}}</label>
                                    <select hidden name="target[category_id]">
                                        
                                        <option value="{{ $category_id }}">{{ $category_name }}</option>
                                        
                                    </select>
                            </div>
                            <input type="submit" value="保存"/>
                        </form>
                        <div class="back">[<a href="/posts/{{$category_id}}">back</a>]</div>
                    </div>
                </div>
                <!-- Profile Sidebar -->
                <div class="w-1/6 p-4">
                    <div class="bg-white p-6 rounded shadow-lg">
                        <div class="flex items-center mb-4">
                            <div class="ml-4">
                                <p class="text-lg font-semibold">{{ $loginUser->name }}</p>
                                <!-- Logged-in user's name -->
                            </div>
                        </div>
        
                        <h3 class="text-md font-semibold mb-3">ユーザー登録した習慣表示</h3>
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