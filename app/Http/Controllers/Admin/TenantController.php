<<<<<<< HEAD
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{
    public function tenants()
    {   if(Auth::user()->role != '0'){
        Toastr::error('You are not authorized to perform this action');
        return redirect()->back();
    }
        $tenants = User::all()->load('userDetails');
        return view('admin.pages.tenants.index', compact('tenants'));
    }

    public function tanentDelete($id)
    {   
        if(Auth::user()->role != '0'){
            Toastr::error('You are not authorized to perform this action');
            return redirect()->back();
        }
        $tenant = User::findOrfail($id);
        $tenant->delete();
        Toastr::success('Tenant Deleted Successfully');
        return redirect()->back();
    }
}
=======
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{
    public function tenants()
    {   if(Auth::user()->role != '0'){
        Toastr::error('You are not authorized to perform this action');
        return redirect()->back();
    }
        $tenants = User::all()->load('userDetails');
        return view('admin.pages.tenants.index', compact('tenants'));
    }

    public function tanentDelete($id)
    {   
        if(Auth::user()->role != '0'){
            Toastr::error('You are not authorized to perform this action');
            return redirect()->back();
        }
        $tenant = User::findOrfail($id);
        $tenant->delete();
        Toastr::success('Tenant Deleted Successfully');
        return redirect()->back();
    }
}
>>>>>>> 4d626894314be39286e444578073dd7e4c5bad0a
