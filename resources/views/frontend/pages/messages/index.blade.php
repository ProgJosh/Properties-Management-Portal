@extends('frontend.layouts.frontend')

@section('title', 'Messages')

@section('content')
    <section class="breadcrumb padding-y-120">
        <img src="{{ asset('frontend/assets/images/thumbs/breadcrumb-img.png') }}" alt="" class="breadcrumb__img">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb__wrapper">
                        <h2 class="breadcrumb__title">Messages</h2>
                        <ul class="breadcrumb__list">
                            <li class="breadcrumb__item"><a href="{{ route('home') }}" class="breadcrumb__link"><i class="las la-home"></i> Home</a></li>
                            <li class="breadcrumb__item"><i class="fas fa-angle-right"></i></li>
                            <li class="breadcrumb__item"><span class="breadcrumb__item-text">Messages</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="padding-y-60">
        <div class="container container-two">
            <div class="card common-card">
                <div class="card-body">
                    <h5 class="mb-4">Your Conversations</h5>

                    @forelse ($conversations as $conversation)
                        <a href="{{ route('messages.show', $conversation) }}" class="d-block border rounded p-3 mb-3 text-decoration-none text-dark">
                            <div class="d-flex flex-wrap justify-content-between gap-2">
                                <div>
                                    <h6 class="mb-1">{{ $conversation->property->name ?? $conversation->subject ?? 'Conversation' }}</h6>
                                    <p class="mb-1">Landlord: {{ $conversation->landlord->business_name ?? $conversation->landlord->name ?? 'Landlord' }}</p>
                                    <small class="text-muted">
                                        {{ optional($conversation->latestMessage)->message ? \Illuminate\Support\Str::limit($conversation->latestMessage->message, 100) : 'No messages yet.' }}
                                    </small>
                                </div>
                                <div class="text-end">
                                    <small class="text-muted">{{ optional($conversation->last_message_at)->diffForHumans() ?? $conversation->updated_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="alert alert-light border">
                            No conversations yet. Open a property and click <strong>Message Landlord</strong> to start one.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection
