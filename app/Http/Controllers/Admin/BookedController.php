<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Property;
use Brian2694\Toastr\Facades\Toastr;


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
}
