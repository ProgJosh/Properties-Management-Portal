@extends('frontend.layouts.frontend')

@section('content')

<section class="breadcrumb padding-y-120">
    <img src="{{asset('frontend/assets/images/thumbs/breadcrumb-img.png')}}" alt="" class="breadcrumb__img">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="breadcrumb__wrapper">
                    <h2 class="breadcrumb__title">GCash Payment</h2>
                    <ul class="breadcrumb__list">
                        <li class="breadcrumb__item"><a href="{{ url('/') }}" class="breadcrumb__link"><i class="las la-home"></i> Home</a></li>
                        <li class="breadcrumb__item"><i class="fas fa-angle-right"></i></li>
                        <li class="breadcrumb__item"><span class="breadcrumb__item-text">Payment</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="payment-section padding-y-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card common-card">
                    <div class="card-body">
                        <h3 class="title mb-4">GCash Payment - Scan QR Code</h3>
                        
                        <div class="text-center mb-4">
                            <p class="text-muted">Please scan the QR code below using GCash app to complete your payment.</p>
                        </div>

                        <div class="text-center mb-4">
                            <img src="{{ $qr_code_url }}" alt="GCash QR Code" class="img-fluid" style="max-width: 300px; border: 1px solid #ddd; padding: 10px; border-radius: 8px;">
                        </div>

                        <div class="alert alert-info" role="alert">
                            <strong>Payment Reference:</strong> {{ $reference_id }}<br>
                            <strong>Amount:</strong> ₱{{ number_format($amount, 2) }}
                        </div>

                        <form action="{{ route('payment.gcash.verify') }}" method="POST">
                            @csrf
                            <input type="hidden" name="reference_id" value="{{ $reference_id }}">
                            <button type="submit" class="btn btn-main w-100">
                                <i class="fas fa-check-circle"></i> I Have Paid
                            </button>
                        </form>

                        <div class="mt-3">
                            <a href="{{ route('checkout') }}" class="btn btn-secondary w-100">
                                <i class="fas fa-arrow-left"></i> Go Back
                            </a>
                        </div>

                        <div class="alert alert-warning mt-3" role="alert">
                            <strong>Note:</strong> This is a demo payment page. In production, integrate with actual GCash API for real-time verification.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
