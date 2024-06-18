<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Property;
use Brian2694\Toastr\Facades\Toastr;

class LandlordsController extends Controller
{
    public function landlords(){
        $landlords = Admin::latest()->get();
        return view('admin.pages.landlords', compact('landlords'));
    }

    public function SingleLandlordProperties($id){
        $properties = Property::where('landlord_id', $id)->get();

        return view('admin.pages.properties.index', compact('properties'));
    }

    public function adminList(){
        $admins = Admin::where('role', '1')->get();
        return view('admin.pages.admin-list', compact('admins'));
 
    
    }

    public function adminCreate(){

        return view('admin.pages.admin-create');
    }

    public function adminStore(Request $request){
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['required', 'string', 'max:255'],
            
             
        ]);

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->phone = $request->phone;
        $admin->role = 1;
        $admin->save();
        Toastr::success('Admin Created Successfully');
        return redirect()->route('admin.list')->with('success', 'Admin Created Successfully');
    }


    public function adminDelete($id){
        $admin = Admin::find($id);
        $admin->delete();
        Toastr::success('Admin Deleted Successfully');
        return redirect()->back()->with('success', 'Admin Deleted Successfully');
    }
}