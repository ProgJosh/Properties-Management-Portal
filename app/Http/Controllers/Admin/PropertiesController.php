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
    
        //process image
        $tmpimgpath = $request->file('thumbnail')->store('public/properties');
        $data['thumbnail'] = str_replace('public/', '', $tmpimgpath);
        
        $data['landlord_id'] = auth()->user()->id;
    
        // Remove 'images' key from $data array
        unset($data['images']);
    
        $property = Property::create($data);
    
        //Gather all images
        if($request->hasFile('images')){
            $images = $request->file('images');
            foreach($images as $image){
                $imgdata = [
                    'property_id' => $property->id,
                    'image' => str_replace('public/', '', $image->store('public/properties')),
                ];
                PropertyGallery::create($imgdata);
            }
        }
    
        Toastr::success('Property created successfully');
    
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
    
        if ($request->hasFile('thumbnail')) {
            $imgpath = $request->file('thumbnail')->store('public/properties');
            $data['thumbnail'] = str_replace('public/', '', $imgpath);
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

                        'image' => str_replace('public/', '', $image->store('public/gallery'))
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
        $property->status = $request->status;
        $property->save();
        return response()->json(['status' => 'success', 'message' => 'Property status updated successfully']);
         
    }
    
}
