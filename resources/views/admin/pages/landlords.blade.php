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
                              
                                <a href="{{ route('admin.single.landlord', $landlord->id)}}">{{ $landlord->properties->count()  }} </a>
                            
                            </td>
                          
                      
                         
                            <td>
             
                               
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