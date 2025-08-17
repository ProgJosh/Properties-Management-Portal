<<<<<<< HEAD
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Property;
use App\Models\Booking;
use App\Models\Payment;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Models\Withdraw;

class EarningsController extends Controller
{
    public function index()
    {

      
        $landlordid = Auth::user()->id;
    
        $properyByLanlord = Property::where('landlord_id', $landlordid)->get();

        $booking_ids = Booking::query()
        ->whereIn('property_id', $properyByLanlord->pluck('id'))
        ->pluck('id');

        $totalAmount = Payment::query()
                    ->whereIn('booking_id', $booking_ids)
                    ->sum('amount');

 

    $revenue = $totalAmount - ($totalAmount * 0.10);

    $withdrawals = Withdraw::where('landlord_id', $landlordid)->latest()->get();
    $balance = round($revenue) - $withdrawals->sum('amount');

        return view('admin.pages.earning.index' , compact('totalAmount', 'revenue', 'withdrawals', 'balance'));
    }


    public function withdraw(Request $request){

        if(Auth::user()->payment_method == null || Auth::user()->bank_name == null || Auth::user()->account_number == null){
            Toastr::error('Please update your profile first to send withdraw request');
            return redirect()->back();
        }
        $data = $request->except('_token');
        $data['landlord_id'] = Auth::user()->id;
        Withdraw::create($data);
        Toastr::success('Withdraw request sent successfully');
        return redirect()->back();
    }


    public function withdrawRequests(){


        if(Auth::user()->role == '1'){
            Toastr::error('Only Admin can see withdraw requests');
            return redirect()->back();
        }

        $withdrawals = Withdraw::latest()->get()->load('landlord');
        return view('admin.pages.earning.withdraw', compact('withdrawals'));
    }


    public function withdrawApprove($id){

        if(Auth::user()->role == '1'){
            Toastr::error('Only Admin can approve withdraw requests');
            return redirect()->back();
        }


        $withdraw = Withdraw::find($id);
        $withdraw->status = 1;
        $withdraw->save();
        Toastr::success('Withdraw request approved successfully');
        return redirect()->back();
    }

    public function withdrawReject($id){
        $withdraw = Withdraw::find($id);
        $withdraw->status = 2;
        $withdraw->save();
        Toastr::success('Withdraw request rejected successfully');
        return redirect()->back();
    }
}
=======
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Property;
use App\Models\Booking;
use App\Models\Payment;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Models\Withdraw;

class EarningsController extends Controller
{
    public function index()
    {

      
        $landlordid = Auth::user()->id;
    
        $properyByLanlord = Property::where('landlord_id', $landlordid)->get();

        $booking_ids = Booking::query()
        ->whereIn('property_id', $properyByLanlord->pluck('id'))
        ->pluck('id');

        $totalAmount = Payment::query()
                    ->whereIn('booking_id', $booking_ids)
                    ->sum('amount');

 

    $revenue = $totalAmount - ($totalAmount * 0.10);

    $withdrawals = Withdraw::where('landlord_id', $landlordid)->latest()->get();
    $balance = round($revenue) - $withdrawals->sum('amount');

        return view('admin.pages.earning.index' , compact('totalAmount', 'revenue', 'withdrawals', 'balance'));
    }


    public function withdraw(Request $request){

        if(Auth::user()->payment_method == null || Auth::user()->bank_name == null || Auth::user()->account_number == null){
            Toastr::error('Please update your profile first to send withdraw request');
            return redirect()->back();
        }
        $data = $request->except('_token');
        $data['landlord_id'] = Auth::user()->id;
        Withdraw::create($data);
        Toastr::success('Withdraw request sent successfully');
        return redirect()->back();
    }


    public function withdrawRequests(){


        if(Auth::user()->role == '1'){
            Toastr::error('Only Admin can see withdraw requests');
            return redirect()->back();
        }

        $withdrawals = Withdraw::latest()->get()->load('landlord');
        return view('admin.pages.earning.withdraw', compact('withdrawals'));
    }


    public function withdrawApprove($id){

        if(Auth::user()->role == '1'){
            Toastr::error('Only Admin can approve withdraw requests');
            return redirect()->back();
        }


        $withdraw = Withdraw::find($id);
        $withdraw->status = 1;
        $withdraw->save();
        Toastr::success('Withdraw request approved successfully');
        return redirect()->back();
    }

    public function withdrawReject($id){
        $withdraw = Withdraw::find($id);
        $withdraw->status = 2;
        $withdraw->save();
        Toastr::success('Withdraw request rejected successfully');
        return redirect()->back();
    }
}
>>>>>>> 4d626894314be39286e444578073dd7e4c5bad0a
