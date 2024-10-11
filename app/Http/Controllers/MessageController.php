<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function create(User $user)
    {
        $followers = auth()->user()->follower;
    
        if ($followers->isEmpty()) {
            return redirect()->route('home')->with('error', 'メッセージを送信するフォロワーがいません。');
        }
    
        return view('messages.create', compact('user', 'followers'));
    }


    public function store(Request $request, User $user)
    {
        $request->validate([
            'body' => 'required|string|max:255',
        ]);
    
        Message::create([
            'body' => $request->body,
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
        ]);
    
        return redirect()->route('messages.index', ['user' => $user->id])->with('success', 'メッセージを送信しました。');
    }
    
    public function index(User $user)
    {
        $messages = auth()->user()->receivedMessages()->where('sender_id', $user->id)->get();
        
        $followers = auth()->user()->follower;
    
        if ($followers->isEmpty()) {
            return redirect()->route('home.home')->with('error', 'メッセージを送信するフォロワーがいません。');
        }
        
        else{
    
            return view('messages.index', compact('messages', 'user', 'followers'));
        }
    }
}
