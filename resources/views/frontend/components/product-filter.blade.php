<div class="property-filter">
    <form action="{{ route('properties') }}" method="GET"
        onsubmit="this.querySelectorAll('input[name], select[name]').forEach(function(field){ if ((field.value || '').trim() === '') { field.removeAttribute('name'); } });">
        <div class="row gy-4">
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                <label for="barangay">Location</label>
                <div class="select-has-icon">
                    
                    <select class="form-select common-input common-input--withLeftIcon pill text-gray-800" name="barangay" id="barangay">
                                    <option value="" {{ !request('barangay') ? 'selected' : '' }}>Select a place to rent</option>
                                    <optgroup label="POBLACION AREA">
                                    <option value="Bancal" {{ request('barangay') == 'Bancal' ? 'selected' : ''}}>Bancal</option>
                                    <option value="Plaza Burgos" {{ request('barangay') == 'Plaza Burgos' ? 'selected' : ''}}>Plaza Burgos</option>
                                    <option value="San Nicolas 1st" {{ request('barangay') == 'San Nicolas 1st' ? 'selected' : ''}}>San Nicolas 1st</option>
                                    <option value="San Pedro" {{ request('barangay') == 'San Pedro' ? 'selected' : ''}}>San Pedro</option>
                                    <option value="San Rafael" {{ request('barangay') == 'San Rafael' ? 'selected' : ''}}>San Rafael</option>
                                    <option value="San Roque" {{ request('barangay') == 'San Roque' ? 'selected' : ''}}>San Roque</option>
                                    <option value="Santa Filomena" {{ request('barangay') == 'Santa Filomena' ? 'selected' : ''}}>Santa Filomena</option>
                                    <option value="Santo Cristo" {{ request('barangay') == 'Santo Cristo' ? 'selected' : ''}}>Santo Cristo</option>
                                    <option value="Santo Niño" {{ request('barangay') == 'Santo Niño' ? 'selected' : ''}}>Santo Niño</option>
                                </optgroup>
                                <optgroup label="PANGULO AREA">
                                    <option value="San Vicente (Ebus)" {{ request('barangay') == 'San Vicente (Ebus)' ? 'selected' : ''}}>San Vicente (Ebus)</option>
                                    <option value="Lambac" {{ request('barangay') == 'Lambac' ? 'selected' : ''}}>Lambac</option>
                                    <option value="Magsaysay" {{ request('barangay') == 'Magsaysay' ? 'selected' : ''}}>Magsaysay</option>
                                    <option value="Maquiapo" {{ request('barangay') == 'Maquiapo' ? 'selected' : ''}}>Maquiapo</option>
                                    <option value="Natividad" {{ request('barangay') == 'Natividad' ? 'selected' : ''}}>Natividad</option>
                                    <option value="Pulungmasle" {{ request('barangay') == 'Pulungmasle' ? 'selected' : ''}}>Pulungmasle</option>
                                    <option value="Rizal" {{ request('barangay') == 'Rizal' ? 'selected' : ''}}>Rizal</option>
                                    <option value="Ascomo" {{ request('barangay') == 'Ascomo' ? 'selected' : ''}}>Ascomo</option>
                                    <option value="Jose Abad Santos (Siran)" {{ request('barangay') == 'Jose Abad Santos (Siran)' ? 'selected' : ''}}>Jose Abad Santos (Siran)</option>
                                </optgroup>
                                <optgroup label="LOCION AREA">
                                    <option value="San Pablo" {{ request('barangay') == 'San Pablo' ? 'selected' : ''}}>San Pablo</option>
                                    <option value="San Juan 1st" {{ request('barangay') == 'San Juan 1st' ? 'selected' : ''}}>San Juan 1st</option>
                                    <option value="San Jose" {{ request('barangay') == 'San Jose' ? 'selected' : ''}}>San Jose</option>
                                    <option value="San Matias" {{ request('barangay') == 'San Matias' ? 'selected' : ''}}>San Matias</option>
                                    <option value="San Isidro" {{ request('barangay') == 'San Isidro' ? 'selected' : ''}}>San Isidro</option>
                                    <option value="San Antonio" {{ request('barangay') == 'San Antonio' ? 'selected' : ''}}>San Antonio</option>
                                </optgroup>
                                <optgroup label="BETIS AREA">
                                    <option value="San Agustin" {{ request('barangay') == 'San Agustin' ? 'selected' : ''}}>San Agustin</option>
                                    <option value="San Juan Bautista" {{ request('barangay') == 'San Juan Bautista' ? 'selected' : ''}}>San Juan Bautista</option>
                                    <option value="San Juan Nepomuceno" {{ request('barangay') == 'San Juan Nepomuceno' ? 'selected' : ''}}>San Juan Nepomuceno</option>
                                    <option value="San Miguel" {{ request('barangay') == 'San Miguel' ? 'selected' : ''}}>San Miguel</option>
                                    <option value="San Nicolas 2nd" {{ request('barangay') == 'San Nicolas 2nd' ? 'selected' : ''}}>San Nicolas 2nd</option>
                                    <option value="Santa Ines" {{ request('barangay') == 'Santa Ines' ? 'selected' : ''}}>Santa Ines</option>
                                    <option value="Santa Ursula" {{ request('barangay') == 'Santa Ursula' ? 'selected' : ''}}>Santa Ursula</option>
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
                            <input type="date" name="checkin" class="common-input d-inline" min="{{ date('Y-m-d') }}" value="{{ request('checkin') }}"> 
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <label for="">Check out Date</label>
                            <input type="date" name="checkout"  class="common-input d-inline" min="{{ date('Y-m-d')  }}" value="{{ request('checkout') }}"> 
                        </div>
                        
                    
                    </div>
                   
                </div>
            </div>

            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                <label for="accommodation">Accommodation</label>
                <div class="select-has-icon">
                    
                    <select class="form-select common-input common-input--withLeftIcon pill text-gray-800" name="accommodation">
                        <option value="" {{ !request()->filled('accommodation') ? 'selected' : '' }}>Person</option>
                        <option value="1" {{ request('accommodation') == '1' ? 'selected' : '' }}>1</option>
                        <option value="2" {{ request('accommodation') == '2' ? 'selected' : '' }}>2</option>
                        <option value="3" {{ request('accommodation') == '3' ? 'selected' : '' }}>3</option>   
                        <option value="4" {{ request('accommodation') == '4' ? 'selected' : '' }}>4</option>
                        <option value="5" {{ request('accommodation') == '5' ? 'selected' : '' }}>5</option>
                        <option value="6" {{ request('accommodation') == '6' ? 'selected' : '' }}>6</option>
                        <option value="7" {{ request('accommodation') == '7' ? 'selected' : '' }}>7</option>
                        <option value="8" {{ request('accommodation') == '8' ? 'selected' : '' }}>8</option>
                        <option value="9" {{ request('accommodation') == '9' ? 'selected' : '' }}>9</option>
                        <option value="10" {{ request('accommodation') == '10' ? 'selected' : '' }}>10</option>

                       
                    </select>
                    <span class="input-icon input-icon--left text-gradient">
                        <img src="{{ asset('frontend/assets/images/icons/user.svg') }}" alt="">
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
                        <option value="" {{ !request('type') ? 'selected' : '' }}>Type</option>
                        <option value="apartment" {{ request('type') == 'apartment' ? 'selected' : '' }}>Apartment</option>
                        <option value="boarding housee " {{ request('type') == 'boarding housee ' ? 'selected' : '' }}>Boarding House</option>
                        <option value="dormitory" {{ request('type') == 'dormitory' ? 'selected' : '' }}>Dormitory</option>
                        @foreach ($types as $type)
                            <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
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
