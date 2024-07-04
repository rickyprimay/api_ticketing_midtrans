<!DOCTYPE html>
<html>
<head>
    <title>Email Template</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">

    <table cellspacing="0" cellpadding="0" border="0" width="100%" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border: 1px solid #dddddd;">
        <tr>
            <td style="padding: 20px;">
                <h1 style="color: #333333; font-size: 24px;">Email Verifikasi kode OTP anda</h1>
                <p style="color: #666666; font-size: 16px;">Berikut Kode OTP untuk verifikasi email anda</p>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <header style="text-align: center;">
                    <a href="#"><img src="{{ asset('{{ asset('assets/logo/logo.png') }}') }}" alt="Logo" style="width: 200px; height: auto;"></a>
                </header>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <main>
                    <h2 style="color: #333333; font-size: 20px;">Hi , {{ $details['name'] }}</h2>
                    <p style="color: #666666; font-size: 16px; margin-top: 10px;">This is your verification code:</p>
                    <div style="display: flex; justify-content: center; align-items: center; gap: 8px;">
                        @foreach(str_split($details['otp']) as $digit)
                        <p style="text-align: center; width: 40px; height: 40px; font-size: 24px; font-weight: 600; color: #007bff; border: 1px solid #007bff; border-radius: 50%; line-height: 40px;">{{ $digit }}</p>
                        @endforeach
                    </div>
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
