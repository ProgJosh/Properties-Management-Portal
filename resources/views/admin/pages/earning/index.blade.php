<<<<<<< HEAD
@extends('admin.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Available funds
                </div>
                <div class="card-body">

                    <h2 class="text-primary">₱{{ round($balance)}}</h2>
                    <hr>
                    <form action="{{ route('admin.withdraw')}}" method="POST" class="mt-3">
                        @csrf
                        <div class="form-group">
                            <label for="amount">Available to withdraw</label>
                            <input class="form-control" type="number" id="amount" name="amount" value="{{ round($balance) }}"
                                required="" readonly>
                        </div>
                        <button class="btn btn-gradient btn-lg" type="submit">Withdraw amount</button>
                    </form>

                </div>
            </div>

        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Total Earnings 

                </div>
                <div class="card-body">

                    <h2 class="text-primary">₱{{ round($revenue)}}</h2>
                    <hr>
                   

                </div>
            </div>

        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Total Sell
                </div>
                <div class="card-body">

                    <h2 class="text-primary">₱{{ round($totalAmount)}}</h2>
                    <hr>
                  

                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card table-responsive">

                <table id="earning-table" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                       

                        </tr>
                    </thead>
                    <tbody>
                        @foreach (@$withdrawals as $key => $withdraw)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>${{ $withdraw->amount }}</td>
                                <td>{{ $withdraw->status == 0 ? 'Pending' : ($withdraw->status == 1 ? 'Approved' : 'Rejected') }}
                                </td>
                                <td>{{ $withdraw->created_at }}</td>
                               
                            </tr>
                        @endforeach
                    </tbody>
                </table>
               
            </div>
        </div>
    </div>
@endsection


@push('js')

<script>
    $(document).ready(function(){
    
    $("#earning-table").DataTable();

});
</script>
    
=======
@extends('admin.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Available funds
                </div>
                <div class="card-body">

                    <h2 class="text-primary">₱{{ round($balance)}}</h2>
                    <hr>
                    <form action="{{ route('admin.withdraw')}}" method="POST" class="mt-3">
                        @csrf
                        <div class="form-group">
                            <label for="amount">Available to withdraw</label>
                            <input class="form-control" type="number" id="amount" name="amount" value="{{ round($balance) }}"
                                required="" readonly>
                        </div>
                        <button class="btn btn-gradient btn-lg" type="submit">Withdraw amount</button>
                    </form>

                </div>
            </div>

        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Total Earnings 

                </div>
                <div class="card-body">

                    <h2 class="text-primary">₱{{ round($revenue)}}</h2>
                    <hr>
                   

                </div>
            </div>

        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">Total Sell
                </div>
                <div class="card-body">

                    <h2 class="text-primary">₱{{ round($totalAmount)}}</h2>
                    <hr>
                  

                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card table-responsive">

                <table id="earning-table" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                       

                        </tr>
                    </thead>
                    <tbody>
                        @foreach (@$withdrawals as $key => $withdraw)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>${{ $withdraw->amount }}</td>
                                <td>{{ $withdraw->status == 0 ? 'Pending' : ($withdraw->status == 1 ? 'Approved' : 'Rejected') }}
                                </td>
                                <td>{{ $withdraw->created_at }}</td>
                               
                            </tr>
                        @endforeach
                    </tbody>
                </table>
               
            </div>
        </div>
    </div>
@endsection


@push('js')

<script>
    $(document).ready(function(){
    
    $("#earning-table").DataTable();

});
</script>
    
>>>>>>> 4d626894314be39286e444578073dd7e4c5bad0a
@endpush