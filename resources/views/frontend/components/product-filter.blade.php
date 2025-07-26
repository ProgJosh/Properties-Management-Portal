<div class="property-filter">
    <form action="#" method="GET">
        <div class="row gy-4">
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                <label for="location">Location</label>
                <div class="select-has-icon">
                    @php
                    $locations = App\Models\Property::all();
                    $propertyLocations = $locations->pluck('location')->toArray();
                  
                @endphp
                        <select class="form-select common-input common-input--withLeftIcon pill text-gray-800" name="location">
                        <option value="Location" disabled selected>Location</option>
                        <option value="all">All</option>

                        @foreach ($propertyLocations as $location )
                        <option value="{{ $location }}">{{ $location }}</option>
                        @endforeach
                     
                         
                       
                    </select>
                         
                       
                    </select>
                    <span class="input-icon input-icon--left text-gradient">
                        <img src="{{ asset('frontend/assets/images/icons/location.svg') }}" alt="">
                    </span>
                </div>
            </div>


            <div class="col-lg-4 col-md-3 col-sm-6 col-xs-6">
                <div class="">
                    
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label for="">Check in Date</label>
                            <input type="date" name="checkin" class="common-input d-inline" min="{{ date('Y-m-d') }}"> 
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label for="">Check out Date</label>
                            <input type="date" name="checkout"  class="common-input d-inline" min="{{ date('Y-m-d')  }}"> 
                        </div>
                        
                    
                    </div>
                   
                </div>
            </div>

            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                <label for="accommodation">Accommodation</label>
                <div class="select-has-icon">
                    
                    <select class="form-select common-input common-input--withLeftIcon pill text-gray-800" name="accommodation">
                        <option value="accommodation" selected>Person</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>   
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>

                       
                    </select>
                    <span class="input-icon input-icon--left text-gradient">
                        <img src="{{ asset('frontend/assets/images/icons/location.svg') }}" alt="">
                    </span>
                </div>
            </div>
      

            
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">

                @php
                    $propertyTypes = App\Models\Property::all();
                    $types = array_unique($propertyTypes->pluck('type')->toArray());

                @endphp
                <label for="type"> Type </label>
                <div class="select-has-icon">
                    
                    <select class="form-select common-input common-input--withLeftIcon pill text-gray-800" name="type">
                        <option value="Type" disabled selected>Type</option>
                        <option value="apartment">Apartment</option>
                        <option value="boarding ">Boarding </option>
                        <option value="house">House</option>
                        <option value="dormitory">Dormitory</option>
                        @foreach ($types as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                    <span class="input-icon input-icon--left text-gradient">
                        <img src="{{ asset('frontend/assets/images/icons/type.svg') }}" alt="">
                    </span>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                <div class="position-relative">
                    <button type="submit" class="btn btn-main text-uppercase mt-4"> Search </button>
                    <span class="input-icon input-icon--left text-gradient">
                        <img src="{{ asset('frontend/assets/images/icons/filter.svg') }}" alt="">
                    </span>
                </div>
            </div>
        </div>
    </form>
    <div class="property-filter__bottom flx-between gap-2">
        <span class="property-filter__text font-18 text-gray-800">Showing {{ $properties->firstItem() }} -
            {{ $properties->lastItem() }} of {{ $properties->total() }} results</span>
        <div class="d-flex align-items-center gap-2">
            <div class="list-grid d-flex align-items-center gap-2 me-4">
                <button class="list-grid__button grid-button active text-body"><i
                        class="las la-border-all"></i></button>
                <button class="list-grid__button list-button text-body"><i class="las la-list"></i></button>
            </div>
            {{-- <div class="d-flex align-items-center gap-2">
                <span class="property-filter__text font-18 text-gray-800"> Sort by: </span>
                <div class="select-has-icon">
                    <select class="form-select common-input pill text-gray-800 px-3 py-2">
                        <option value="Newest">Newest</option>
                        <option value="Best Seller">Best Seller</option>
                        <option value="Best Match">Best Match</option>
                        <option value="Low Price">Low Price</option>
                        <option value="High Price">High Price</option>
                    </select>
                </div>
            </div> --}}
        </div>
    </div>
</div>
