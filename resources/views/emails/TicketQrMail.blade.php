<!DOCTYPE html>
<html>
<head>
    <title>testing</title>
</head>
<body>
    <h1>{{ $details['title'] }}</h1>
    <p>{{ $details['body'] }}</p>

    <img src="{{ $message->embed($details['qrCodePath']) }}" alt="QR Code">
    <p>Thank you</p>
</body>
</html>
