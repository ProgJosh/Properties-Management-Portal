<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Booking;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;


class HomeController extends Controller
{
    public function index()
    {
        $properties = collect();
        $portfolios = collect();
        $newProperties = collect();

        try {
            $properties = Property::query()->where('status', 1)->latest()->take(6)->get();
            $portfolios = Property::query()->where('status', 1)->latest()->skip(6)->take(5)->get();
            $newProperties = Property::query()->where('status', 1)->oldest()->take(3)->get();
        } catch (QueryException $exception) {
            Log::error('Failed to load home page property data.', [
                'exception' => $exception->getMessage(),
            ]);
        }

        return view('frontend.pages.home', compact('properties', 'portfolios', 'newProperties'));
    }


    public function properties(Request $request)
    {

     
        // Validate the request parameters
        request()->validate([
            'barangay' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'accommodation' => 'nullable|integer|min:0',
        ]);
    
        $types = [];

        try {
            // Start the query
            $query = Property::query()->where('status', 1);



            // Apply filters if they already booked for checkin date
        
        
            // Apply barangay filter if it exists
            $barangay = trim((string) ($request->input('barangay') ?? $request->input('location', '')));

            if ($barangay !== '' && $barangay !== 'all') {
                // Log the barangay being searched for debugging
                Log::info('Searching barangay: ' . $barangay);
                
                // Get all properties first to check their barangays
                $allBarangays = Property::pluck('barangay')->unique();
                Log::info('Available barangays: ' . implode(', ', $allBarangays->toArray()));
                
                // Case-insensitive exact match for mixed case values
                $query->whereRaw('LOWER(barangay) = LOWER(?)', [$barangay]);
                
                // Log both the search term and how it looks in lowercase for debugging
                Log::info('Original barangay search term: ' . $barangay);
                Log::info('Lowercase comparison: ' . strtolower($barangay));
            }

            if(request()->has('keyword') && !empty(request('keyword'))){
                $keyword = request('keyword');
                $query->where(function($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('address', 'like', '%' . $keyword . '%')
                    ->orWhere('barangay', 'like', '%' . $keyword . '%')
                    ->orWhere('street', 'like', '%' . $keyword . '%')
                    ->orWhere('purok', 'like', '%' . $keyword . '%');
                });
            }

        
            // Apply type filter if it exists
            if ($request->filled('type') && $request->input('type') !== 'all') {
                $query->where('type', $request->input('type'));
            }
        
            // Apply accommodation filter if it exists
            if ($request->filled('accommodation')) {
                $query->where('accommodation', '>', (int) $request->input('accommodation'));
            }


            if ($request->filled('checkin') && $request->filled('checkout')) {
        
                $checkin = $request->input('checkin');
                $checkout = $request->input('checkout');
                
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
            $properties = $query->latest()->paginate(10)->withQueryString(); // Adjust the number as needed
            $types = Property::query()
                ->whereNotNull('type')
                ->where('type', '!=', '')
                ->select('type')
                ->distinct()
                ->orderBy('type')
                ->pluck('type')
                ->values()
                ->all();
        } catch (QueryException $exception) {
            Log::error('Failed to load properties page data.', [
                'exception' => $exception->getMessage(),
            ]);
            $properties = new LengthAwarePaginator(
                [],
                0,
                10,
                1,
                ['path' => $request->url(), 'query' => $request->query()]
            );
        }
       
        // Return the view with the properties
        return view('frontend.pages.properties', compact('properties', 'types'));
    }
    


    public function property($id)
    {
        try {
            $property = Property::find($id);
        } catch (QueryException $exception) {
            Log::error('Failed to load property details.', [
                'exception' => $exception->getMessage(),
                'property_id' => $id,
            ]);
            Toastr::error('Property information is temporarily unavailable.');
            return redirect()->route('home');
        }

        if (!$property || $property->status == 0) {
            Toastr::error('Property Not Available');
            return redirect()->back();
        }

        return view('frontend.pages.property-details', compact('property'));
    }


    public function propertyByType($type)
    {
        // Sanitize the type if necessary
        $type = htmlspecialchars($type);
        $types = [];

        try {
            // Retrieve properties of the given type with pagination
            $properties = Property::where('type', $type)->where('status', 1)->paginate(12);
            $types = Property::query()
                ->whereNotNull('type')
                ->where('type', '!=', '')
                ->select('type')
                ->distinct()
                ->orderBy('type')
                ->pluck('type')
                ->values()
                ->all();
        } catch (QueryException $exception) {
            Log::error('Failed to load properties by type.', [
                'exception' => $exception->getMessage(),
                'type' => $type,
            ]);
            $properties = new LengthAwarePaginator(
                [],
                0,
                12,
                1,
                ['path' => request()->url(), 'query' => request()->query()]
            );
        }
    
        // Pass the properties and type to the view
        return view('frontend.pages.properties', compact('properties', 'type', 'types'));
    }
    
}
