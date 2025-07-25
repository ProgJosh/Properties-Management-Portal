
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href= {{asset('frontend\assets/images/logo/PMPLOGO-removebg-.png')}}>

        <!-- App css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/icons.min.css" rel="stylesheet')}}" type="text/css" />
        <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    </head>

    <body class="authentication-bg bg-gradient">

            <div class="account-pages mt-5 pt-5 mb-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6 col-xl-5">
                            <div class="card bg-pattern">
    
                                <div class="card-body p-4">
                                    
                                    <div class="text-center w-75 m-auto">
                                        <a href="index.html">
                                            <span><img src="assets/images/logo-light.png" alt="" height="18"></span>
                                        </a>
                                        <h5 class="text-uppercase text-center font-bold mt-4">Sign In</h5>

                                    </div>
    
                                    <form action="{{route('admin.login')}}" method="POST">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label for="emailaddress"  >Email address</label>
                                            <input class="form-control" type="email" name="email" id="emailaddress" required="" placeholder="Enter your email">

                                            @error('email')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror

                                        </div>
    
                                        <div class="form-group mb-3">
                                                <a href="#" class="text-muted float-right"><small>Forgot your password?</small></a>

                                            <label for="password">Password</label>
                                            <input class="form-control" type="password" name="password" required="" id="password" placeholder="Enter your password">
                                        </div>
    
                                        <div class="form-group mb-3">
                                            <div class="custom-control custom-checkbox checkbox-success">
                                                <input type="checkbox" class="custom-control-input" id="checkbox-signin">
                                                <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                            </div>
                                        </div>
    
                                        <div class="form-group mb-0 text-center">
                                            <button class="btn btn-gradient btn-block" type="submit"> Log In </button>
                                        </div>
    
                                    </form>
    
                                    <div class="row mt-4">
                                            <div class="col-sm-12 text-center">
                                                <p class="text-muted mb-0">Don't have an account? <a href=" {{route('admin.register')}}" class="text-dark ml-1"><b>Sign Up</b></a></p>
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
        <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        {!! Toastr::message() !!}
    </body>
</html>