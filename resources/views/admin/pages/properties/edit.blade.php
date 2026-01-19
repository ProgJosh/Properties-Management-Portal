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
                                <label for="street">Street</label>
                                <input class="form-control" type="text" id="street" name="street"
                                    value="{{ $property->street }}" placeholder="Enter street name">
                                @error('street')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="purok">Purok/Subdivision</label>
                                <input class="form-control" type="text" id="purok" name="purok"
                                    value="{{ $property->purok }}" placeholder="Enter purok or subdivision">
                                @error('purok')
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
                                <label for="barangay">Barangay</label>
                                <select name="barangay" class="form-control" id="barangay">
                                <optgroup label="POBLACION AREA">
                                    <option value="Bancal" {{ $property->barangay == 'Bancal' ? 'selected' : ''}}>Bancal</option>
                                    <option value="Plaza Burgos" {{ old('location') == 'Plaza Burgos' ? 'selected' : ''}}>Plaza Burgos</option>
                                    <option value="San Nicolas 1st" {{ old('location') == 'San Nicolas 1st' ? 'selected' : ''}}>San Nicolas 1st</option>
                                    <option value="San Pedro" {{ $property->barangay == 'San Pedro' ? 'selected' : ''}}>San Pedro</option>
                                    <option value="San Rafael" {{ $property->barangay == 'San Rafael' ? 'selected' : ''}}>San Rafael</option>
                                    <option value="San Roque" {{ $property->barangay == 'San Roque' ? 'selected' : ''}}>San Roque</option>
                                    <option value="Santa Filomena" {{ $property->barangay == 'Santa Filomena' ? 'selected' : ''}}>Santa Filomena</option>
                                    <option value="Santo Cristo" {{ $property->barangay == 'Santo Cristo' ? 'selected' : ''}}>Santo Cristo</option>
                                    <option value="Santo Niño" {{ $property->barangay == 'Santo Niño' ? 'selected' : ''}}>Santo Niño</option>
                                </optgroup>
                                <optgroup label="PANGULO AREA">
                                    <option value="San Vicente (Ebus)" {{ $property->barangay == 'San Vicente (Ebus)' ? 'selected' : ''}}>San Vicente (Ebus)</option>
                                    <option value="Lambac" {{ $property->barangay == 'Lambac' ? 'selected' : ''}}>Lambac</option>
                                    <option value="Magsaysay" {{ $property->barangay == 'Magsaysay' ? 'selected' : ''}}>Magsaysay</option>
                                    <option value="Maquiapo" {{ $property->barangay == 'Maquiapo' ? 'selected' : ''}}>Maquiapo</option>
                                    <option value="Natividad" {{ $property->barangay == 'Natividad' ? 'selected' : ''}}>Natividad</option>
                                    <option value="Pulungmasle" {{ $property->barangay == 'Pulungmasle' ? 'selected' : ''}}>Pulungmasle</option>
                                    <option value="Rizal" {{ $property->barangay == 'Rizal' ? 'selected' : ''}}>Rizal</option>
                                    <option value="Ascomo" {{ $property->barangay == 'Ascomo' ? 'selected' : ''}}>Ascomo</option>
                                    <option value="Jose Abad Santos (Siran)" {{ $property->barangay == 'Jose Abad Santos (Siran)' ? 'selected' : ''}}>Jose Abad Santos (Siran)</option>
                                </optgroup>
                                <optgroup label="LOCION AREA">
                                    <option value="San Pablo" {{ $property->barangay == 'San Pablo' ? 'selected' : ''}}>San Pablo</option>
                                    <option value="San Juan 1st" {{ $property->barangay == 'San Juan 1st' ? 'selected' : ''}}>San Juan 1st</option>
                                    <option value="San Jose" {{ $property->barangay == 'San Jose' ? 'selected' : ''}}>San Jose</option>
                                    <option value="San Matias" {{ $property->barangay == 'San Matias' ? 'selected' : ''}}>San Matias</option>
                                    <option value="San Isidro" {{ $property->barangay == 'San Isidro' ? 'selected' : ''}}>San Isidro</option>
                                    <option value="San Antonio" {{ $property->barangay == 'San Antonio' ? 'selected' : ''}}>San Antonio</option>
                                </optgroup>
                                <optgroup label="BETIS AREA">
                                    <option value="San Agustin" {{ $property->barangay == 'San Agustin' ? 'selected' : ''}}>San Agustin</option>
                                    <option value="San Juan Bautista" {{ $property->barangay == 'San Juan Bautista' ? 'selected' : ''}}>San Juan Bautista</option>
                                    <option value="San Juan Nepomuceno" {{ $property->barangay == 'San Juan Nepomuceno' ? 'selected' : ''}}>San Juan Nepomuceno</option>
                                    <option value="San Miguel" {{ $property->barangay == 'San Miguel' ? 'selected' : ''}}>San Miguel</option>
                                    <option value="San Nicolas 2nd" {{ $property->barangay == 'San Nicolas 2nd' ? 'selected' : ''}}>San Nicolas 2nd</option>
                                    <option value="Santa Ines" {{ $property->barangay == 'Santa Ines' ? 'selected' : ''}}>Santa Ines</option>
                                    <option value="Santa Ursula" {{ $property->barangay == 'Santa Ursula' ? 'selected' : ''}}>Santa Ursula</option>
                                </optgroup>
                            </select>
                                @error('barangay')
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
                                    <option value="Boarding House" {{ $property->type == 'Boarding House' ? 'selected' : '' }}> Boarding House
                                    </option>
                                    <option value="Dormitory" {{ $property->type == 'Dormitory' ? 'selected' : '' }}> Dormitory
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


                    <div class="form-group mb-0">
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
