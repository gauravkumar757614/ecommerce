<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMessageController extends Controller
{
    public function index()
    {
        $userId         =       Auth::user()->id;

        $chatUsers      =       Chat::with('receiverProfile')->select('receiver_id')
            ->where('sender_id', $userId)
            ->where('receiver_id', '!=', $userId)->groupBy('receiver_id')->get();

        return view('frontend.dashboard.messenger.index', compact('chatUsers'));
    }

    /**
     * Send message to vendor
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message'       =>      ['required'],
            'receiver_id'   =>      ['required']
        ]);

        $chat               =       new Chat();
        $chat->sender_id    =       Auth::user()->id;
        $chat->receiver_id  =       $request->receiver_id;
        $chat->message      =       $request->message;
        $chat->save();

        return response(['status' => 'success', 'message' => 'Message send successfully!']);
    }

    /**
     * Fetch all the message of specific chat
     */
    public function getMessages(Request $request)
    {
        $senderId       =       auth()->user()->id;
        $receiverId     =       $request->receiver_id;

        $messages       =       Chat::whereIn('sender_id', [$senderId, $receiverId])
                                    ->whereIn('receiver_id', [$senderId, $receiverId])
                                    ->orderBy('created_at', 'asc')->get();
        return response($messages);
    }
}
