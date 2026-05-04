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
        
        return view('frontend.pages.payment.gcash', [
            'reference_id' => $referenceId,
            'amount' => $amount,
            'qr_code_url' => $qrCodeUrl,
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
            return redirect()->route('booking.index');
        }

        // Simulate payment verification (in production, call actual GCash API)
        $payment = new Payment();
        $payment->reference_id = $request->reference_id;
        $payment->payment_method = 'GCash';
        $payment->currency = 'PHP';
        $payment->amount = $bookingRequest['amount'];
        $payment->status = 'completed';
        $payment->save();

        return $this->createBookingAndRedirect($bookingRequest, $request->reference_id, 'GCash');
    }

    /**
     * Show BDO Pay payment page
     */
    public function showBDOPay(Request $request)
    {
        $referenceId = $request->reference_id;
        $amount = $request->amount;
        
        return view('frontend.pages.payment.bdopay', [
            'reference_id' => $referenceId,
            'amount' => $amount,
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
            return redirect()->route('booking.index');
        }

        // Simulate payment verification (in production, call actual BDO Pay API)
        $payment = new Payment();
        $payment->reference_id = $request->reference_id;
        $payment->payment_method = 'BDO Pay';
        $payment->currency = 'PHP';
        $payment->amount = $bookingRequest['amount'];
        $payment->status = 'completed';
        $payment->save();

        return $this->createBookingAndRedirect($bookingRequest, $request->reference_id, 'BDO Pay');
    }

    /**
     * Show Atome payment page
     */
    public function showAtome(Request $request)
    {
        $referenceId = $request->reference_id;
        $amount = $request->amount;
        
        return view('frontend.pages.payment.atome', [
            'reference_id' => $referenceId,
            'amount' => $amount,
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
            return redirect()->route('booking.index');
        }

        // Simulate payment verification (in production, call actual Atome API)
        $payment = new Payment();
        $payment->reference_id = $request->reference_id;
        $payment->payment_method = 'Atome';
        $payment->currency = 'PHP';
        $payment->amount = $bookingRequest['amount'];
        $payment->status = 'completed';
        $payment->save();

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
        
        // Update payment with booking and user info
        $payment = Payment::where('reference_id', $referenceId)->first();
        if ($payment) {
            $payment->booking_id = $booking->id;
            $payment->user_id = auth()->user()->id;
            $payment->save();
        }

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
