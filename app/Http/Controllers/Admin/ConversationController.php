<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\ConversationMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    public function index()
    {
        $conversations = Conversation::with(['tenant', 'property', 'latestMessage'])
            ->forLandlord(Auth::guard('admin')->id())
            ->orderByDesc('last_message_at')
            ->orderByDesc('updated_at')
            ->get();

        return view('admin.pages.messages.index', compact('conversations'));
    }

    public function show(Conversation $conversation)
    {
        abort_unless($conversation->landlord_id === Auth::guard('admin')->id(), 403);

        $conversation->load(['tenant', 'property', 'messages']);

        $conversation->messages()
            ->where('sender_type', 'tenant')
            ->where('is_read_by_landlord', false)
            ->update(['is_read_by_landlord' => true]);

        return view('admin.pages.messages.show', compact('conversation'));
    }

    public function store(Request $request, Conversation $conversation)
    {
        abort_unless($conversation->landlord_id === Auth::guard('admin')->id(), 403);

        $validated = $request->validate([
            'message' => ['required', 'string', 'max:3000'],
        ]);

        ConversationMessage::create([
            'conversation_id' => $conversation->id,
            'sender_type' => 'landlord',
            'sender_id' => Auth::guard('admin')->id(),
            'message' => $validated['message'],
            'is_read_by_tenant' => false,
            'is_read_by_landlord' => true,
        ]);

        $conversation->update([
            'last_message_at' => now(),
        ]);

        return redirect()->route('admin.messages.show', $conversation);
    }
}
