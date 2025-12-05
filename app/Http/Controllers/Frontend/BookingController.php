<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB; 



class BookingController extends Controller
{
    public function index($id)
    {
        // Attempt to find the property by its ID
        $property = Property::find($id);
        
        if($property->status == 0){
            Toastr::error('Property Not Available');
            return redirect()->back();
        }

        // Check if the property was not found
        if ($property == null) {
            // Display an error message using Toastr
            Toastr::error('Property Not Found');
            
            // Redirect back to the previous page
            return redirect()->back();
        }

        // Pass the property to the booking view
        return view('frontend.pages.booking', compact('property'));
    }


    public function checkout(Request $request){

 

    $checkin = $request->checkin;
    $checkout = $request->checkout;

    // Check existing booking for this property in this date range
    $isBooked = DB::table('bookings')
    ->where('property_id', request('property_id'))
    ->where('checkin', '<=', request('checkin'))
    ->where('checkout', '>=', request('checkout'))
    ->exists();


    if ($isBooked) {
        Toastr::error('Already booked for this date range');
        return redirect()->back();
    }


       
        

        // Set default value for kids if not provided
        $request->merge(['kids' => $request->input('kids', 0)]);

        $validated = $request->validate([
            'fname' => 'required',
            'lname' => 'nullable',
            'checkin' => 'required',
            'checkout' => 'required',
            'email' => 'required|email',
            'phone' => 'required',  
            'address' => 'required',
            'country' => 'required',
            'state' => 'nullable',
            'city' => 'required',
            'zip_code' => 'required',
            'region' => 'required',
            'payment_method' => 'required',
            'adults' => 'required|numeric|min:1',
            'kids' => 'nullable|numeric|min:0',
        ]);

        Session::put('request', $request->all());


        \Stripe\Stripe::setApiKey(config('stripe.sk'));

       

        $property = Property::find($request->property_id);

        

        
            $session = \Stripe\Checkout\Session::create([
                'line_items'  => [
                    [
                        'price_data' => [
                            'currency'     => 'PHP',
                            'product_data' => [
                                "name" => $property->name,
                            ],
                            'unit_amount'  => $request->amount,
                        ],
                        'quantity'   => 1,
                    ],
                     
                ],
                'mode'        => 'payment',
                'success_url' => route('thankyou'),
                'cancel_url'  => route('checkout'),
            ]);

            Session::put('session', $session);
        
           return redirect()->away($session->url);
      
        
      
       
       
 
    }

   


    public function thankyou(){

        $request = Session::get('request');
        
        $session = Session::get('session'); 


        $bookingData = [
            'property_id' => $request['property_id'],
            'user_id' => auth()->user()->id,
            'fname' => $request['fname'],
            'lname' => $request['lname'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'country' => $request['country'],
            'city' => $request['city'],
            'zip_code' => $request['zip_code'],
            'region' => $request['region'],
            'checkin' => $request['checkin'],
            'checkout' => $request['checkout'],
            'adults' => $request['adults'],
            'kids' => isset($request['kids']) ? $request['kids'] : 0
        ];

        $booking = Booking::create($bookingData);
        
        
        $payment = new Payment();
        $payment->booking_id = $booking->id;
        $payment->user_id = auth()->user()->id;
        $payment->payment_method = $request['payment_method'];
        $payment->currency = 'USD';
        $payment->amount = $request['amount'];
        $payment->status = 'paid';
        $payment->save();

        Session::forget('request');
        Session::forget('session');

        Toastr::success('Renting Successful');
        return redirect()->route('dashboard');
    }
}
