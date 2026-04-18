<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiry Received</title>
</head>
<body style="margin:0; padding:24px; background:#f6f4ef; font-family:Arial, Helvetica, sans-serif; color:#1f2937;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:640px; margin:0 auto; background:#ffffff; border-radius:16px; overflow:hidden;">
        <tr>
            <td style="background:linear-gradient(135deg, #ff9a1f, #ff5f1f); padding:24px 28px; color:#ffffff;">
                <h1 style="margin:0; font-size:24px;">Thanks for reaching out</h1>
                <p style="margin:8px 0 0; color:#fff7ed;">We received your inquiry and will get back to you soon.</p>
            </td>
        </tr>
        <tr>
            <td style="padding:28px;">
                <p style="margin:0 0 16px;">Hello {{ $name }},</p>
                <p style="margin:0 0 16px;">Thank you for contacting <strong>{{ $appName }}</strong>. Your email <strong>{{ $email }}</strong> has been received successfully.</p>
                <p style="margin:0 0 16px;">Here is a copy of your message:</p>
                <div style="padding:16px; background:#fff8f2; border-radius:12px; border:1px solid #fed7aa; white-space:pre-line; margin-bottom:16px;">{{ $messageText }}</div>
                <p style="margin:0 0 16px;">You can continue browsing listings, message landlords, or wait for our reply in your inbox.</p>
                <p style="margin:0;">We appreciate your interest in our rental platform.</p>
            </td>
        </tr>
        <tr>
            <td style="padding:20px 28px; background:#fff8f2; color:#6b7280; font-size:14px;">
                {{ $appName }}<br>
                Property inquiries made simpler.
            </td>
        </tr>
    </table>
</body>
</html>
