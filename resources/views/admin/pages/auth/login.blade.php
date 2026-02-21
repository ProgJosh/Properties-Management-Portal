
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('frontend/assets/images/logo/system-logo.png') }}">

        <!-- App css -->
        <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
        
        <!-- Font Awesome for Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
        
        <style>
            /* Password Toggle Styling */
            .password-wrapper {
                position: relative;
            }

            .password-toggle {
                position: absolute;
                right: 12px;
                top: 50%;
                transform: translateY(-50%);
                background: none;
                border: none;
                color: #6b7280;
                cursor: pointer;
                padding: 5px;
                font-size: 18px;
                transition: color 0.3s ease;
            }

            .password-toggle:hover {
                color: #374151;
            }

            .password-toggle:focus {
                outline: none;
            }

            .password-wrapper .form-control {
                padding-right: 45px;
            }
        </style>
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
                                            <span><img src="{{ asset('frontend/assets/images/logo/system-logo.png') }}" alt="" width="75"></span>
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
                                            <div class="password-wrapper">
                                                <input class="form-control" type="password" name="password" required="" id="password" placeholder="Enter your password">
                                                <button type="button" class="password-toggle" id="togglePassword">
                                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                                </button>
                                            </div>
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
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js/app.min.js') }}"></script>
        <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        {!! Toastr::message() !!}
        
        <script>
            // set CSRF header for AJAX requests
            document.addEventListener('DOMContentLoaded', function() {
                var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                if (window.axios) window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
                if (window.jQuery) $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': token } });
                // ...existing password-toggle code...
            });

            // Password Toggle Functionality
            document.addEventListener('DOMContentLoaded', function() {
                var togglePassword = document.getElementById('togglePassword');
                var passwordInput = document.getElementById('password');
                var toggleIcon = document.getElementById('toggleIcon');
                
                if (togglePassword && passwordInput && toggleIcon) {
                    togglePassword.addEventListener('click', function() {
                        // Toggle password visibility
                        if (passwordInput.type === 'password') {
                            passwordInput.type = 'text';
                            toggleIcon.classList.remove('fa-eye');
                            toggleIcon.classList.add('fa-eye-slash');
                        } else {
                            passwordInput.type = 'password';
                            toggleIcon.classList.remove('fa-eye-slash');
                            toggleIcon.classList.add('fa-eye');
                        }
                    });
                }
            });
        </script>
    </body>
</html>