@extends('admin.layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <h4 class="header-title mb-3">Property Title Verification</h4>

            <div class="table-responsive">
                <table id="title-verification-table" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Property</th>
                            <th>Landlord</th>
                            <th>Submitted</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($properties as $key => $property)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $property->name }}</td>
                            <td>{{ $property->landlord->name }}</td>
                            <td>{{ $property->created_at->format('M d, Y') }}</td>
                            <td>
                                @if($property->title_verification_status === 'approved')
                                    <span class="badge badge-success">&#10003; Approved</span>
                                @elseif($property->title_verification_status === 'rejected')
                                    <span class="badge badge-danger" title="{{ $property->title_rejection_reason }}">&#10007; Rejected</span>
                                @else
                                    <span class="badge badge-warning">&#8987; Pending</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.title-verification.document', $property->id) }}"
                                   target="_blank" class="btn btn-info btn-sm">
                                    <i class="fas fa-file-alt"></i> View Doc
                                </a>

                                @if($property->title_verification_status !== 'approved')
                                <form action="{{ route('admin.title-verification.approve', $property->id) }}"
                                      method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm"
                                            onclick="return confirm('Approve this title document?')">
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                </form>
                                @endif

                                @if($property->title_verification_status !== 'rejected')
                                <button type="button" class="btn btn-danger btn-sm"
                                        data-toggle="modal"
                                        data-target="#rejectModal{{ $property->id }}">
                                    <i class="fas fa-times"></i> Reject
                                </button>

                                <!-- Reject Modal -->
                                <div class="modal fade" id="rejectModal{{ $property->id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.title-verification.reject', $property->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Reject Title Document — {{ $property->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="reason{{ $property->id }}">Reason for Rejection <span class="text-danger">*</span></label>
                                                        <textarea class="form-control" id="reason{{ $property->id }}"
                                                                  name="reason" rows="3" required
                                                                  placeholder="Explain why the document is being rejected..."></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Confirm Reject</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
$(document).ready(function(){
    $("#title-verification-table").DataTable();
});
</script>
@endpush
