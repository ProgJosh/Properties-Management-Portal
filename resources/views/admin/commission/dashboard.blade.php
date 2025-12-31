@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 class="mb-4">Commission Dashboard</h2>
            
            <!-- Commission Policy Notice -->
            <div class="alert alert-info" role="alert">
                <i class="fas fa-info-circle"></i>
                <strong>Commission Policy Reminder:</strong> A 3% commission is automatically deducted from each successful tenant transaction. 
                All commission deductions are tracked and reported monthly.
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Commission Earned</h5>
                    <h2 class="card-text">₱{{ number_format($stats['total_commission_earned'], 2) }}</h2>
                    <small>All time</small>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5 class="card-title">Pending Commission</h5>
                    <h2 class="card-text">₱{{ number_format($stats['pending_commission'], 2) }}</h2>
                    <small>To be processed</small>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">This Month</h5>
                    <h2 class="card-text">₱{{ number_format($stats['this_month_commission'], 2) }}</h2>
                    <small>{{ now()->format('F Y') }}</small>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5 class="card-title">Refunded</h5>
                    <h2 class="card-text">₱{{ number_format($stats['refunded_commission'], 2) }}</h2>
                    <small>Total refunded</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Commission Breakdown -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Commission Breakdown</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td><strong>Total Transactions:</strong></td>
                            <td>{{ $breakdown['total_transactions'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Total Revenue:</strong></td>
                            <td>₱{{ number_format($breakdown['total_revenue'], 2) }}</td>
                        </tr>
                        <tr>
                            <td><strong>Total Commission (3%):</strong></td>
                            <td>₱{{ number_format($breakdown['total_commission'], 2) }}</td>
                        </tr>
                        <tr>
                            <td><strong>Your Net Payout:</strong></td>
                            <td class="text-success"><strong>₱{{ number_format($breakdown['total_net_payout'], 2) }}</strong></td>
                        </tr>
                        <tr>
                            <td><strong>Avg Commission/Transaction:</strong></td>
                            <td>₱{{ number_format($breakdown['average_commission_per_transaction'], 2) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- This Month Report -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">{{ now()->format('F Y') }} Commission Report</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td><strong>Transactions This Month:</strong></td>
                            <td>{{ $thisMonth['total_transactions'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Revenue This Month:</strong></td>
                            <td>₱{{ number_format($thisMonth['total_revenue'], 2) }}</td>
                        </tr>
                        <tr>
                            <td><strong>Commission Deducted:</strong></td>
                            <td>₱{{ number_format($thisMonth['total_commission_deducted'], 2) }}</td>
                        </tr>
                        <tr>
                            <td><strong>Your Net Payout:</strong></td>
                            <td class="text-success"><strong>₱{{ number_format($thisMonth['net_payout'], 2) }}</strong></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="row mt-4 mb-4">
        <div class="col-md-12">
            <a href="/admin/commission/history" class="btn btn-primary">
                <i class="fas fa-history"></i> View Full History
            </a>
            <a href="/admin/commission/monthly-report" class="btn btn-info">
                <i class="fas fa-calendar"></i> Monthly Reports
            </a>
            <a href="/admin/commission/yearly-report" class="btn btn-warning">
                <i class="fas fa-chart-bar"></i> Yearly Reports
            </a>
            <a href="/admin/commission/download-pdf?type=monthly" class="btn btn-success">
                <i class="fas fa-download"></i> Download Report
            </a>
        </div>
    </div>

    <!-- Commission Guidelines -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0"><i class="fas fa-book"></i> Commission Policy Guidelines</h5>
                </div>
                <div class="card-body">
                    <h6>Understanding Your Commission Deductions:</h6>
                    <ul>
                        <li><strong>Commission Rate:</strong> A flat 3% is deducted from each successful tenant transaction</li>
                        <li><strong>When Applied:</strong> Commission is automatically deducted when rent payments are successfully processed</li>
                        <li><strong>What It Covers:</strong> Platform maintenance, secure transaction handling, and fraud protection</li>
                        <li><strong>Monthly Reports:</strong> You'll receive detailed monthly reports summarizing all commissions and payouts</li>
                        <li><strong>Net Amount:</strong> Your earnings are calculated after commission deduction</li>
                        <li><strong>Refunds:</strong> In case of payment refunds, the associated commission is also refunded</li>
                    </ul>

                    <hr>

                    <h6>Example Calculation:</h6>
                    <div class="alert alert-light">
                        <strong>If a tenant pays ₱10,000 in rent:</strong>
                        <ul class="mt-2 mb-0">
                            <li>Commission (3%): <strong>-₱300</strong></li>
                            <li>Your Net Payout: <strong>₱9,700</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        border: none;
    }

    .card-header {
        border-bottom: 2px solid rgba(0,0,0,0.1);
    }

    .bg-primary { background-color: #667eea !important; }
    .bg-success { background-color: #4caf50 !important; }
    .bg-warning { background-color: #ff9800 !important; }
    .bg-danger { background-color: #f44336 !important; }

    h2 {
        color: #333;
        font-weight: 700;
    }

    .card-text {
        margin-bottom: 0;
    }
</style>
@endsection
