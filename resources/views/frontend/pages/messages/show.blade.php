@extends('frontend.layouts.frontend')

@section('title', 'Conversation')

@section('content')
    <section class="breadcrumb padding-y-120">
        <img src="{{ asset('frontend/assets/images/thumbs/breadcrumb-img.png') }}" alt="" class="breadcrumb__img">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb__wrapper">
                        <h2 class="breadcrumb__title">Conversation</h2>
                        <ul class="breadcrumb__list">
                            <li class="breadcrumb__item"><a href="{{ route('home') }}" class="breadcrumb__link"><i class="las la-home"></i> Home</a></li>
                            <li class="breadcrumb__item"><i class="fas fa-angle-right"></i></li>
                            <li class="breadcrumb__item"><a href="{{ route('messages.index') }}" class="breadcrumb__link">Messages</a></li>
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
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                        <div>
                            <h5 class="mb-1">{{ $conversation->property->name ?? $conversation->subject ?? 'Conversation' }}</h5>
                            <p class="mb-0 text-muted">Landlord: {{ $conversation->landlord->business_name ?? $conversation->landlord->name ?? 'Landlord' }}</p>
                        </div>
                        <a href="{{ route('messages.index') }}" class="btn btn-outline-main">Back to Inbox</a>
                    </div>

                    <div class="border rounded p-3 mb-4" style="max-height: 480px; overflow-y: auto; background: #fafafa;">
                        @foreach ($conversation->messages->sortBy('created_at') as $message)
                            <div class="mb-3 d-flex {{ $message->sender_type === 'tenant' ? 'justify-content-end' : 'justify-content-start' }}">
                                <div class="p-3 rounded" style="max-width: 75%; background: {{ $message->sender_type === 'tenant' ? '#ffe8d2' : '#fff' }}; border: 1px solid #ececec;">
                                    <div class="fw-semibold mb-1">{{ $message->sender_type === 'tenant' ? 'You' : ($conversation->landlord->business_name ?? $conversation->landlord->name ?? 'Landlord') }}</div>
                                    <div>{{ $message->message }}</div>
                                    <small class="text-muted">{{ $message->created_at->format('M d, Y h:i A') }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <form action="{{ route('messages.store', $conversation) }}" method="POST">
                        @csrf
                        <label for="message" class="form-label">Reply</label>
                        <textarea name="message" id="message" rows="4" class="common-input" placeholder="Write your message to the landlord..." required>{{ old('message') }}</textarea>
                        <button type="submit" class="btn btn-main mt-3">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
