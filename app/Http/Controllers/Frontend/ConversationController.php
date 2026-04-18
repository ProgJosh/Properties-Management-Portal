<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\ConversationMessage;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    public function index()
    {
        $conversations = Conversation::with(['landlord', 'property', 'latestMessage'])
            ->forTenant(Auth::id())
            ->orderByDesc('last_message_at')
            ->orderByDesc('updated_at')
            ->get();

        return view('frontend.pages.messages.index', compact('conversations'));
    }

    public function start(Property $property)
    {
        $conversation = Conversation::firstOrCreate(
            [
                'tenant_id' => Auth::id(),
                'landlord_id' => $property->landlord_id,
                'property_id' => $property->id,
            ],
            [
                'subject' => 'Inquiry about ' . $property->name,
                'last_message_at' => now(),
            ]
        );

        if (!$conversation->messages()->exists()) {
            ConversationMessage::create([
                'conversation_id' => $conversation->id,
                'sender_type' => 'tenant',
                'sender_id' => Auth::id(),
                'message' => 'Hello, I would like to ask about ' . $property->name . '.',
                'is_read_by_tenant' => true,
                'is_read_by_landlord' => false,
            ]);

            $conversation->update(['last_message_at' => now()]);
        }

        return redirect()->route('messages.show', $conversation);
    }

    public function show(Conversation $conversation)
    {
        abort_unless($conversation->tenant_id === Auth::id(), 403);

        $conversation->load(['landlord', 'property', 'messages']);

        $conversation->messages()
            ->where('sender_type', 'landlord')
            ->where('is_read_by_tenant', false)
            ->update(['is_read_by_tenant' => true]);

        return view('frontend.pages.messages.show', compact('conversation'));
    }

    public function store(Request $request, Conversation $conversation)
    {
        abort_unless($conversation->tenant_id === Auth::id(), 403);

        $validated = $request->validate([
            'message' => ['required', 'string', 'max:3000'],
        ]);

        ConversationMessage::create([
            'conversation_id' => $conversation->id,
            'sender_type' => 'tenant',
            'sender_id' => Auth::id(),
            'message' => $validated['message'],
            'is_read_by_tenant' => true,
            'is_read_by_landlord' => false,
        ]);

        $conversation->update([
            'last_message_at' => now(),
        ]);

        return redirect()->route('messages.show', $conversation);
    }
}
