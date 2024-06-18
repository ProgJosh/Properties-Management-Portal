@extends('admin.layouts.admin')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <h3>Profile Information</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('storage/' . @$admin->image) }}" alt="Image" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                <h4 class="card-title">{{ $admin->name }}</h4>
                <p>Date of Birth: {{ @$admin->dob }}</p>
                <p>Gender: {{ $admin->gender }}</p>
                <p>Email: {{ $admin->email }}</p>
                <p>Phone: {{ $admin->phone }}</p>
                <p>Address: {{ @$admin->address }}</p>
                <p>Date of Birth: {{ @$admin->dob }}</p>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Payment Information</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Payment Method:</strong> {{ @$admin->payment_method }}</p>
                        <p><strong>Bank Name:</strong> {{ @$admin->bank_name }}</p>
                        <p><strong>Branch Name:</strong> {{ @$admin->branch_name }}</p>
                        <p><strong>Account Name:</strong> {{ @$admin->account_name }}</p>
                        <p><strong>Account Number:</strong> {{ @$admin->account_number }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
