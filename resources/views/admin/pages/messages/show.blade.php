@extends('admin.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h4 class="header-title mb-1">{{ $conversation->property->name ?? $conversation->subject ?? 'Conversation' }}</h4>
                            <p class="mb-0 text-muted">Tenant: {{ $conversation->tenant->name }}</p>
                        </div>
                        <a href="{{ route('admin.messages.index') }}" class="btn btn-light">Back</a>
                    </div>

                    <div class="border rounded p-3 mb-4" style="max-height: 520px; overflow-y: auto; background: #f8f9fa;">
                        @foreach ($conversation->messages->sortBy('created_at') as $message)
                            <div class="mb-3 d-flex {{ $message->sender_type === 'landlord' ? 'justify-content-end' : 'justify-content-start' }}">
                                <div class="p-3 rounded border" style="max-width: 75%; background: {{ $message->sender_type === 'landlord' ? '#d9ecff' : '#ffffff' }};">
                                    <strong class="d-block mb-1">{{ $message->sender_type === 'landlord' ? 'You' : $conversation->tenant->name }}</strong>
                                    <div>{{ $message->message }}</div>
                                    <small class="text-muted">{{ $message->created_at->format('M d, Y h:i A') }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <form action="{{ route('admin.messages.store', $conversation) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="message">Reply to tenant</label>
                            <textarea name="message" id="message" rows="4" class="form-control" placeholder="Write your reply..." required>{{ old('message') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Send Reply</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
