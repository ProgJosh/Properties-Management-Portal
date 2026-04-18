<?php

namespace App\Http\Controllers;

use App\Models\ChatbotInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatbotController extends Controller
{
    public function reply(Request $request)
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:1000'],
        ]);

        $question = trim($validated['message']);
        $answer = $this->buildReply($question);

        ChatbotInquiry::create([
            'user_id' => Auth::id(),
            'question' => $question,
            'answer' => $answer,
            'ip_address' => $request->ip(),
        ]);

        return response()->json([
            'answer' => $answer,
        ]);
    }

    private function buildReply(string $question): string
    {
        $message = strtolower($question);

        $faq = [
            'booking' => 'To book a property, open the property details page and click "Rent Now". You will need to log in first before checkout.',
            'rent' => 'You can browse listings on the Listings page, then open a property to see price, amenities, and booking details.',
            'payment' => 'Payments are tied to bookings. You can review your booking and payment details from your tenant dashboard after logging in.',
            'lease' => 'Lease agreements are created from accepted bookings. Once available, tenants can review and sign them from their account.',
            'message' => 'You can message a landlord from a property details page or from your tenant dashboard once you are logged in.',
            'contact' => 'For direct help, you can use the Contact page or send a landlord message from the property you are interested in.',
            'landlord' => 'Landlords manage properties and reply from their admin dashboard. If you want to talk to one, use the message button on a property page.',
            'location' => 'You can filter listings by barangay on the Listings page to narrow properties by location.',
            'price' => 'Property pricing is shown on each listing card and details page. You can compare options from the Listings page.',
        ];

        foreach ($faq as $keyword => $response) {
            if (str_contains($message, $keyword)) {
                return $response;
            }
        }

        return 'I can help with listings, bookings, payments, lease agreements, landlord messages, and property search. Try asking something like "How do I book?", "How do I message a landlord?", or "How do I find properties in a barangay?"';
    }
}
