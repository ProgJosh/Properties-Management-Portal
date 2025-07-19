@extends('admin.layouts.admin')
@push('css')
    <link href="{{ asset('assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="row">
        <div class="col-md-6 col-xl-12">
            <div class="card-box tilebox-one">

                <h5 class="text-muted text-uppercase mb-3 mt-0">Edit Property</h5>

                <form action="{{ route('admin.property.update', $property->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input class="form-control" type="text" id="name" name="name"
                                    value="{{ $property->name }}" required="" placeholder="Enter property name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group mb-3">
                                <label for="address">Address</label>
                                <input class="form-control" type="text" id="address" name="address"
                                    value="{{ $property->address }}" required="" placeholder="Enter property address">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="price">Price</label>
                                <input class="form-control" type="number" id="price" name="price"
                                    value="{{ $property->price }}" required="" placeholder="Enter property Price">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="location">Location</label>
                                <select name="location" class="form-control" id="">
                                    <option value="guagua" {{ $property->location == 'guagua' ? 'selected' : '' }}>Guagua
                                    </option>
                                    <option value="pampanga" {{ $property->location == 'pampanga' ? 'selected' : '' }}>
                                        pampanga</option>
                                    <option value="philippines"
                                        {{ $property->location == 'philippines' ? 'selected' : '' }}>philippines</option>
                                </select>
                                @error('location')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group mb-3">
                                <label for="bedroom">Bedroom</label>
                                <input class="form-control" type="number" id="bedroom" name="bedroom"
                                    value="{{ $property->bedroom }}" required="" placeholder="Number of bedroom">
                                @error('bedroom')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="bathroom">Bathroom</label>
                                <input class="form-control" type="number" id="bathroom" name="bathroom"
                                    value="{{ $property->bathroom }}" required="" placeholder="Number of bathroom">
                                @error('bathroom')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="description">Description</label>


                                <textarea name="description" class="form-control" id="" cols="30" rows="3">{{ $property->description }}
                            </textarea>


                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                        </div>


                        <div class="col-md-6">



                            <div class="form-group mb-3">
                                <label for="garage">Garage</label>

                                <select name="garage" class="form-control" id="">
                                    <option value="1" {{ $property->garage == 1 ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ $property->garage == 0 ? 'selected' : '' }}>No</option>
                                </select>


                                @error('garage')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="pet_friendly">Is Pet Friendly</label>

                                <select name="pet_friendly" class="form-control" id="">
                                    <option value="1" {{ $property->pet_friendly == 1 ? 'selected' : '' }}>Yes
                                    </option>
                                    <option value="0" {{ $property->pet_friendly == 0 ? 'selected' : '' }}>No</option>
                                </select>


                                @error('pet_friendly')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="accommodation">Accommodation</label>

                                <input class="form-control" type="number" id="accommodation" name="accommodation"
                                    value="{{ $property->accommodation }}" required=""
                                    placeholder="Enter property Accommodation">
                                @error('accommodation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group mb-3">
                                <label for="floor">Floor No</label>

                                <input class="form-control" type="number" id="floor" name="floor"
                                    value="{{ $property->floor }}" required="" placeholder="Enter property floor">
                                @error('floor')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            <div class="form-group mb-3">
                                <label for="type">Type</label>

                                <select name="type" class="form-control" id="">
                                    <option value="Apartment" {{ $property->type == 'Apartment' ? 'selected' : '' }}>
                                        Apartment</option>
                                    <option value="House" {{ $property->type == 'House' ? 'selected' : '' }}> House
                                    </option>
                                    <option value="Land" {{ $property->type == 'Land' ? 'selected' : '' }}> Land
                                    </option>


                                </select>


                                @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            <div class="form-group mb-3">
                                <label for="facility">Facilities</label>


                                <input type="text" id="facility" value="{{ $property->facility }}" name="facility"
                                    data-role="tagsinput" placeholder="Add tags Facility" />



                                @error('facility')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            <div class="form-group mb-3">
                                <label for="thumbnail">Thumbnail image</label>
                                <input class="form-control" type="file" id="thumbnail" name="thumbnail"
                                    value="{{ old('thumbnail') }}" required="">
                                @error('thumbnail')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>


                    </div>




                    <div class="form-group mb-3">
                        <label for="images">Gallery images</label>
                        <input class="form-control" type="file" id="images" name="images[]"
                            value="{{ old('images') }}" multiple>
                        @error('images')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-2">
                        <button class="btn btn-gradient btn-lg" onclick="window.history.back();" style="margin-right: 20px;" type="submit"> Back </button>
                        <button class="btn btn-gradient btn-lg" type="submit"> Update Property </button>
                    </div>

                    









                </form>

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
@endpush
