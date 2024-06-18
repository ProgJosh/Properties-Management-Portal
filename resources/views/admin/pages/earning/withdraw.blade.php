@extends('admin.layouts.admin')

@section('content')
    <div class="row">

        <div class="col-md-12">
            <div class="card table-responsive">

                <table id="withdraw-table" class="table table-striped table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Landlord Info</th>
                            <th>Payment Info</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                             
                            <td>Action</td>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach (@$withdrawals as $key => $withdraw)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ ucwords($withdraw->landlord->name) }} <br>
                                    {{ @$withdraw->landlord->email }} <br>
                                    {{ @$withdraw->landlord->address }} <br>

                                    <a href="https://wa.me/{{ $withdraw->landlord->phone }}" target="_blank"
                                        style="color:rgb(180, 180, 180); font-size: 16px"><i
                                            class="fab fa-whatsapp-square"></i> {{ $withdraw->landlord->phone }} </a>



                                </td>
                                <td>
                                    Payment Method: {{ @$withdraw->landlord->payment_method }} <br>
                                    Bank: {{ @$withdraw->landlord->bank_name }} ,
                                    Branch: {{ @$withdraw->landlord->branch_name }}<br>
                                    Account Name: {{ @$withdraw->landlord->account_name }} <br>
                                    Account Number: {{ @$withdraw->landlord->account_number }}


                                </td>
                                <td>${{ $withdraw->amount }}</td>
                                <td>{{ $withdraw->status == 0 ? 'Pending' : ($withdraw->status == 1 ? 'Approved' : 'Rejected') }}
                                </td>
                                <td>{{ $withdraw->created_at }}</td>
                               
                                <td>
                                    <a href="{{ route('admin.withdraw-approve', $withdraw->id)}}" class="btn btn-primary btn-sm">Approve</a>

                                    <a href="{{ route('admin.withdraw-reject', $withdraw->id)}}" class="btn btn-danger btn-sm" >Reject</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        @endsection


        @push('js')

        <script>
                $(document).ready(function(){
    
    $("#withdraw-table").DataTable();

});
        </script>
            
        @endpush