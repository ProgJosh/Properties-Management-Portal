<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class TenantController extends Controller
{
    public function tenants()
    {   
        $tenants = User::all()->load('userDetails');
        return view('admin.pages.tenants.index', compact('tenants'));
    }

    public function tanentDelete($id)
    {   
        $tenant = User::findOrfail($id);
        $tenant->delete();
        Toastr::success('Tenant Deleted Successfully');
        return redirect()->back();
    }
}
