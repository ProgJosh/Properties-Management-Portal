<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Booking;
use Brian2694\Toastr\Facades\Toastr;


class HomeController extends Controller
{
    public function index()
    {

        $properties = Property::latest()->where('status', 1)->take(6)->get();

        return view('frontend.pages.home', compact('properties'));
    }


    public function properties(Request $request)
    {

     
        // Validate the request parameters
        request()->validate([
            'location' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'accommodation' => 'nullable|integer|min:0',
        ]);
    
        // Start the query
        $query = Property::query()->where('status', 1);

       

        // Apply filters if they already booked for checkin date
     
    
        // Apply location filter if it exists
        if (request()->has('location') && request('location') !== 'all') {
            $location = trim(request('location'));
            // Log the location being searched for debugging
            \Illuminate\Support\Facades\Log::info('Searching location: ' . $location);
            
            // Get all properties first to check their locations
            $allLocations = Property::pluck('location')->unique();
            \Illuminate\Support\Facades\Log::info('Available locations: ' . implode(', ', $allLocations->toArray()));
            
            // Case-insensitive exact match for mixed case values
            $query->whereRaw('LOWER(location) = LOWER(?)', [$location]);
            
            // Log both the search term and how it looks in lowercase for debugging
            \Illuminate\Support\Facades\Log::info('Original location search term: ' . $location);
            \Illuminate\Support\Facades\Log::info('Lowercase comparison: ' . strtolower($location));
        }

        if(request()->has('keyword') && !empty(request('keyword'))){
            $keyword = request('keyword');
            $query->where(function($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')
                  ->orWhere('location', 'like', '%' . $keyword . '%');
            });
        }

        
        // Apply type filter if it exists
        if (request()->has('type') && request('type') !== 'all') {
            $query->where('type', request('type'));
        }
    
        // Apply accommodation filter if it exists
        if (request()->has('accommodation')) {
            $query->where('accommodation', '>', request('accommodation'));
        }


        if (request()->has('checkin') && request()->has('checkout')) {
    
            $checkin = request('checkin');
            $checkout = request('checkout');
            
            // Ensure checkin and checkout are valid dates
            if (strtotime($checkin) && strtotime($checkout)) {
                $bookedForDate = Booking::whereBetween('checkin', [$checkin, $checkout])
                    ->orWhereBetween('checkout', [$checkin, $checkout])
                    ->pluck('property_id')
                    ->toArray();
        
                
        
                $query->whereNotIn('id', $bookedForDate);
            } 
        }
    
        // Paginate the results
        $properties = $query->latest()->paginate(10); // Adjust the number as needed
       
        // Return the view with the properties
        return view('frontend.pages.properties', compact('properties'));
    }
    


    public function property($id)
    {
        $property = Property::find($id);

        if($property->status == 0){
            Toastr::error('Property Not Available');
            return redirect()->back();
        }

        return view('frontend.pages.property-details', compact('property'));
    }


    public function propertyByType($type)
    {
        // Sanitize the type if necessary
        $type = htmlspecialchars($type);
    
        // Retrieve properties of the given type with pagination
        $properties = Property::where('type', $type)->where('status', 1)->paginate(12);
    
        // Pass the properties and type to the view
        return view('frontend.pages.properties', compact('properties', 'type'));
    }
    
}
