@extends('layouts.app')

@section('content')
<div>
    <h2>{{ $user->name }} にメッセージを送る</h2>

    <form action="{{ route('messages.store', $user) }}" method="POST">
        @csrf
        <div>
            <textarea name="body" rows="4" cols="50" required></textarea>
        </div>
        <div>
            <button type="submit">送信</button>
        </div>
    </form>
</div>
@endsection
