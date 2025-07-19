@extends('admin.layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-6 col-xl-12">
        <div class="card-box tilebox-one">
            
          
            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="card-box tilebox-one">
                        <i class="fe-box float-right"></i>
                        <h5 class="text-muted text-uppercase mb-3 mt-0">Total Properties</h5>
                        <h3 class="mb-3" data-plugin="counterup"> {{ $tatalProperty}}</h3>
                        
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card-box tilebox-one">
                        <i class="fe-layers float-right"></i>
                        <h5 class="text-muted text-uppercase mb-3 mt-0"> Total Bookings</h5>
                        <h3 class="mb-3"><span data-plugin="counterup"> {{ $totalBooked}}</span></h3>
                         
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card-box tilebox-one">
                        <i class="fe-tag float-right"></i>
                        <h5 class="text-muted text-uppercase mb-3 mt-0"> Total Selling Amount</h5>
                        <h3 class="mb-3">₱<span data-plugin="counterup"> {{ $totalAmount}}</span></h3>
                        
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card-box tilebox-one">
                        <i class="fe-briefcase float-right"></i>
                        <h5 class="text-muted text-uppercase mb-3 mt-0"> Total Revenue</h5>
                        <h3 class="mb-3">₱<span data-plugin="counterup"> {{ round($revenue )}}</span></h3>
                        <span class="badge badge-primary"> 10% </span> <span class="text-muted ml-2 vertical-middle">  </span>
                    </div>
                </div>

                @if (Auth::user()->role == 0)
                @php
                $totalLandloadr = App\Models\Admin::where('role' , 1)->count();
            @endphp

            <div class="col-md-6 col-xl-3">
                <div class="card-box tilebox-one">
                    <i class="fas fa-house-damage float-right"></i>
                    <h5 class="text-muted text-uppercase mb-3 mt-0"> Total Landlord</h5>
                    <h3 class="mb-3"><span data-plugin="counterup"> {{ $totalLandloadr}}</span></h3>
                    
                </div>
            </div>
            @php
                $totalTenant = App\Models\User::count();
            @endphp

            <div class="col-md-6 col-xl-3">
                <div class="card-box tilebox-one">
                    <i class="fe-user float-right"></i>
                    <h5 class="text-muted text-uppercase mb-3 mt-0"> Total Tenants</h5>
                    <h3 class="mb-3"><span data-plugin="counterup"> {{ $totalTenant}}</span></h3>
                    
                </div>
            </div>
                @endif

               
                
            </div>

        </div>

        </div>
    </div>

    
</div>

@endsection





{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div>
</x-app-layout> --}}
