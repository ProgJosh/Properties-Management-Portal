<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Tenant Account</title>
</head>
<body style="margin:0; padding:24px; background:#f6f4ef; font-family:Arial, Helvetica, sans-serif; color:#1f2937;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:640px; margin:0 auto; background:#ffffff; border-radius:14px; overflow:hidden; border:1px solid #e5e7eb;">
        <tr>
            <td style="background:linear-gradient(135deg, #1f2937, #667eea); padding:26px 30px; color:#ffffff;">
                <h1 style="margin:0; font-size:24px; line-height:1.3;">New tenant registration</h1>
                <p style="margin:8px 0 0; color:#eef2ff;">A tenant account was created in {{ $appName }}.</p>
            </td>
        </tr>
        <tr>
            <td style="padding:30px;">
                <p style="margin:0 0 16px;">A new tenant has completed the registration form.</p>
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse; margin:0 0 20px;">
                    <tr>
                        <td style="padding:10px 0; color:#6b7280; width:150px; border-bottom:1px solid #e5e7eb;">Name</td>
                        <td style="padding:10px 0; border-bottom:1px solid #e5e7eb;"><strong>{{ $user->name }}</strong></td>
                    </tr>
                    <tr>
                        <td style="padding:10px 0; color:#6b7280; border-bottom:1px solid #e5e7eb;">Email</td>
                        <td style="padding:10px 0; border-bottom:1px solid #e5e7eb;">{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td style="padding:10px 0; color:#6b7280; border-bottom:1px solid #e5e7eb;">Registered</td>
                        <td style="padding:10px 0; border-bottom:1px solid #e5e7eb;">{{ $registeredAt->format('F j, Y g:i A') }}</td>
                    </tr>
                    <tr>
                        <td style="padding:10px 0; color:#6b7280;">Rental policy</td>
                        <td style="padding:10px 0;">Accepted</td>
                    </tr>
                </table>
                <p style="margin:0; color:#6b7280; font-size:14px;">
                    This is an automated registration notification.
                </p>
            </td>
        </tr>
        <tr>
            <td style="padding:20px 30px; background:#f9fafb; color:#6b7280; font-size:14px;">
                {{ $appName }}
            </td>
        </tr>
    </table>
</body>
</html>
