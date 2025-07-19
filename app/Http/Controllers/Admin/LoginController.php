<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAdminRequest;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Booking;
use App\Models\Payment;

use App\Models\Property;



class LoginController extends Controller
{
    public function showLoginForm(){

        if(Auth::guard('admin')->check()){
            return redirect()->route('admin.dashboard');
        }

        return view ('admin.pages.auth.login');
    }


    public function showRegistrationForm(){
        if(Auth::guard('admin')->check()){
            return redirect()->route('admin.dashboard');
        }
        return view ('admin.pages.auth.register');
    }

    public function register(StoreAdminRequest $request){
        
        $data = $request->all();

       
        $data['password'] = bcrypt($data['password']);
        $admin = Admin::create($data);
      
        Auth::guard('admin')->login($admin);
      
     

        Toastr::success('Registration Successfull');


        return redirect()->route('admin.dashboard');
    }

    public function login(Request $request){
      
        $data = $request->only('email', 'password');


        if(Auth::guard('admin')->attempt($data)){
            return redirect()->route('admin.dashboard');
        }

    
        Toastr::error('Invalid Credentials');
        return redirect()->back();
    }


    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function dashboard(){

        if(Auth::user()->role == '0'){
            $tatalProperty = Property::count();
            $totalBooked = Booking::count();
            $totalAmount = Payment::sum('amount');
            $revenue = $totalAmount * 0.10;
            
        }else{
            $landlordid = Auth::user()->id;
    
            $properyByLanlord = Property::where('landlord_id', $landlordid)->get();


            $tatalProperty = $properyByLanlord->count();
            $totalBooked = Booking::query()
                        ->whereIn('property_id', $properyByLanlord->pluck('id'))
                        ->count(); 

            $booking_ids = Booking::query()
                    ->whereIn('property_id', $properyByLanlord->pluck('id'))
                    ->pluck('id');


            $totalAmount = Payment::query()
                    ->whereIn('booking_id', $booking_ids)
                    ->sum('amount');

 
        $revenue = $totalAmount - ($totalAmount * 0.10);
        };

        
     

        return view('admin.pages.dashboard', compact('tatalProperty', 'totalBooked', 'totalAmount', 'revenue'));
    }


    public function profile(){
        
    $admin = Admin::find(Auth::user()->id);
    
  
    return view('admin.pages.auth.profile', compact('admin'));
    }


    public function profilePersonalInfo(){
        $admin = Admin::find(Auth::user()->id);
        return view('admin.pages.auth.personal-info', compact('admin'));
    }

    public function profilePersonalInfoUpdate(Request $request){
          
       
          $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'dob' => 'nullable|date',
            'gender' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            $tmpimgpath = $request->file('image')->store('public/admin');
            $imgpath = str_replace('public/', '', $tmpimgpath);
        }
      
        $admin = Admin::find(Auth::user()->id);
        $admin->name = $request->name;
        $admin->phone = $request->phone;
        $admin->address = $request->address;
        $admin->dob = $request->dob;
        $admin->gender = $request->gender;

        if(!empty($imgpath)){
            $admin->image = $imgpath;
        }
        $admin->save();

        Toastr::success('Information Updated Successfully');
        return redirect()->route('admin.profile');
        


    }


    public function profilePaymentInfo(){
        $admin = Admin::find(Auth::user()->id);
        return view('admin.pages.auth.payment-info', compact('admin'));
    }

    public function profilePaymentInfoUpdate(Request $request){
        $validated = $request->validate([   
            'payment_method' => 'required',
            'account_name' => 'required',
            'account_number' => 'required',
            'bank_name' => 'required',
        ]);

        
        $admin = Admin::find(Auth::user()->id);
        $admin->payment_method = $request->payment_method;
        $admin->bank_name = $request->bank_name;
        $admin->branch_name = $request->branch_name;
        $admin->account_name = $request->account_name;
        $admin->account_number = $request->account_number;
       
        $admin->save();
        Toastr::success('Information Updated Successfully');
        return redirect()->route('admin.profile');
    }

    public function profileChangePassword(){
        $admin = Admin::find(Auth::user()->id);
        return view('admin.pages.auth.change-password', compact('admin'));
    }

    public function profileChangePasswordUpdate(Request $request){
        
        $validated = $request->validate([   
            'old_password' => 'required',
            'password' => 'required|min:8',
        ]);
 
        $admin = Admin::find(Auth::user()->id);
        if(Hash::check($request->old_password, $admin->password)){
            $admin->password = bcrypt($request->password);
            $admin->save();
            Toastr::success('Password Updated Successfully');
            return redirect()->route('admin.profile');
        }else{
            Toastr::error('Old Password does not match');
            return redirect()->route('admin.dashboard');
        }
    }
}
