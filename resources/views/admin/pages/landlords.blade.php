@extends('admin.layouts.admin')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            

            <div class="table-responsive">

                <table class="table mb-0" id="landlord-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Total Properties</th>
                            <th>Status</th>
                            <th>Title Doc</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($landlords as $key => $landlord ) 
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td> {{ $landlord->name }} </td>
                            <td> {{ $landlord->email }} </td>
                            <td>

                                <a href="https://wa.me/{{ $landlord->phone }}" target="_blank"
                                    style="color:rgb(180, 180, 180); font-size: 16px"><i
                                        class="fab fa-whatsapp-square"></i> {{ $landlord->phone }} </a>
                             </td>
                            <td> {{ @$landlord->address }} </td>
                            <td>
                                <a href="{{ route('admin.single.landlord', $landlord->id)}}">{{ $landlord->properties->count() }}</a>
                            </td>
                            <td>
                                @if($landlord->status == 1)
                                    <span class="badge badge-success">Approved</span>
                                @elseif($landlord->status == 2)
                                    <span class="badge badge-danger">Rejected</span>
                                @else
                                    <span class="badge badge-warning">Pending</span>
                                @endif
                            </td>
                            <td>
                                @if($landlord->property_title_document)
                                    <a href="{{ route('admin.landlord.title-document', $landlord->id) }}" target="_blank" class="btn btn-info btn-sm">
                                        <i class="fas fa-file-alt"></i> View
                                    </a>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                @if($landlord->status != 1)
                                <form action="{{ route('admin.landlord.approve', $landlord->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Approve this landlord?')"><i class="fas fa-check"></i> Approve</button>
                                </form>
                                @endif
                                @if($landlord->status != 2)
                                <form action="{{ route('admin.landlord.reject', $landlord->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Reject this landlord?')"><i class="fas fa-times"></i> Reject</button>
                                </form>
                                @endif
                                <a href="{{ route('admin.delete', $landlord->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                        @endforeach

                       
                       
                    </tbody>
                </table>


                
            </div>
        
        </div>

        <div>
           
        </div>



    </div>


</div>



@endSection

@push('js')

<script>
    $(document).ready(function(){
    $("#landlord-table").DataTable();
    
});
</script>
    
@endpush