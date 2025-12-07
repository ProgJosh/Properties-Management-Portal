<<<<<<< HEAD
@extends('admin.layouts.admin')

@section('content')

<div class="row">
    <div class="col-lg-12">
       

        <div class="card-box">
            <a href="{{ route('admin.create')}}" class="btn btn-primary btn-sm float-right p-2 mb-3">Add New Admin</a> 
           
           
            <div class="table-responsive">

                <table class="table mb-0" id="admin-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>

                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($admins as $key => $admins ) 
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td> {{ $admins->name }} </td>
                            <td> {{ $admins->email }} </td>
                            <td>   <a href="https://wa.me/{{ $admins->phone }}" target="_blank"
                                style="color:rgb(180, 180, 180); font-size: 16px"><i
                                    class="fab fa-whatsapp-square"></i> {{ $admins->phone }} </a> </td>
                           
                            <td>
                             
                                <a href="{{ route('admin.delete', $admins->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
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
    $("#admin-table").DataTable();
    
});
</script>
    
=======
@extends('admin.layouts.admin')

@section('content')

<div class="row">
    <div class="col-lg-12">
       

        <div class="card-box">
            <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm float-left p-2 mb-4">Back</a> 
            <a href="{{ route('admin.create')}}" class="btn btn-primary btn-sm float-right p-2 mb-3">Add New Admin</a> 
           
           
            <div class="table-responsive">

                <table class="table mb-0" id="admin-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>

                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($admins as $key => $admins ) 
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td> {{ $admins->name }} </td>
                            <td> {{ $admins->email }} </td>
                            <td>   <a href="https://wa.me/{{ $admins->phone }}" target="_blank"
                                style="color:rgb(180, 180, 180); font-size: 16px"><i
                                    class="fab fa-whatsapp-square"></i> {{ $admins->phone }} </a> </td>
                           
                            <td>
                             
                                <a href="{{ route('admin.delete', $admins->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
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
    $("#admin-table").DataTable();
    
});
</script>
    
>>>>>>> 4d626894314be39286e444578073dd7e4c5bad0a
@endpush