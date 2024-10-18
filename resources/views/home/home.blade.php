<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            home
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center">
                <!-- Todo List -->
                <div class="w-1/4 p-4">
                    <h3 class="text-lg font-semibold mb-3">Todo</h3>
                    <form action="/todo" method="post" class="space-y-4">
                        @csrf
                        <div class="flex justify-between items-center p-2 bg-white rounded shadow">
                            <input placeholder="todo..." type="text" name="todo[todo]" class="w-full p-2 border rounded" required/>
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
                        <div>
                            <select name="todo[category_id]" class="w-full p-2 border rounded">
                                @foreach($user->categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>

                    <div class="mt-6 space-y-3">
                        @foreach($todos as $todo)
                            <div class="flex justify-between items-center p-2 bg-white rounded shadow">
                                <div>
                                    <p class="text-sm font-medium">{{ $todo->todo }}</p>
                                    <div class="flex items-center">
                                        <small class="text-gray-500 mr-4">{{ $todo->category->name }}</small>
                                    </div>
                                </div>
                                <form action="/delete/{{ $todo->id }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600">
                                      <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                      </svg>
                                    </button>

                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Main Content -->
                <div class="w-1/2 p-4">
                    <div class="bg-white p-6 rounded shadow-lg">
                        <h2 class="text-xl font-semibold mb-4">ようこそ{{$user->name}}さん</h2>
                    </div>
                </div>

                <!-- Profile Sidebar -->
                <div class="w-1/6 p-4">
                    <div class="bg-white p-6 rounded shadow-lg">
                        <div class="flex items-center mb-4">
                            <a href='/profile' class="ml-4">
                                <p class="text-lg font-semibold">{{ $user->name }}</p>
                            </a>
                        </div>

                        <h3 class="text-md font-semibold mb-3">ユーザー登録した習慣表示</h3>
                        <div class="space-y-2">
                            @foreach($user->categories as $category)
                                <a href='/posts/{{ $category->id }}' class="block py-2 px-4 bg-blue-100 rounded hover:bg-blue-200">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
