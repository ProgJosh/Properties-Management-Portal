@extends('admin.layouts.admin')

@section('content')
 
        
        <!-- Start Content-->
        <div class="container-fluid">
            
            <!-- start page title -->
            


            <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            

                            <div class="row">
                                <div class="col-6">
                                  

                                </div><!-- end col -->
                              
                            </div>
                            <!-- end row -->

                            <div class="row mt-3">
                                <div class="col-6">
                                    <h5>Billing Address</h5>

                                    <address>
                                        {{$booked->fname}} {{$booked->lname}} <br>
                                        {{ $booked->address }}<br>
                                        {{ $booked->email }}<br>
                                        <abbr title="Phone">P:</abbr> {{$booked->phone}}
                                    </address>

                                </div>

                                <div class="col-6">
                                    <h5>Booking Information</h5>

                                    <address>
                                        Checkin: {{ $booked->checkin }}<br>
                                        Checkout: {{ $booked->checkout }}<br>
                                        Adults: {{ $booked->adults }}<br>
                                        Kids: {{ @$booked->kids }}
                                    </address>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr><th>#</th>
                                                <th>Property</th>
                                                <th>Payment Method</th>
                                                <th>Unit Cost</th>
                                                <th class="text-right">Total</th>
                                            </tr></thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>
                                                 {{ $booked->property->name }}
                                                </td>
                                                <td> {{  $booked->payments[0]->payment_method}} </td>
                                                <td> ${{ $booked->payments[0]->amount }}.00 </td>
                                                <td class="text-right">$ {{  $booked->payments[0]->amount }}.00</td>
                                            </tr>
                                             
                                            

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="clearfix pt-4">
                                        <h5 class="text-muted">Tenent Address:</h5>

                                        <small>
                                            {{$booked->address}} <br>
                                            Country: {{ $booked->country }},  City: {{ $booked->city }}, <br>
                                             Region: {{ $booked->region }},
                                            Zip Code: {{ $booked->zip_code }}
                                        </small>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="float-right">
                                         
                                        <h4>Paid Amount:  ${{$booked->payments[0]->amount}}.00</h4>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                            <div class="hidden-print mt-4 mb-4">
                                <div class="text-right d-print-none">
                                    <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="fa fa-print mr-1"></i> Print</a>
                                    
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- end row -->


            
            
       

    
 

</div>


@endsection