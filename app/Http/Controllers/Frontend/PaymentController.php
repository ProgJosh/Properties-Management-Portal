<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\LeaseAgreement;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    /**
     * Show GCash payment page with QR code
     */
    public function showGCash(Request $request)
    {
        $referenceId = $request->reference_id;
        $amount = $request->amount;
        
        // Generate QR code URL
        $qrData = json_encode([
            'reference_id' => $referenceId,
            'amount' => $amount,
            'currency' => 'PHP',
        ]);
        
        $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=" . urlencode($qrData);
        $bookingRequest = Session::get('request');
        
        return view('frontend.pages.payment.gcash', [
            'reference_id' => $referenceId,
            'amount' => $amount,
            'qr_code_url' => $qrCodeUrl,
            'property_id' => $bookingRequest['property_id'] ?? null,
        ]);
    }

    /**
     * Verify GCash payment
     */
    public function verifyGCash(Request $request)
    {
        $request->validate([
            'reference_id' => 'required',
        ]);

        $bookingRequest = Session::get('request');
        
        if (!$bookingRequest) {
            Toastr::error('Session expired. Please try again.');
            return redirect()->route('home');
        }

        return $this->createBookingAndRedirect($bookingRequest, $request->reference_id, 'GCash');
    }

    /**
     * Show GoTyme Bank payment page with QR code
     */
    public function showGoTyme(Request $request)
    {
        $referenceId = $request->reference_id;
        $amount = $request->amount;
        $qrData = $request->qr_data ? urldecode($request->qr_data) : json_encode([
            'reference_id' => $referenceId,
            'amount' => $amount,
            'currency' => 'PHP',
            'merchant' => config('payment-gateways.gotyme.merchant_id'),
        ]);

        $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=" . urlencode($qrData);
        $bookingRequest = Session::get('request');

        return view('frontend.pages.payment.gotyme', [
            'reference_id' => $referenceId,
            'amount' => $amount,
            'qr_code_url' => $qrCodeUrl,
            'property_id' => $bookingRequest['property_id'] ?? null,
        ]);
    }

    /**
     * Verify GoTyme Bank payment
     */
    public function verifyGoTyme(Request $request)
    {
        $request->validate([
            'reference_id' => 'required',
        ]);

        $bookingRequest = Session::get('request');

        if (!$bookingRequest) {
            Toastr::error('Session expired. Please try again.');
            return redirect()->route('home');
        }

        return $this->createBookingAndRedirect($bookingRequest, $request->reference_id, 'GoTyme Bank');
    }

    /**
     * Show BDO Pay payment page
     */
    public function showBDOPay(Request $request)
    {
        $referenceId = $request->reference_id;
        $amount = $request->amount;
        
        $bookingRequest = Session::get('request');

        return view('frontend.pages.payment.bdopay', [
            'reference_id' => $referenceId,
            'amount' => $amount,
            'property_id' => $bookingRequest['property_id'] ?? null,
        ]);
    }

    /**
     * Verify BDO Pay payment
     */
    public function verifyBDOPay(Request $request)
    {
        $request->validate([
            'reference_id' => 'required',
        ]);

        $bookingRequest = Session::get('request');
        
        if (!$bookingRequest) {
            Toastr::error('Session expired. Please try again.');
            return redirect()->route('home');
        }

        return $this->createBookingAndRedirect($bookingRequest, $request->reference_id, 'BDO Pay');
    }

    /**
     * Show Atome payment page
     */
    public function showAtome(Request $request)
    {
        $referenceId = $request->reference_id;
        $amount = $request->amount;
        
        $bookingRequest = Session::get('request');

        return view('frontend.pages.payment.atome', [
            'reference_id' => $referenceId,
            'amount' => $amount,
            'property_id' => $bookingRequest['property_id'] ?? null,
        ]);
    }

    /**
     * Verify Atome payment
     */
    public function verifyAtome(Request $request)
    {
        $request->validate([
            'reference_id' => 'required',
        ]);

        $bookingRequest = Session::get('request');
        
        if (!$bookingRequest) {
            Toastr::error('Session expired. Please try again.');
            return redirect()->route('home');
        }

        return $this->createBookingAndRedirect($bookingRequest, $request->reference_id, 'Atome');
    }

    /**
     * Create booking and redirect to thank you page
     */
    private function createBookingAndRedirect($bookingRequest, $referenceId, $paymentMethod)
    {
        $bookingData = [
            'property_id' => $bookingRequest['property_id'],
            'user_id' => auth()->user()->id,
            'fname' => $bookingRequest['fname'],
            'lname' => $bookingRequest['lname'],
            'email' => $bookingRequest['email'],
            'phone' => $bookingRequest['phone'],
            'address' => $bookingRequest['address'],
            'country' => $bookingRequest['country'],
            'city' => $bookingRequest['city'],
            'zip_code' => $bookingRequest['zip_code'],
            'region' => $bookingRequest['region'],
            'checkin' => $bookingRequest['checkin'],
            'checkout' => $bookingRequest['checkout'],
            'adults' => $bookingRequest['adults'],
            'kids' => isset($bookingRequest['kids']) ? $bookingRequest['kids'] : 0
        ];

        $booking = Booking::create($bookingData);
        
        // Create lease agreement automatically
        $leaseAgreement = LeaseAgreement::createFromBooking($booking);
        
        Payment::create([
            'booking_id' => $booking->id,
            'user_id' => auth()->user()->id,
            'email' => $bookingRequest['email'] ?? null,
            'payment_method' => $paymentMethod,
            'transaction_id' => $referenceId,
            'currency' => 'PHP',
            'amount' => $bookingRequest['amount'],
            'status' => 'completed',
        ]);

        Session::forget('request');
        Session::forget('session');
        Session::forget('payment_reference');
        Session::forget('payment_gateway');

        Toastr::success('Payment successful! Booking confirmed.');
        return redirect()->route('lease-agreements.show', $leaseAgreement->id);
    }

    // Callback methods for webhook handling
    public function gcashCallback(Request $request)
    {
        // Handle GCash webhook
        return response()->json(['status' => 'received']);
    }

    public function gotymeCallback(Request $request)
    {
        // Handle GoTyme Bank webhook
        return response()->json(['status' => 'received']);
    }

    public function bdopayCallback(Request $request)
    {
        // Handle BDO Pay webhook
        return response()->json(['status' => 'received']);
    }

    public function atomeCallback(Request $request)
    {
        // Handle Atome webhook
        return response()->json(['status' => 'received']);
    }
}
