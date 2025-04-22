<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to WSTREET SMART LAB</title>
</head>
<body style="font-family: sans-serif; background-color: #f6f6f6; padding: 20px;">
<table width="100%" style="max-width: 600px; margin: auto; background-color: #ffffff; padding: 30px; border-radius: 10px;">
    <tr>
        <td>
            <h2 style="color: #333;">Hi {{ $username }}! 👋</h2>
            <p>Welcome to <strong>WSTREET SMART LAB</strong>!</p>
            <p>Your verification code is:</p>
            <h1 style="color: #1B5E20; font-size: 36px;">{{ $code }}</h1>
            <p>This code will expire in 10 minutes. Don't share it with anyone.</p>
            <hr>
            <p style="font-size: 12px; color: #888;">If you didn’t request this, just ignore this message.</p>
        </td>
    </tr>
</table>
</body>
</html>
