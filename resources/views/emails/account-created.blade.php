<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Created</title>
</head>
<body style="margin:0; padding:24px; background:#f4f7fb; font-family:Arial, Helvetica, sans-serif; color:#1f2937;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:640px; margin:0 auto; background:#ffffff; border-radius:14px; overflow:hidden; border:1px solid #e5e7eb;">
        <tr>
            <td style="background:linear-gradient(135deg, #667eea, #10b981); padding:26px 30px; color:#ffffff;">
                <h1 style="margin:0; font-size:24px; line-height:1.3;">Welcome to {{ $appName }}</h1>
                <p style="margin:8px 0 0; color:#eef2ff;">Your tenant account has been created successfully.</p>
            </td>
        </tr>
        <tr>
            <td style="padding:30px;">
                <p style="margin:0 0 16px;">Hello {{ $user->name }},</p>
                <p style="margin:0 0 16px;">
                    Thanks for creating an account with <strong>{{ $appName }}</strong>. You can now sign in, browse rental listings, manage bookings, and complete tenant actions from your portal.
                </p>
                <div style="padding:16px 18px; background:#ecfdf5; border-left:4px solid #10b981; border-radius:10px; margin:0 0 20px;">
                    <p style="margin:0; font-weight:bold;">Account email</p>
                    <p style="margin:6px 0 0;">{{ $user->email }}</p>
                </div>
                <p style="margin:0 0 20px;">
                    Your submitted ID details are ready for review. We will use them to help keep rental agreements and platform activity secure.
                </p>
                <p style="margin:0 0 24px;">
                    <a href="{{ $loginUrl }}" style="display:inline-block; background:#667eea; color:#ffffff; text-decoration:none; padding:12px 20px; border-radius:8px; font-weight:bold;">Sign in to your account</a>
                </p>
                <p style="margin:0; color:#6b7280; font-size:14px;">
                    If you did not create this account, please ignore this email or contact support.
                </p>
            </td>
        </tr>
        <tr>
            <td style="padding:20px 30px; background:#f9fafb; color:#6b7280; font-size:14px;">
                {{ $appName }}<br>
                Property management made easier.
            </td>
        </tr>
    </table>
</body>
</html>
