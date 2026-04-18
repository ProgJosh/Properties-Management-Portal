@extends('admin.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Tenant Conversations</h4>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tenant</th>
                                    <th>Property</th>
                                    <th>Last Message</th>
                                    <th>Updated</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($conversations as $conversation)
                                    <tr>
                                        <td>{{ $conversation->tenant->name }}</td>
                                        <td>{{ $conversation->property->name ?? '-' }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit(optional($conversation->latestMessage)->message ?? 'No messages yet.', 80) }}</td>
                                        <td>{{ optional($conversation->last_message_at)->diffForHumans() ?? $conversation->updated_at->diffForHumans() }}</td>
                                        <td><a href="{{ route('admin.messages.show', $conversation) }}" class="btn btn-primary btn-sm">Open</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No tenant conversations yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
