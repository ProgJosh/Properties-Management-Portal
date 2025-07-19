@extends('admin.layouts.admin')

@section('content') 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-8 col-xl-8">
            <div class="card bg-pattern">

                <div class="card-body p-4">
                    
              

                    <form action="{{route('admin.profile.change-password-update')}}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="form-group mb-3">
                            

                            <label for="old_password">Old Password</label>
                            <input class="form-control" type="password" required="" id="old_password" name="old_password" placeholder="Enter your password">


                            @error('old_password')
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