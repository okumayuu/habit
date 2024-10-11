<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $category_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center">
                <div class="w-1/6 p-4">
                    <!-- Todo List -->
                    <h3 class="text-lg font-semibold mb-3">Todo</h3>
                    <form action="/todo" method="post" class="space-y-4">
                        @csrf
                        <div>
                            <input placeholder="todo..." type="text" name="todo[todo]" class="w-full p-2 border rounded"/>
                        </div>
                        <div>
                            <select hidden name="todo[category_id]">
                                
                                <option value="{{ $category_id }}">{{ $category_name }}</option>
                                
                            </select>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">追加する</button>
                    </form>
                    
                    <div class="mt-6 space-y-3">
                        @foreach($todos as $todo)
                            @if($loginUser->id==$todo->user_id)
                                @if($todo->category->id==$category_id)
                                    <div class="flex justify-between items-center p-2 bg-white rounded shadow">
                                        <div>
                                            <p class="text-sm font-medium">{{ $todo->todo }}</p>
                                            <small class="text-gray-500">{{ $todo->category->name }}</small>
                                        </div>
                                        <form action="/delete/{{ $todo->id}}" method="post" enctype="multipart/form-data">
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
                            @endif
                        @endforeach
                    </div>
                </div>
                <!--目標編集画面-->
                <div class="w-1/2 p-4">
                    <div class="bg-white p-6 rounded shadow-lg">
                        <h2 class="text-xl font-semibold mb-4">{{ $category_name }}</h2>
                    </div>
                    
                    <div class="max-w-4xl mx-auto p-4">
                        <form action="/target/{{ $category_id }}/update" method="POST">
                            @csrf
                            @method('PUT')
        
                            <div class="mb-4">
                                <label for="target" class="block text-gray-700">目標:</label>
                                <input type="text" name="target[target]" id="target" class="w-full p-2 border rounded" value="{{ old('target', $target->target) }}" required>
                                
                                @if ($errors->has('target.target'))
                                    <div class="text-red-500 mt-2">
                                        {{ $errors->first('target.target') }}
                                    </div>
                                @endif
                            </div>
        
                            <!-- 隠しフィールドでcategory_idを送信 -->
                            <input type="hidden" name="target[category_id]" value="{{ $category_id }}">
        
                            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                                目標を更新する
                            </button>
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