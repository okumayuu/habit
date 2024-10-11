<x-app-layout>

@section('content')
<div>
    <h2>受信メッセージ一覧</h2>

    @if ($messages->isEmpty())
        <p>メッセージはありません。</p>
    @else
        <ul>
            @foreach ($messages as $message)
                <li>
                    <strong>{{ $message->sender->name }}</strong>: {{ $message->body }}
                    <br>
                    <small>{{ $message->created_at }}</small>
                </li>
            @endforeach
        </ul>
    @endif
</div>
</x-app-layout>
