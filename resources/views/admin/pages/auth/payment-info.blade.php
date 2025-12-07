<<<<<<< HEAD
 
@extends('admin.layouts.admin')

@section('content')
<div class="account-pages mt-2 pt-2 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card bg-pattern">

                    <div class="card-body p-4">
                        
                       

                        <form action="{{route('admin.profile.payment-info-update')}}" method="POST" enctype="multipart/form-data" class="form-horizontal">

                            @csrf
                            <div class="row">

                                
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="payment_method">Payment Method</label>
                                        <select name="payment_method" class="form-control" id="">
                                            <option value="" disabled >Select Payment Method</option>
                                            <option value="bank" {{ @$admin->payment_method == 'bank' ? 'selected' : '' }}>Bank</option>
                                           
                                        </select>
        
                                        @error('payment_method')
                                            <span class="text-danger">{{$message}}</span>
                                            
                                        @enderror
        
        
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="bank_name">Bank Name</label>
                                        <input class="form-control" type="text" id="bank_name" name="bank_name" value="{{ @$admin->bank_name}}" required="" >
        
                                        @error('bank_name')
                                            <span class="text-danger">{{$message}}</span>
                                            
                                        @enderror
        
        
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="branch_name"> Branch Name</label>
                                        <input class="form-control" type="text" name="branch_name" id="branch_name"  value="{{ @$admin->branch_name}}" required>
        
                                        @error('branch_name')
                                            <span class="text-danger">{{$message}}</span>
                                            
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="account_name"> Account Name</label>
                                        <input class="form-control" type="tel" id="account_name" name="account_name" value="{{ @$admin->account_name}}" required="" >
        
                                        @error('account_name')
                                            <span class="text-danger">{{$message}}</span>
                                            
                                        @enderror
        
        
                                    </div>
                                </div>

                                
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                            

                                        <label for="account_number"> Account Number</label>
                                        <input class="form-control" type="text" required="" id="account_number" name="account_number"  value="{{@$admin->account_number}}">


                                        @error('account_number')
                                            <span class="text-danger">{{$address}}</span>
                                            
                                        @enderror
                                    </div>
                                </div>

                                



                            </div>
                       

    

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-gradient btn-block" type="submit"> Update </button>
                            </div>

                        </form>

                  


                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

           

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>

@endsection


=======
 
@extends('admin.layouts.admin')

@section('content')
<div class="account-pages mt-2 pt-2 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card bg-pattern">

                    <div class="card-body p-4">
                        
                       

                        <form action="{{route('admin.profile.payment-info-update')}}" method="POST" enctype="multipart/form-data" class="form-horizontal">

                            @csrf
                            <div class="row">

                                
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="payment_method">Payement Method</label>
                                        <select name="payment_method" class="form-control" id="">
                                            <option value="" disabled >Select Payment Method</option>
                                            <option value="bank" {{ @$admin->payment_method == 'bank' ? 'selected' : '' }}>Bank</option>
                                           
                                        </select>
        
                                        @error('payment_method')
                                            <span class="text-danger">{{$message}}</span>
                                            
                                        @enderror
        
        
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="bank_name">Bank Name</label>
                                        <input class="form-control" type="text" id="bank_name" name="bank_name" value="{{ @$admin->bank_name}}" required="" >
        
                                        @error('bank_name')
                                            <span class="text-danger">{{$message}}</span>
                                            
                                        @enderror
        
        
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="branch_name"> Branch Name</label>
                                        <input class="form-control" type="text" name="branch_name" id="branch_name"  value="{{ @$admin->branch_name}}" required>
        
                                        @error('branch_name')
                                            <span class="text-danger">{{$message}}</span>
                                            
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="account_name"> Account Name</label>
                                        <input class="form-control" type="tel" id="account_name" name="account_name" value="{{ @$admin->account_name}}" required="" >
        
                                        @error('account_name')
                                            <span class="text-danger">{{$message}}</span>
                                            
                                        @enderror
        
        
                                    </div>
                                </div>

                                
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                            

                                        <label for="account_number"> Account Number</label>
                                        <input class="form-control" type="text" required="" id="account_number" name="account_number"  value="{{@$admin->account_number}}">


                                        @error('account_number')
                                            <span class="text-danger">{{$address}}</span>
                                            
                                        @enderror
                                    </div>
                                </div>

                                



                            </div>
                       

    

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-gradient btn-block" type="submit"> Update </button>
                            </div>

                        </form>

                  


                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

           

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>

@endsection


>>>>>>> 4d626894314be39286e444578073dd7e4c5bad0a
