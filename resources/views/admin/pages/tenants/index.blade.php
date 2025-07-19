@extends('admin.layouts.admin')

@section('content')

<div class="row">
    <div class="col-lg-12">
       

        <div class="card-box">
           
           
           
            <div class="table-responsive">

                <table class="table mb-0" id="admin-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>

                            <td>Address</td>
                            <td>Total Booking</td>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                 
                        @foreach ($tenants as $key => $tenant ) 

                        
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td> {{ $tenant->name }} </td>
                            <td> {{ $tenant->email }} </td>
                            <td>   <a href="https://wa.me/{{ @$tenant->userDetails->phone }}" target="_blank"
                                style="color:rgb(180, 180, 180); font-size: 16px"><i
                                    class="fab fa-whatsapp-square"></i> {{ @$tenant->userDetails->phone }} </a> </td>
                           
                           <td>{{ @$tenant->userDetails->address }}</td>

                           @php
                           $bookings = App\Models\Booking::where('user_id', $tenant->id)->get();
                           @endphp
                           <td>{{ count($bookings) }}</td>
                                    <td>
                             
                                <a href="{{ route('admin.tenant.delete', $tenant->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
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




@endsection