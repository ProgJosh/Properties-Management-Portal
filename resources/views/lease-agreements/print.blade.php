<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lease Agreement #{{ $lease->id }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: Arial, Helvetica, sans-serif; 
            padding: 40px; 
            line-height: 1.6;
            color: #333;
        }
        .header { 
            text-align: center; 
            margin-bottom: 40px;
            border-bottom: 3px solid #667eea;
            padding-bottom: 20px;
        }
        .header h1 { 
            font-size: 32px;
            margin-bottom: 10px;
            color: #667eea;
        }
        .header p { 
            font-size: 14px;
            color: #666;
        }
        .section { 
            margin-bottom: 30px;
            page-break-inside: avoid;
        }
        .section h2 { 
            color: #667eea; 
            font-size: 18px; 
            margin-bottom: 15px;
            border-bottom: 2px solid #eee;
            padding-bottom: 5px;
        }
        .section p { 
            margin: 8px 0;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin: 15px 0;
        }
        table th, table td { 
            text-align: left; 
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        table th { 
            background-color: #f5f5f5;
            font-weight: 600;
        }
        .two-column { 
            display: flex; 
            gap: 40px;
            margin: 20px 0;
        }
        .column { 
            flex: 1;
        }
        .signature-area { 
            margin-top: 60px;
            page-break-inside: avoid;
        }
        .signature-box {
            border: 2px solid #ddd;
            padding: 30px;
            margin: 20px 0;
            border-radius: 8px;
        }
        .signature-line { 
            border-bottom: 2px solid #333; 
            width: 100%; 
            margin: 40px 0 10px 0;
        }
        .footer { 
            text-align: center; 
            margin-top: 60px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
            font-size: 12px;
        }
        @media print {
            body { padding: 20px; }
            .no-print { display: none; }
        }
        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #667eea;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }
        .print-button:hover {
            background: #5568d3;
        }
        .badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 10px;
        }
        .badge-success { background: #d1fae5; color: #059669; }
        .badge-warning { background: #fef3c7; color: #d97706; }
    </style>
</head>
<body>
    @php
        // Calculate duration once for use throughout the document
        $durationDays = $lease->start_date->diffInDays($lease->end_date);
        $durationMonths = $lease->start_date->diffInMonths($lease->end_date);
    @endphp
    
    <button onclick="window.print()" class="print-button no-print">🖨️ Print / Save as PDF</button>

    <div class="header">
        <h1>📋 LEASE AGREEMENT</h1>
        <p>Agreement ID: <strong>#{{ $lease->id }}</strong></p>
        <p>Status: 
            <span class="badge badge-{{ $lease->status === 'active_lease' ? 'success' : 'warning' }}">
                {{ str_replace('_', ' ', ucwords($lease->status)) }}
            </span>
        </p>
    </div>

    <div class="section">
        <h2>📅 AGREEMENT DETAILS</h2>
        <table>
            <tr>
                <th>Lease Agreement ID</th>
                <td>#{{ $lease->id }}</td>
            </tr>
            <tr>
                <th>Created Date</th>
                <td>{{ $lease->created_at->format('F d, Y') }}</td>
            </tr>
            <tr>
                <th>Lease Start Date</th>
                <td>{{ $lease->start_date->format('F d, Y') }}</td>
            </tr>
            <tr>
                <th>Lease End Date</th>
                <td>{{ $lease->end_date->format('F d, Y') }}</td>
            </tr>
            <tr>
                <th>Duration</th>
                <td>
                    @if($durationMonths >= 1)
                        {{ $durationMonths }} {{ $durationMonths == 1 ? 'month' : 'months' }}
                    @else
                        {{ $durationDays }} {{ $durationDays == 1 ? 'day' : 'days' }}
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>👥 PARTIES INVOLVED</h2>
        <div class="two-column">
            <div class="column">
                <h3>👨 TENANT (LESSEE)</h3>
                <p><strong>Name:</strong> {{ $lease->tenant->name }}</p>
                <p><strong>Email:</strong> {{ $lease->tenant->email }}</p>
                <p><strong>Phone:</strong> {{ $lease->tenant->phone ?? 'N/A' }}</p>
            </div>
            <div class="column">
                <h3>🔑 LANDLORD (LESSOR)</h3>
                <p><strong>Name:</strong> {{ $lease->landlord->name }}</p>
                <p><strong>Email:</strong> {{ $lease->landlord->email }}</p>
                <p><strong>Phone:</strong> {{ $lease->landlord->phone ?? 'N/A' }}</p>
            </div>
        </div>
    </div>

    <div class="section">
        <h2>🏠 PROPERTY DETAILS</h2>
        <p><strong>Property Name:</strong> {{ $lease->property->name ?? 'N/A' }}</p>
        <p><strong>Address:</strong> {{ $lease->property->address ?? 'N/A' }}</p>
        <p><strong>City:</strong> {{ $lease->property->city ?? 'N/A' }}</p>
        <p><strong>Postal Code:</strong> {{ $lease->property->postal_code ?? 'N/A' }}</p>
        <p><strong>Property Type:</strong> {{ ucfirst($lease->property->type ?? 'N/A') }}</p>
    </div>

    <div class="section">
        <h2>💰 FINANCIAL TERMS</h2>
        <table>
            <tr>
                <th>Monthly Rent</th>
                <td>₱{{ number_format($lease->monthly_rent, 2) }}</td>
            </tr>
            <tr>
                <th>Security Deposit</th>
                <td>₱{{ number_format($lease->security_deposit ?? 0, 2) }}</td>
            </tr>
            <tr>
                <th>Total Lease Period</th>
                <td>
                    @if($durationMonths >= 1)
                        {{ $durationMonths }} {{ $durationMonths == 1 ? 'month' : 'months' }}
                    @else
                        {{ $durationDays }} {{ $durationDays == 1 ? 'day' : 'days' }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>Total Lease Amount</th>
                <td>
                    @php
                        if($durationMonths >= 1) {
                            $totalAmount = $lease->monthly_rent * $durationMonths;
                        } else {
                            $dailyRate = $lease->monthly_rent / 30;
                            $totalAmount = $dailyRate * $durationDays;
                        }
                    @endphp
                    ₱{{ number_format($totalAmount, 2) }}
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>📝 TERMS AND CONDITIONS</h2>
        <p style="text-align: justify;">
            This Lease Agreement ("Agreement") is entered into on {{ $lease->created_at->format('F d, Y') }} between {{ $lease->landlord->name }} ("Landlord") and {{ $lease->tenant->name }} ("Tenant") for the property located at {{ $lease->property->address ?? 'the specified address' }}.
        </p>
        <br>
        <p><strong>1. Term:</strong> The lease term begins on {{ $lease->start_date->format('F d, Y') }} and ends on {{ $lease->end_date->format('F d, Y') }}.</p>
        <p><strong>2. Rent:</strong> Tenant agrees to pay monthly rent of ₱{{ number_format($lease->monthly_rent, 2) }}.</p>
        <p><strong>3. Security Deposit:</strong> Tenant has paid a security deposit of ₱{{ number_format($lease->deposit_amount ?? 0, 2) }}.</p>
        <p><strong>4. Use of Property:</strong> The property shall be used for residential purposes only.</p>
        <p><strong>5. Maintenance:</strong> Tenant agrees to maintain the property in good condition.</p>
        <p><strong>6. Termination:</strong> Either party may terminate this agreement with proper notice as per local rental laws.</p>
    </div>

    @if($lease->isSigned() || $lease->status === 'active_lease')
    <div class="section signature-area">
        <h2>✍️ SIGNATURES</h2>
        <div class="two-column">
            <div class="column">
                <div class="signature-box">
                    <h3>TENANT SIGNATURE</h3>
                    @if($lease->isSigned())
                        <p style="margin: 20px 0; color: #059669; font-weight: bold;">✓ Digitally Signed</p>
                        <p><strong>{{ $lease->tenant->name }}</strong></p>
                        <p><small>Date: {{ $lease->tenant_signed_at->format('F d, Y \a\t g:i A') }}</small></p>
                    @else
                        <div class="signature-line"></div>
                        <p><strong>{{ $lease->tenant->name }}</strong></p>
                        <p><small>Date: __________________</small></p>
                    @endif
                </div>
            </div>
            <div class="column">
                <div class="signature-box">
                    <h3>LANDLORD SIGNATURE</h3>
                    @if($lease->status === 'active_lease' || $lease->status === 'completed')
                        <p style="margin: 20px 0; color: #059669; font-weight: bold;">✓ Digitally Signed</p>
                        <p><strong>{{ $lease->landlord->name }}</strong></p>
                        <p><small>Date: {{ $lease->updated_at->format('F d, Y \a\t g:i A') }}</small></p>
                    @else
                        <div class="signature-line"></div>
                        <p><strong>{{ $lease->landlord->name }}</strong></p>
                        <p><small>Date: __________________</small></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="footer">
        <p>This document was generated on {{ now()->format('F d, Y \a\t g:i A') }}</p>
        <p>Properties Management Portal © {{ date('Y') }}</p>
    </div>
</body>
</html>
