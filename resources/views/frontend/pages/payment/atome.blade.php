@extends('frontend.layouts.frontend')

@section('content')

<section class="breadcrumb padding-y-120">
    <img src="{{asset('frontend/assets/images/thumbs/breadcrumb-img.png')}}" alt="" class="breadcrumb__img">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="breadcrumb__wrapper">
                    <h2 class="breadcrumb__title">Atome Payment</h2>
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
                        <h3 class="title mb-4">
                            <img src="{{asset('assets/images/payment-logos/atome-logo.svg')}}" alt="Atome" style="max-width: 60px; margin-right: 10px;">
                            Atome Payment
                        </h3>
                        
                        <div class="alert alert-info" role="alert">
                            <strong>Payment Reference:</strong> {{ $reference_id }}<br>
                            <strong>Amount:</strong> ₱{{ number_format($amount, 2) }}
                        </div>

                        <div class="payment-instructions mb-4">
                            <h5>Payment Instructions:</h5>
                            <ol>
                                <li>Download the Atome app or visit atome.ph</li>
                                <li>Sign in or create an account</li>
                                <li>Select "Rent Payment"</li>
                                <li>Enter reference number: <strong>{{ $reference_id }}</strong></li>
                                <li>Review the amount: <strong>₱{{ number_format($amount, 2) }}</strong></li>
                                <li>Split into 3 interest-free installments and complete payment</li>
                            </ol>
                        </div>

                        <div class="alert alert-success" role="alert">
                            <strong>Special Offer:</strong> Pay your rent with Atome and get 3 interest-free installments!
                        </div>

                        <form action="{{ route('payment.atome.verify') }}" method="POST">
                            @csrf
                            <input type="hidden" name="reference_id" value="{{ $reference_id }}">
                            <button type="submit" class="btn btn-main w-100">
                                <i class="fas fa-check-circle"></i> Confirm Payment
                            </button>
                        </form>

                        <div class="mt-3">
                            <a href="{{ route('checkout') }}" class="btn btn-secondary w-100">
                                <i class="fas fa-arrow-left"></i> Go Back
                            </a>
                        </div>

                        <div class="alert alert-warning mt-3" role="alert">
                            <strong>Note:</strong> This is a demo payment page. In production, integrate with actual Atome API for real-time verification.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
