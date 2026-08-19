<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePropertyRequest;
use App\Models\Property;
use App\Models\PropertyGallery;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdatePropertyRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class PropertiesController extends Controller
{
    public function index()
    {
        if(Auth::guard('admin')->user()->role == '0'){

            $properties = Property::latest()->get();
           }else{
    
            $properties = Property::where('landlord_id', Auth::guard('admin')->user()->id)->latest()->get();
           }
        return view('admin.pages.properties.index', compact('properties'));
    }


    public function create(){

        return view('admin.pages.properties.create');
    }

    public function store(StorePropertyRequest $request){

        $data = $request->validated();
    
        $disk = config('filesystems.default') === 'local' ? 'public' : 'supabase';
        $tmpimgpath = $request->file('thumbnail')->store('properties', $disk);
        $data['thumbnail'] = $tmpimgpath;
        
        $data['landlord_id'] = auth()->user()->id;
    
        unset($data['images']);

        // Store title document securely (private disk, not publicly accessible)
        if ($request->hasFile('title_document')) {
            $data['title_document'] = $request->file('title_document')
                ->store('title_documents', 'local');
            $data['title_verification_status'] = 'pending';
        }
    
        $property = Property::create($data);
    
        if($request->hasFile('images')){
            $images = $request->file('images');
            foreach($images as $image){
                $imgdata = [
                    'property_id' => $property->id,
                    'image' => $image->store('properties', $disk),
                ];
                PropertyGallery::create($imgdata);
            }
        }
    
        Toastr::success('Property created successfully. Title document is pending admin verification.');
    
        return redirect()->route('admin.properties');
    }



    public function edit($id){
        $property = Property::find($id);
        if(!$property){
            Toastr::error('Property not found');
            return redirect()->route('admin.properties');
        }
        return view('admin.pages.properties.edit', compact('property'));
    }

    public function update(UpdatePropertyRequest $request, $id) {
       
        $data = $request->validated();
    
        
        $property = Property::find($id);
    
        if (!$property) {
            Toastr::error('Property not found');
            return redirect()->route('admin.properties');
        }
    
        $disk = config('filesystems.default') === 'local' ? 'public' : 'supabase';
        if ($request->hasFile('thumbnail')) {
            $imgpath = $request->file('thumbnail')->store('properties', $disk);
            $data['thumbnail'] = $imgpath;
        }
        unset($data['images']);
    
        DB::transaction(function() use ($data, $property, $request) {
            $property->update($data);   
    
            //Gather all images
            if ($request->hasFile('images')) {
                $images = $request->file('images');
    
                // Delete existing images once
                PropertyGallery::where('property_id', $property->id)->delete();
    
                foreach ($images as $image) {
                    $imgdata = [
                        'property_id' => $property->id,

                        'image' => $image->store('properties', $disk)
                    ];
                    PropertyGallery::create($imgdata);
                }
            }
        });
    
        Toastr::success('Property updated successfully');
        return redirect()->route('admin.properties');
    }


    public function delete($id){

        $property = Property::find($id);
        if(!$property){
            Toastr::error('Property not found');
            return redirect()->route('admin.properties');
        }
        $property->delete();
        Toastr::success('Property deleted successfully');
        return redirect()->route('admin.properties');
    }
    

    public function show($id){
        $property = Property::find($id);
        if(!$property){
            Toastr::error('Property not found');
            return redirect()->route('admin.properties');
        }
        return view('admin.pages.properties.show', compact('property'));
    }

    public function ajaxStatusUpdate(Request $request){
        $property = Property::find($request->id);

        // Prevent activating a property whose title is not yet approved
        if ($request->status == 1 && $property->title_verification_status !== 'approved') {
            return response()->json([
                'status'  => 'error',
                'message' => 'Cannot activate property: title document is not yet approved.',
            ], 422);
        }

        $property->status = $request->status;
        $property->save();
        return response()->json(['status' => 'success', 'message' => 'Property status updated successfully']);
    }

    // ── Title Verification (admin-only) ──────────────────────────────────────

    public function titleVerificationIndex()
    {
        if (Auth::guard('admin')->user()->role != '0') {
            Toastr::error('Unauthorized');
            return redirect()->back();
        }
        $properties = Property::whereNotNull('title_document')->latest()->get();
        return view('admin.pages.properties.title-verification', compact('properties'));
    }

    public function titleApprove($id)
    {
        if (Auth::guard('admin')->user()->role != '0') {
            Toastr::error('Unauthorized');
            return redirect()->back();
        }
        $property = Property::findOrFail($id);
        $property->update([
            'title_verification_status' => 'approved',
            'title_rejection_reason'    => null,
        ]);
        Toastr::success('Title document approved.');
        return redirect()->route('admin.title-verification.index');
    }

    public function titleReject(Request $request, $id)
    {
        if (Auth::guard('admin')->user()->role != '0') {
            Toastr::error('Unauthorized');
            return redirect()->back();
        }
        $request->validate(['reason' => 'required|string|max:500']);
        $property = Property::findOrFail($id);
        $property->update([
            'title_verification_status' => 'rejected',
            'title_rejection_reason'    => $request->reason,
            'status'                    => 0, // deactivate if active
        ]);
        Toastr::success('Title document rejected.');
        return redirect()->route('admin.title-verification.index');
    }

    public function titleDocumentView($id)
    {
        if (Auth::guard('admin')->user()->role != '0') {
            abort(403);
        }
        $property = Property::findOrFail($id);
        abort_if(!$property->title_document, 404);

        $path = storage_path('app/' . $property->title_document);
        abort_if(!file_exists($path), 404);

        return response()->file($path);
    }
}
