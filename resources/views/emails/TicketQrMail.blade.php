
<!DOCTYPE html>
<html>
<head>
    <title>Email Template</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">

    <table cellspacing="0" cellpadding="0" border="0" width="100%" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border: 1px solid #dddddd;">
        <tr>
            <td style="padding: 20px;">
                <h1 style="color: #333333; font-size: 24px;">Email Verifikasi E-Tiket anda</h1>
                <p style="color: #666666; font-size: 16px;">Berikut E-Ticket anda untuk melakukan daftar ulang di Hari H acara</p>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <header style="text-align: center;">
                    <a href="#">
                        <img src="https://ticketify.id/assets/logo/logo.png" alt="Logo" style="width: 200px; height: auto;">
                    </a>
                    
                </header>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <main>
                    <h2 style="color: #333333; font-size: 20px;">Hi , {{ $details['name'] }}</h2>
                    <p style="color: #666666; font-size: 16px; margin-top: 10px;">This is your QrCode Tikcket</p>
                    <img src="{{ $message->embed($details['qrCodePath']) }}" alt="QR Code">
                    <p style="color: #666666; font-size: 16px; margin-top: 20px;">Thanks,<br>Ticketify Team</p>
                </main>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <footer>
                    <p style="color: #888888; font-size: 12px; margin-top: 10px;">© {{ date('Y') }} Ticketify.id. All Rights Reserved.</p>
                </footer>
            </td>
        </tr>
    </table>

</body>
</html>
