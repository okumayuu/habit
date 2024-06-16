<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            <div class='usercategories'>
            @foreach($user->categories as $category)
                <a>{{ $category->name }}</a>
            @endforeach
            </dev>
            <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                @csrf
                @method('patch')
            <div>
            @foreach($categories as $category)
    
                <label>
                    {{-- valueを'$subjectのid'に、nameを'配列名[]'に --}}
                    <input type="checkbox" value="{{ $category->id }}" name="category_array[]">
                        {{$category->name}}
                    </input>
                </label>
                
            @endforeach         
            </div>
            <input type="submit" value="保存"/>
            </form>
            <div class="back">[<a href="/">back</a>]</div>
        </div>
    </div>
</x-app-layout>
