<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class UserDashboardController extends Controller
{
    public function index()
    {   
        $user = User::find(auth()->user()->id)->load('userDetails');
       
        return view('frontend.pages.dashboard' , compact('user'));
    }


    public function updateProfile(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'dob' => 'nullable|date',
            'gender' => 'nullable',
            'civil_status' => 'nullable',
        ]);

        // Initialize data array
        $data = [];

        // Handle image upload if an image is provided
        if ($request->hasFile('image')) {
            $tmpimgpath = $request->file('image')->store('public/users');
            $data['image'] = str_replace('public/', '', $tmpimgpath);
        }

        // Update user basic info
        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->save();

        // Update user details
        $userDetails = UserDetail::firstOrNew(['user_id' => Auth::id()]);
        $userDetails->phone = $request->phone;
        $userDetails->address = $request->address;
        $userDetails->dob = $request->dob;
        $userDetails->gender = $request->gender;
        $userDetails->civil_status = $request->civil_status;




        // Update image if provided
        if (isset($data['image'])) {
            $userDetails->image = $data['image'];
        }

        $userDetails->save();

        // Success notification
        Toastr::success('Profile Updated Successfully');
        return redirect()->route('dashboard');
    }


    public function updatePassword(Request $request){

        $validated = $request->validate([
            'password' => 'required',
        ]);
        $user = User::find(Auth::id());
        $user->password = bcrypt($request->password);
        $user->save();
        Toastr::success('Password Updated Successfully');
        return redirect()->back();
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
