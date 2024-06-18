<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <title>{{ config('app.name', 'Property Management Portal') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        
      
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico')}}">
        <!-- third party css -->
        <link href="{{ asset('assets/libs/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/libs/datatables/buttons.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/libs/datatables/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/icons.min.css')}} " rel="stylesheet" type="text/css" />
        <link href=" {{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{asset('assets/css/toastr.min.css')}}">

        @stack('css')

    </head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            
            <!-- Topbar Start -->
            @include('admin.components.top-bar')
            <!-- end Topbar -->

            
            <!-- ========== Left Sidebar Start ========== -->
          @include('admin.components.side-bar')
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    
                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        
                                    </div>
                                    <h4 class="page-title"> Property Management System </h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                     
    
    
    
                          @yield('content')
    
                        
                    </div> <!-- end container-fluid -->

                </div> <!-- end content -->

                

                <!-- Footer Start -->
            @include('admin.components.footer')
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->

       

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="{{ asset('assets/js/vendor.min.js')}}"></script>

        

        <!-- Datatables init -->
        <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>
        

          <!-- Init js -->
          <script src="{{asset('assets/libs/datatables/jquery.dataTables.min.js')}}"></script>
          <script src="{{asset('assets/libs/datatables/dataTables.bootstrap4.min.js')}}"></script>
          <!-- Buttons examples -->
          <script src="{{asset('assets/libs/datatables/dataTables.buttons.min.js')}}"></script>
          <script src="{{asset('assets/libs/datatables/buttons.bootstrap4.min.js')}}"></script>
          <script src="{{asset('assets/libs/jszip/jszip.min.js')}}"></script>
          <script src="{{asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>
          <script src="{{asset('assets/libs/pdfmake/vfs_fonts.js')}}"></script>
          <script src="{{asset('assets/libs/datatables/buttons.html5.min.js')}}"></script>
          <script src="{{asset('assets/libs/datatables/buttons.print.min.js')}}"></script>
  
          <!-- Responsive examples -->
          <script src="{{asset('assets/libs/datatables/dataTables.responsive.min.js')}}"></script>
          <script src="{{asset('assets/libs/datatables/responsive.bootstrap4.min.js')}}"></script>
  
          <!-- Datatables init -->
           
        <!-- App js -->
        <script src="{{ asset('assets/js/app.min.js')}}"></script>

        <script src="{{asset('assets/js/toastr.js')}}"></script>
        {!! Toastr::message() !!}

        @stack('js')
        
    </body>
</html>