<<<<<<< HEAD
@extends('admin.layouts.admin')


@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">


                <div class="table-responsive">

                  <table id="properties-table" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Landlord</th>
                                <th>Title</th>
                                <th>Address</th>
                                <th>Bedroom and Bathroom</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($properties as $key => $property)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td> {{ $property->landlord->name }} </td>
                                    <td> {{ $property->name }} </td>
                                    <td> {{ $property->address }} </td>
                                    <td> {{ $property->bedroom }} Bedromm - {{ $property->bathroom }} Bathroom </td>
                                    <td> <img src="{{ asset('storage/' . $property->thumbnail) }}" width="100px"></td>
                                    <td> {{ $property->price }} </td>
                                    <td>

                                        <label class="switch switch-primary">
                                            <input class="switch-input status_change" type="checkbox"
                                                {{ $property->status == 1 ? 'checked' : '' }}
                                                data-flag='{{ $property->status }}' data-id="{{ $property->id }}">
                                            <span class="switch-track"></span>
                                            <span class="switch-thumb"></span>
                                        </label>

                                        
                                         
                                        

                                    </td>
                                    <td>
                                        <a href="{{ route('admin.property.show', $property->id) }}"
                                            class="btn btn-primary btn-sm">View </a>
                                        <a href="{{ route('admin.property.edit', $property->id) }}"
                                            class="btn btn-secondary btn-sm">Edit</a>
                                        <a href="{{ route('admin.property.delete', $property->id) }}"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')">Delete</a>

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

$('.status_change').change(function() {
    var $this = $(this);
    var status = $this.data('flag');
    var id = $this.data('id');
    
    status = status == 1 ? 0 : 1;

    $.ajax({
        type: "post",
        url: "{{ route('admin.property.status') }}",
        data: {
            "_token": "{{ csrf_token() }}",
            "status": status,
            "id": id
        },
        success: function(response) {
            toastr.success(response.message);
            
        },
        error: function(xhr, status, error) {
            toastr.error("An error occurred. Please try again.");
        }
    });
});


$(document).ready(function(){
    
    $("#properties-table").DataTable();

});
      
    

</script>
@endpush
=======
@extends('admin.layouts.admin')


@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">


                <div class="table-responsive">

                  <table id="properties-table" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Landlord</th>
                                <th>Title</th>
                                <th>Address</th>
                                <th>Bedroom and Bathroom</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($properties as $key => $property)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td> {{ $property->landlord->name }} </td>
                                    <td> {{ $property->name }} </td>
                                    <td> {{ $property->address }} </td>
                                    <td> {{ $property->bedroom }} Bedromm - {{ $property->bathroom }} Bathroom </td>
                                    <td> <img src="{{ asset('storage/' . $property->thumbnail) }}" width="100px"></td>
                                    <td> {{ $property->price }} </td>
                                    <td>

                                        <label class="switch switch-primary">
                                            <input class="switch-input status_change" type="checkbox"
                                                {{ $property->status == 1 ? 'checked' : '' }}
                                                data-flag='{{ $property->status }}' data-id="{{ $property->id }}">
                                            <span class="switch-track"></span>
                                            <span class="switch-thumb"></span>
                                        </label>

                                        
                                         
                                        

                                    </td>
                                    <td>
                                        <a href="{{ route('admin.property.show', $property->id) }}"
                                            class="btn btn-primary btn-sm">View </a>
                                        <a href="{{ route('admin.property.edit', $property->id) }}"
                                            class="btn btn-secondary btn-sm">Edit</a>
                                        <a href="{{ route('admin.property.delete', $property->id) }}"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')">Delete</a>

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

$('.status_change').change(function() {
    var $this = $(this);
    var status = $this.data('flag');
    var id = $this.data('id');
    
    status = status == 1 ? 0 : 1;

    $.ajax({
        type: "post",
        url: "{{ route('admin.property.status') }}",
        data: {
            "_token": "{{ csrf_token() }}",
            "status": status,
            "id": id
        },
        success: function(response) {
            toastr.success(response.message);
            
        },
        error: function(xhr, status, error) {
            toastr.error("An error occurred. Please try again.");
        }
    });
});


$(document).ready(function(){
    
    $("#properties-table").DataTable();

});
      
    

</script>
@endpush
>>>>>>> 4d626894314be39286e444578073dd7e4c5bad0a
