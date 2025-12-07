@extends('admin.layouts.admin')

@section('content')

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-8 col-xl-8">
                    <div class="card bg-pattern">

                        <div class="card-body p-4">
                            
                      

                            <form action="{{route('admin.store')}}" method="POST" enctype="multipart/form-data">

                                @csrf
                                <div class="form-group mb-3">
                                    <label for="name">Name</label>
                                    <input class="form-control" type="text" id="name" name="name" value="{{old('name')}}" required="" placeholder="Enter your Name">

                                    @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                        
                                    @enderror


                                </div>


                                <div class="form-group mb-3">
                                    <label for="emailaddress">Email address</label>
                                    <input class="form-control" type="email" id="emailaddress" name="email" value="{{old('email')}}" required="" placeholder="Enter your email">

                                    @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                        
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="phone">Phone</label>
                                    <input class="form-control" type="tel" id="phone" name="phone" value="{{old('phone')}}" required="" placeholder="Enter your phone">

                                    @error('phone')
                                        <span class="text-danger">{{$message}}</span>
                                        
                                    @enderror


                                </div>

                              

                                

                                <div class="form-group mb-3">
                                    

                                    <label for="password">Password</label>
                                    <input class="form-control" type="password" required="" id="password" name="password" placeholder="Enter your password">


                                    @error('password')
                                        <span class="text-danger">{{$message}}</span>
                                        
                                    @enderror
                                </div>


                                 

                                

                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-gradient btn-block" type="submit"> Submit </button>
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
 
@endsection