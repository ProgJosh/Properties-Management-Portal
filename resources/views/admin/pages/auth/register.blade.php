<<<<<<< HEAD

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Landlords Register</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href= {{asset('assets/images/favicon.ico')}}>

        <!-- App css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/icons.min.css" rel="stylesheet')}}" type="text/css" />
        <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />

    </head>

    <body class="authentication-bg bg-gradient">

            <div class="account-pages mt-2 pt-2 mb-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-8 col-xl-8">
                            <div class="card bg-pattern">
    
                                <div class="card-body p-4">
                                    
                                    <div class="text-center w-75 m-auto">
                                        <a href="">
                                            <span><img src="{{asset('frontend/assets/images/logo/logo-1.jpeg')}}" alt="" width="80"></span>
                                        </a>
                                        <h5 class="text-uppercase text-center font-bold mt-4">Landlords Register</h5>

                                    </div>
    
                                    <form action="{{route('admin.register')}}" method="POST" enctype="multipart/form-data">

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
                                            <label for="gender">Gender</label>
                                            <select class="form-control" id="gender" value="{{old('gender')}}" name="gender" required="">
                                                <option value="">Select Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>


                                            @error('gender')
                                                <span class="text-danger">{{$message}}</span>
                                                
                                            @enderror


                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="dob">Date of Birth</label>
                                            <input class="form-control" type="date" id="dob" name="dob" value="{{old('dob')}}" required="">


                                            @error('dob')   
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
                                            <button class="btn btn-gradient btn-block" type="submit"> Log In </button>
                                        </div>
    
                                    </form>
    
                                    <div class="row mt-4">
                                            <div class="col-sm-12 text-center">
                                                <p class="text-muted mb-0">Already have an account? <a href="{{route('admin.login')}}" class="text-dark ml-1"><b>Sign in</b></a></p>
                                            </div>
                                        </div>

    
                                </div> <!-- end card-body -->
                            </div>
                            <!-- end card -->
    
                       
    
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>
            <!-- end page -->


        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>
=======

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Landlords Register</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href= {{asset('frontend/assets/images/logo/PMPLOGO-removebg-.png')}}>

        <!-- App css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/icons.min.css" rel="stylesheet')}}" type="text/css" />
        <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />

    </head>

    <body class="authentication-bg bg-gradient">

            <div class="account-pages mt-2 pt-2 mb-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-8 col-xl-8">
                            <div class="card bg-pattern">
    
                                <div class="card-body p-4">
                                    
                                    <div class="text-center w-75 m-auto">
                                        <a href="">
                                            <span><img src="{{asset('frontend/assets/images/logo/PMPLOGO-removebg-.png')}}" alt="" width="80"></span>
                                        </a>
                                        <h5 class="text-uppercase text-center font-bold mt-4">Landlords Register</h5>

                                    </div>
    
                                    <form action="{{route('admin.register')}}" method="POST" enctype="multipart/form-data">

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
                                            <label for="gender">Gender</label>
                                            <select class="form-control" id="gender" value="{{old('gender')}}" name="gender" required="">
                                                <option value="">Select Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>


                                            @error('gender')
                                                <span class="text-danger">{{$message}}</span>
                                                
                                            @enderror


                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="dob">Date of Birth</label>
                                            <input class="form-control" type="date" id="dob" name="dob" value="{{old('dob')}}" required="">


                                            @error('dob')   
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
                                            <button class="btn btn-gradient btn-block" type="submit"> Log In </button>
                                        </div>
    
                                    </form>
    
                                    <div class="row mt-4">
                                            <div class="col-sm-12 text-center">
                                                <p class="text-muted mb-0">Already have an account? <a href="{{route('admin.login')}}" class="text-dark ml-1"><b>Sign in</b></a></p>
                                            </div>
                                        </div>

    
                                </div> <!-- end card-body -->
                            </div>
                            <!-- end card -->
    
                       
    
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>
            <!-- end page -->


        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>
>>>>>>> 4d626894314be39286e444578073dd7e4c5bad0a
</html>