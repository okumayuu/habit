<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 sm:p-8 bg-white shadow-lg rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-6 sm:p-8 bg-white shadow-lg rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-6 sm:p-8 bg-white shadow-lg rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            <div class="p-6 bg-white shadow-lg rounded-lg">
                <h3 class="text-lg font-semibold mb-4">User Categories</h3>
                <div class="flex flex-wrap gap-4">
                    @foreach($user->categories as $category)
                        <a>{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>

            <div class="p-6 bg-white shadow-lg rounded-lg">
                <h3 class="text-lg font-semibold mb-4">Select Categories</h3>
                <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('patch')
            
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($categories as $category)
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" value="{{ $category->id }}" name="category_array[]" class="text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                                <span>{{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
            
                    <div class="mt-6">
                        <button type='submit' >
                            Save
                        </button>

                    </div>
                </form>
            </div>


            <div class="text-center mt-8">
                <a href="/" class="text-blue-500 hover:text-blue-600 underline">Back</a>
            </div>
        </div>
    </div>
</x-app-layout>

