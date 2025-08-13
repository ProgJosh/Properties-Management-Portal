<div class="property-filter">
    <form action="#" method="GET">
        <div class="row gy-4">
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                <label for="location">Location</label>
                <div class="select-has-icon">
                    
                    <select class="form-select common-input common-input--withLeftIcon pill text-gray-800" name="location">
                                    <option value="" disabled>Location</option>
                                    <optgroup label="POBLACION AREA">
                                    <option value="Bancal" {{ old('location') == 'Bancal' ? 'selected' : ''}}>Bancal</option>
                                    <option value="Plaza Burgos" {{ old('location') == 'Plaza Burgos' ? 'selected' : ''}}>Plaza Burgos</option>
                                    <option value="San Nicolas 1st" {{ old('location') == 'San Nicolas 1st' ? 'selected' : ''}}>San Nicolas 1st</option>
                                    <option value="San Pedro" {{ old('location') == 'San Pedro' ? 'selected' : ''}}>San Pedro</option>
                                    <option value="San Rafael" {{ old('location') == 'San Rafael' ? 'selected' : ''}}>San Rafael</option>
                                    <option value="San Roque" {{ old('location') == 'San Roque' ? 'selected' : ''}}>San Roque</option>
                                    <option value="Santa Filomena" {{ old('location') == 'Santa Filomena' ? 'selected' : ''}}>Santa Filomena</option>
                                    <option value="Santo Cristo" {{ old('location') == 'Santo Cristo' ? 'selected' : ''}}>Santo Cristo</option>
                                    <option value="Santo Niño" {{ old('location') == 'Santo Niño' ? 'selected' : ''}}>Santo Niño</option>
                                </optgroup>
                                <optgroup label="PANGULO AREA">
                                    <option value="San Vicente (Ebus)" {{ old('location') == 'San Vicente (Ebus)' ? 'selected' : ''}}>San Vicente (Ebus)</option>
                                    <option value="Lambac" {{ old('location') == 'Lambac' ? 'selected' : ''}}>Lambac</option>
                                    <option value="Magsaysay" {{ old('location') == 'Magsaysay' ? 'selected' : ''}}>Magsaysay</option>
                                    <option value="Maquiapo" {{ old('location') == 'Maquiapo' ? 'selected' : ''}}>Maquiapo</option>
                                    <option value="Natividad" {{ old('location') == 'Natividad' ? 'selected' : ''}}>Natividad</option>
                                    <option value="Pulungmasle" {{ old('location') == 'Pulungmasle' ? 'selected' : ''}}>Pulungmasle</option>
                                    <option value="Rizal" {{ old('location') == 'Rizal' ? 'selected' : ''}}>Rizal</option>
                                    <option value="Ascomo" {{ old('location') == 'Ascomo' ? 'selected' : ''}}>Ascomo</option>
                                    <option value="Jose Abad Santos (Siran)" {{ old('location') == 'Jose Abad Santos (Siran)' ? 'selected' : ''}}>Jose Abad Santos (Siran)</option>
                                </optgroup>
                                <optgroup label="LOCION AREA">
                                    <option value="San Pablo" {{ old('location') == 'San Pablo' ? 'selected' : ''}}>San Pablo</option>
                                    <option value="San Juan 1st" {{ old('location') == 'San Juan 1st' ? 'selected' : ''}}>San Juan 1st</option>
                                    <option value="San Jose" {{ old('location') == 'San Jose' ? 'selected' : ''}}>San Jose</option>
                                    <option value="San Matias" {{ old('location') == 'San Matias' ? 'selected' : ''}}>San Matias</option>
                                    <option value="San Isidro" {{ old('location') == 'San Isidro' ? 'selected' : ''}}>San Isidro</option>
                                    <option value="San Antonio" {{ old('location') == 'San Antonio' ? 'selected' : ''}}>San Antonio</option>
                                </optgroup>
                                <optgroup label="BETIS AREA">
                                    <option value="San Agustin" {{ old('location') == 'San Agustin' ? 'selected' : ''}}>San Agustin</option>
                                    <option value="San Juan Bautista" {{ old('location') == 'San Juan Bautista' ? 'selected' : ''}}>San Juan Bautista</option>
                                    <option value="San Juan Nepomuceno" {{ old('location') == 'San Juan Nepomuceno' ? 'selected' : ''}}>San Juan Nepomuceno</option>
                                    <option value="San Miguel" {{ old('location') == 'San Miguel' ? 'selected' : ''}}>San Miguel</option>
                                    <option value="San Nicolas 2nd" {{ old('location') == 'San Nicolas 2nd' ? 'selected' : ''}}>San Nicolas 2nd</option>
                                    <option value="Santa Ines" {{ old('location') == 'Santa Ines' ? 'selected' : ''}}>Santa Ines</option>
                                    <option value="Santa Ursula" {{ old('location') == 'Santa Ursula' ? 'selected' : ''}}>Santa Ursula</option>
                                </optgroup>
                       
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
