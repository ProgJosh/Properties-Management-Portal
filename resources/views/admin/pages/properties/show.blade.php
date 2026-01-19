@extends('admin.layouts.admin')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h4 class="header-title mb-3">Property Details</h4>
                <p>LandLoad : {{ $property->landlord->name }}</p>
            </div>
        </div>

        <div class="col-md-6">
            <h4 class="header-title mb-3">Title : {{ $property->name }}</h4>

            <p class="mb-1">Address : {{ $property->address }}</p>
            @if($property->street)
                <p class="mb-1">Street : {{ $property->street }}</p>
            @endif
            @if($property->purok)
                <p class="mb-1">Purok/Subdivision : {{ $property->purok }}</p>
            @endif
            @if($property->barangay)
                <p class="mb-1">Barangay : {{ $property->barangay }}</p>
            @endif
        </div>

        <div class="col-md-6">
            <h4 class="header-title mb-3">Images</h4>

            <div class="d-flex">
                

                <img src="{{ asset('storage/' . $property->thumbnail) }}" alt="" class="m-1" width="100">

                
                    @if (count($property->gallery) > 0)
                        @foreach ($property->gallery as $key => $image)
                            <img src="{{ asset('storage/' . $image->image) }}" alt="" width="100"
                                class="m-1">
                        @endforeach
                    @endif
                
            </div>

        </div>

    </div>





    <div class="table-responsive">

        <table class="table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Bedroom</th>
                    <th>Bathroom</th>
                    <th>Price</th>
                    <th>Garaze</th>
                    <th>Pet Friendly</th>
                    <th>Acomodation</th>
                    <th>Floor No</th>
                    <th>Type</th>
                    <th>Status</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>{{ $property->bedroom }}</td>
                    <td>{{ $property->bathroom }}</td>
                    <td>{{ $property->price }}</td>
                    <td class="{{ $property->garage ? 'text-success' : 'text-danger' }}">
                        {{ $property->garage ? 'Yes' : 'No' }}</td>
                    <td class="{{ $property->pet_friendly ? 'text-success' : 'text-danger' }}">
                        {{ $property->pet_friendly ? 'Yes' : 'No' }}</td>
                    <td> {{ $property->accommodation }}</td>
                    <td> {{ $property->floor }}</td>
                    <td> {{ $property->type }}</td>
                    <td class="{{ $property->status ? 'text-success' : 'text-danger' }}">
                        {{ $property->status ? 'Active' : 'Inactive' }}</td>

                </tr>

                <tfoot>
                     <tr>
                        <td> Facility </td>
                        <td colspan="9"> {{ $property->facility }}</td>
                     </tr>
                </tfoot>

            </tbody>
        </table>

    </div>



@endsection
