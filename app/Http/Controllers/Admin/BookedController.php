<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Property;
use Brian2694\Toastr\Facades\Toastr;
use App\Services\ReminderService;


class BookedController extends Controller
{
    public function booked()
    {
        


    if(Auth::user()->role == '0'){

        $booked = Booking::latest()->get();
    }else{
        $lanlordid = Auth::user()->id;

        $properyByLanlord = Property::where('landlord_id', $lanlordid)->get();

        $booked = Booking::query()
    ->whereIn('property_id', $properyByLanlord->pluck('id'))
    ->get(); // Change 15 to the number of items you want per page
    }

        return view('admin.pages.booked.index', compact('booked'));
    }


    public function show($id){

        $booked = Booking::findOrfail($id)->load('payments');

        if($booked->property->landlord_id != Auth::user()->id && Auth::user()->role != '0'){
            Toastr::error('You are not authorized to view this property.');
            return redirect()->back();
        }
        
        return view('admin.pages.booked.show', compact('booked'));
    }

    public function accept($id)
    {
        $booked = Booking::findOrFail($id);

        // Check authorization
        if($booked->property->landlord_id != Auth::user()->id && Auth::user()->role != '0'){
            Toastr::error('You are not authorized to accept this booking.');
            return redirect()->back();
        }

        // Update status to accepted
        $booked->status = 'accepted';
        
        // Set up payment reminders
        $leaseAgreement = $booked->leaseAgreement;
        
        if ($leaseAgreement) {
            // Use lease agreement data
            $booked->monthly_rent = $leaseAgreement->monthly_rent;
            $booked->rent_due_date = $leaseAgreement->start_date;
            $booked->next_payment_date = $leaseAgreement->start_date;
        } else {
            // Use property price as monthly rent
            $booked->monthly_rent = $booked->property->price;
            $booked->rent_due_date = $booked->checkin;
            $booked->next_payment_date = $booked->checkin;
        }
        
        $booked->save();

        // Create payment reminders
        $this->createPaymentReminders($booked, $leaseAgreement);

        Toastr::success('Booking accepted! Payment reminders have been scheduled.');
        return redirect()->back();
    }

    /**
     * Create monthly payment reminders for the booking duration
     */
    private function createPaymentReminders($booking, $leaseAgreement = null)
    {
        $reminderService = new ReminderService();
        
        if ($leaseAgreement) {
            // Create reminders for each month of the lease
            $startDate = \Carbon\Carbon::parse($leaseAgreement->start_date);
            $endDate = \Carbon\Carbon::parse($leaseAgreement->end_date);
            $currentDate = $startDate->copy();
            
            while ($currentDate->lte($endDate)) {
                \App\Models\PaymentReminder::create([
                    'booking_id' => $booking->id,
                    'user_id' => $booking->user_id,
                    'property_id' => $booking->property_id,
                    'due_date' => $currentDate->copy(),
                    'amount' => $booking->monthly_rent,
                    'status' => 'pending',
                    'reminder_type' => 'advance',
                    'days_before_due' => 5,
                ]);
                
                $currentDate->addMonth();
            }
            
            \Log::info("Created monthly payment reminders for booking {$booking->id} with lease agreement");
        } else {
            // Create single reminder for checkin date
            \App\Models\PaymentReminder::create([
                'booking_id' => $booking->id,
                'user_id' => $booking->user_id,
                'property_id' => $booking->property_id,
                'due_date' => $booking->rent_due_date,
                'amount' => $booking->monthly_rent,
                'status' => 'pending',
                'reminder_type' => 'advance',
                'days_before_due' => 5,
            ]);
            
            \Log::info("Created payment reminder for booking {$booking->id}");
        }
    }
}
