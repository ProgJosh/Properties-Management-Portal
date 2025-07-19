@extends('admin.layouts.admin')

@section('content')
<div class="account-pages mt-2 pt-2 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card bg-pattern">

                    <div class="card-body p-4">
                        
                       

                        <form action="{{route('admin.profile.personal-info-update')}}" method="POST" enctype="multipart/form-data" class="form-horizontal">

                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="name">Name</label>
                                        <input class="form-control" type="text" id="name" name="name" value="{{ $admin->name}}" required="" >
        
                                        @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                            
                                        @enderror
        
        
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="emailaddress">Email address</label>
                                        <input class="form-control" type="email" id="emailaddress"  value="{{ $admin->email}}" readonly>
        
                                        @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                            
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="phone">Phone</label>
                                        <input class="form-control" type="tel" id="phone" name="phone" value="{{ $admin->phone}}" required="" >
        
                                        @error('phone')
                                            <span class="text-danger">{{$message}}</span>
                                            
                                        @enderror
        
        
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group mb-3">
                                        <label for="gender">Gender</label>
                                        <select class="form-control" id="gender" name="gender" required="">
                                            <option value="" disabled>Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
        
        
                                        @error('gender')
                                            <span class="text-danger">{{$message}}</span>
                                            
                                        @enderror
        
        
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="dob">Date of Birth</label>
                                        <input class="form-control" type="date" id="dob" name="dob" value="{{ $admin->dob}}" required="">
        
        
                                        @error('dob')   
                                            <span class="text-danger">{{$message}}</span>
        
                                        @enderror
        
        
                                    </div>
        
        
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                            

                                        <label for="address">Address</label>
                                        <input class="form-control" type="text" required="" id="address" name="address"  value="{{@$admin->address}}">


                                        @error('address')
                                            <span class="text-danger">{{$address}}</span>
                                            
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="image">Profile Image</label>
                                        <input type="file" name="image" id="image" class="form-control">
                                        
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
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