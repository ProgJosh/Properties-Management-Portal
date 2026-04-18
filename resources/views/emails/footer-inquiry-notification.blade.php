<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Footer Inquiry</title>
</head>
<body style="margin:0; padding:24px; background:#f6f4ef; font-family:Arial, Helvetica, sans-serif; color:#1f2937;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:640px; margin:0 auto; background:#ffffff; border-radius:16px; overflow:hidden;">
        <tr>
            <td style="background:#17131a; padding:24px 28px; color:#ffffff;">
                <h1 style="margin:0; font-size:24px;">New Footer Inquiry</h1>
                <p style="margin:8px 0 0; color:#f3f4f6;">A visitor submitted their email from the footer inquiry form.</p>
            </td>
        </tr>
        <tr>
            <td style="padding:28px;">
                <p style="margin:0 0 16px;"><strong>Name:</strong> {{ $name }}</p>
                <p style="margin:0 0 16px;"><strong>Email:</strong> {{ $email }}</p>
                <p style="margin:0 0 16px;"><strong>Submitted At:</strong> {{ $submittedAt->format('M d, Y h:i A') }}</p>
                <p style="margin:0 0 16px;"><strong>Message:</strong></p>
                <div style="padding:16px; background:#f9fafb; border-radius:12px; border:1px solid #e5e7eb; white-space:pre-line;">{{ $messageText }}</div>
                <p style="margin:0;">You can reply directly to this message to continue the conversation.</p>
            </td>
        </tr>
        <tr>
            <td style="padding:20px 28px; background:#fff8f2; color:#6b7280; font-size:14px;">
                {{ $appName }}
            </td>
        </tr>
    </table>
</body>
</html>
