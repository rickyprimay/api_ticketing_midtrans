<!DOCTYPE html>
<html>
<head>
    <title>Email Template</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">

    <table cellspacing="0" cellpadding="0" border="0" width="100%" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border: 1px solid #dddddd;">
        <tr>
            <td style="padding: 20px;">
                <h1 style="color: #333333; font-size: 24px;">Reminder Pembayaran Tiket [Acara].</h1>
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
                    <p style="color: #333333; font-size: 16px; margin-top: 10px;">Kami berharap Anda dalam keadaan sehat. Ini adalah pengingat untuk menyelesaikan pembayaran tiket Anda untuk [Acara] yang akan diselenggarakan pada [Tanggal Pelaksanaan] di [Tempat Pelaksanaan.</p>
                    <h3 style="color: #333333; font-size: 20px;">Kode : {{ $details['uniqueCode'] }}</h3>
                    <h3 style="color: #333333; font-size: 20px;">Ticket Type : {{ $details['tipe_ticket'] }}</h3>
                    <h3 style="color: #333333; font-size: 20px;">Total Ticket : {{ $details['........'] }}</h3>
                    <h3 style="color: #333333; font-size: 20px;">Total Payment : {{ $details['total_payment'] }}</h3>
                    <h3 style="color: #333333; font-size: 20px;">Payment Link : {{ invoice_url}}</h3>
                    <p style="color: #666666; font-size: 16px; margin-top: 10px;">Kami sangat antusias untuk melihat Anda di acara ini! Mohon segera lakukan pembayaran sebelum batas waktu yang telah ditentukan agar tiket Anda dapat terkonfirmasi. Terima kasih atas partisipasi Anda. Kami sangat menantikan kehadiran Anda di [Acara].
</p>
										<p style="color: #666666; font-size: 16px; margin-top: 10px;">(Jika Anda sudah melakukan pembayaran, harap abaikan pesan ini.)</p>
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