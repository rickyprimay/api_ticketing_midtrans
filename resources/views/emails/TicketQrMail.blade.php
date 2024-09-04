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
                    <h2 style="color: #333333; font-size: 20px;">Hi, {{ $details['name'] }}</h2>
                    <p style="color: #666666; font-size: 16px; margin-top: 10px;">This is your QR Code Ticket</p>
                    <img src="{{ $message->embed($details['qrCodePath']) }}" alt="QR Code">
                    
                    <h3 style="color: #333333; font-size: 20px;">Kode: {{ $details['uniqueCode'] }}</h3>
                    <h3 style="color: #333333; font-size: 20px;">Ticket Type: {{ $details['ticket_type'] }}</h3>
                    <h3 style="color: #333333; font-size: 20px;">Total Payment: {{ $details['total_amount'] }}</h3>

                    <!-- Tampilkan hanya jika tidak null -->
                    @if(!empty($details['first_name']))
                        <h3 style="color: #333333; font-size: 20px;">First Name: {{ $details['first_name'] }}</h3>
                    @endif

                    @if(!empty($details['last_name']))
                        <h3 style="color: #333333; font-size: 20px;">Last Name: {{ $details['last_name'] }}</h3>
                    @endif

                    @if(!empty($details['email_buyer']))
                        <h3 style="color: #333333; font-size: 20px;">Email: {{ $details['email_buyer'] }}</h3>
                    @endif

                    @if(!empty($details['phone_number']))
                        <h3 style="color: #333333; font-size: 20px;">Phone: {{ $details['phone_number'] }}</h3>
                    @endif

                    @if(!empty($details['birth_date']))
                        <h3 style="color: #333333; font-size: 20px;">Birth Date: {{ $details['birth_date'] }}</h3>
                    @endif

                    @if(!empty($details['gender']))
                        <h3 style="color: #333333; font-size: 20px;">Gender: {{ $details['gender'] }}</h3>
                    @endif

                    @if(!empty($details['nik']))
                        <h3 style="color: #333333; font-size: 20px;">NIK: {{ $details['nik'] }}</h3>
                    @endif

                    @if(!empty($details['blood_type']))
                        <h3 style="color: #333333; font-size: 20px;">Blood Type: {{ $details['blood_type'] }}</h3>
                    @endif

                    @if(!empty($details['bib']))
                        <h3 style="color: #333333; font-size: 20px;">Bib: {{ $details['bib'] }}</h3>
                    @endif

                    @if(!empty($details['community']))
                        <h3 style="color: #333333; font-size: 20px;">Community: {{ $details['community'] }}</h3>
                    @endif

                    @if(!empty($details['size_shirt']))
                        <h3 style="color: #333333; font-size: 20px;">Size Shirt: {{ $details['size_shirt'] }}</h3>
                    @endif

                    @if(!empty($details['urgent_contact']))
                        <h3 style="color: #333333; font-size: 20px;">Urgent Contact: {{ $details['urgent_contact'] }}</h3>
                    @endif

                    @if(!empty($details['number_urgen_contact']))
                        <h3 style="color: #333333; font-size: 20px;">Urgent Contact Number: {{ $details['number_urgen_contact'] }}</h3>
                    @endif

                    @if(!empty($details['relation_urgen_contact']))
                        <h3 style="color: #333333; font-size: 20px;">Relation with Urgent Contact: {{ $details['relation_urgen_contact'] }}</h3>
                    @endif

                    <!-- Field tambahan -->
                    @if(!empty($details['field1']))
                        <h3 style="color: #333333; font-size: 20px;">Field 1: {{ $details['field1'] }}</h3>
                    @endif

                    @if(!empty($details['field2']))
                        <h3 style="color: #333333; font-size: 20px;">Field 2: {{ $details['field2'] }}</h3>
                    @endif

                    @if(!empty($details['field3']))
                        <h3 style="color: #333333; font-size: 20px;">Field 3: {{ $details['field3'] }}</h3>
                    @endif

                    @if(!empty($details['field4']))
                        <h3 style="color: #333333; font-size: 20px;">Field 4: {{ $details['field4'] }}</h3>
                    @endif

                    @if(!empty($details['field5']))
                        <h3 style="color: #333333; font-size: 20px;">Field 5: {{ $details['field5'] }}</h3>
                    @endif

                    <p style="color: #666666; font-size: 16px; margin-top: 20px;">Thanks,<br>Ticketify Team</p>
                </main>
            </td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <footer>
                    <p style="color: #888888; font-size: 12px; margin-top: 10px;">©️ {{ date('Y') }} Ticketify.id. All Rights Reserved.</p>
                </footer>
            </td>
        </tr>
    </table>

</body>
</html>
