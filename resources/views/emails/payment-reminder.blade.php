<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Reminder</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }
        .content {
            padding: 30px 20px;
        }
        .greeting {
            color: #333;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .reminder-box {
            background-color: #f9f9f9;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .reminder-box h3 {
            color: #667eea;
            margin-top: 0;
            margin-bottom: 10px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            color: #666;
            font-weight: 500;
        }
        .info-value {
            color: #333;
            font-weight: 600;
        }
        .amount {
            font-size: 24px;
            color: #667eea;
            font-weight: 700;
        }
        .days-left {
            background-color: #e8f4f8;
            padding: 15px;
            border-radius: 4px;
            text-align: center;
            margin: 20px 0;
            border: 1px solid #b3d9e8;
        }
        .days-left .number {
            font-size: 32px;
            color: #667eea;
            font-weight: 700;
        }
        .days-left .label {
            color: #666;
            font-size: 14px;
            margin-top: 5px;
        }
        .message {
            color: #555;
            line-height: 1.6;
            margin: 20px 0;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 30px;
            border-radius: 4px;
            text-decoration: none;
            margin: 20px 0;
            font-weight: 600;
        }
        .cta-button:hover {
            opacity: 0.9;
        }
        .footer {
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 12px;
            border-top: 1px solid #ddd;
        }
        .property-info {
            background-color: #f0f7ff;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
            border: 1px solid #d1e7ff;
        }
        .property-info h4 {
            margin: 0 0 10px 0;
            color: #667eea;
            font-size: 14px;
        }
        .property-info p {
            margin: 5px 0;
            color: #555;
            font-size: 14px;
        }
        .warning {
            color: #e74c3c;
            background-color: #fadbd8;
            padding: 12px;
            border-radius: 4px;
            border-left: 4px solid #e74c3c;
            margin: 15px 0;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>💳 Payment Reminder</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">Your rent is due soon</p>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Greeting -->
            <div class="greeting">
                <p>Hi {{ $user->name }},</p>
            </div>

            <!-- Main Message -->
            <div class="message">
                <p>This is a friendly reminder that your rent payment is due soon. Please make sure to complete your payment on time to avoid any late fees or penalties.</p>
            </div>

            <!-- Payment Details Box -->
            <div class="reminder-box">
                <h3>💰 Payment Details</h3>
                <div class="info-row">
                    <span class="info-label">Amount Due:</span>
                    <span class="info-value amount">₱{{ number_format($reminder->amount, 2) }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Due Date:</span>
                    <span class="info-value">{{ $reminder->formatted_due_date }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Days Remaining:</span>
                    <span class="info-value">{{ $reminder->days_until_due }} days</span>
                </div>
            </div>

            <!-- Days Until Due -->
            <div class="days-left">
                <div class="number">{{ $reminder->days_until_due }}</div>
                <div class="label">{{ Str::plural('day', $reminder->days_until_due) }} until payment is due</div>
            </div>

            <!-- Property Information -->
            @if($reminder->property)
            <div class="property-info">
                <h4>🏠 Property Information</h4>
                <p><strong>{{ $reminder->property->title }}</strong></p>
                @if($reminder->property->address)
                <p>{{ $reminder->property->address }}</p>
                @endif
                @if($reminder->property->city)
                <p>{{ $reminder->property->city }}
                    @if($reminder->property->state)
                        , {{ $reminder->property->state }}
                    @endif
                </p>
                @endif
            </div>
            @endif

            <!-- Payment Instructions -->
            <div class="reminder-box">
                <h3>📝 Payment Instructions</h3>
                <ol style="color: #555; line-height: 1.8;">
                    <li>Log in to your account on our portal</li>
                    <li>Navigate to the Payment section</li>
                    <li>Select this booking and complete the payment</li>
                    <li>Ensure payment is made before the due date</li>
                </ol>
            </div>

            <!-- Warning for Overdue -->
            @if($reminder->is_overdue)
            <div class="warning">
                <strong>⚠️ IMPORTANT:</strong> This payment is already overdue. Please make the payment immediately to avoid additional penalties and legal action.
            </div>
            @endif

            <!-- CTA Button -->
            <div style="text-align: center;">
                <a href="{{ route('dashboard') }}" class="cta-button">View My Dashboard</a>
            </div>

            <!-- Additional Message -->
            <div class="message" style="margin-top: 30px; padding: 15px; background-color: #f9f9f9; border-radius: 4px;">
                <p><strong>Need Help?</strong></p>
                <p>If you have any questions about this payment or need to reschedule, please contact the property owner or our support team at:</p>
                <p>
                    📧 Email: <a href="mailto:support@propertymanagement.com">support@propertymanagement.com</a><br>
                    📞 Phone: <span style="color: #667eea; font-weight: 600;">+63 XXX XXX XXXX</span>
                </p>
            </div>

            <!-- Acknowledgment Info -->
            <div style="margin-top: 20px; padding: 15px; background-color: #e8f4f8; border-radius: 4px; text-align: center;">
                <p style="margin: 0; color: #555; font-size: 14px;">
                    You received this email because you have an active rental booking in our system.<br>
                    <strong>Please acknowledge receipt by replying to this email or logging into your portal.</strong>
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p style="margin: 0 0 10px 0;">© {{ date('Y') }} Properties Management Portal. All rights reserved.</p>
            <p style="margin: 5px 0;">
                This is an automated message. Please do not reply with sensitive information.<br>
                For security concerns, contact us directly at support@propertymanagement.com
            </p>
        </div>
    </div>
</body>
</html>
