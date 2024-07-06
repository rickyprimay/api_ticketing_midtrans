<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panitia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('assets/logo/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
</head>
<body class="bg-[#454545] flex items-center justify-center min-h-screen">
<div class="grid grid-cols-1">
    <div class="bg-white p-6 shadow-lg text-center relative">
        <h1 class="text-2xl font-bold mb-4">Halaman Panitia</h1>
        <form action="{{ route('auth.logout') }}" method="POST">
            @csrf
            <button class="absolute top-0 right-0 m-4 px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium" type="submit">Logout</button>
        </form>
        <div id="qr-reader" class="qr-reader-custom w-[500px]"></div>
        <p id="qr-result" class="mt-4 text-lg font-medium text-gray-700"></p>
    </div>
    <form class="bg-white text-center" id="manualForm">
        @csrf
        <div class="flex gap-6 mt-10 md:mt-0 mb-6 md:grid-cols-1 justify-center items-center">
            <div>
                <label for="qr-id" class="block mb-2 text-center text-sm font-medium text-gray-900">Input manual QR id</label>
                <input
                    type="text"
                    id="qr-id"
                    name="qr_id"
                    class="bg-gray-600 border border-gray-900 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
                    style="width: 100%"
                    placeholder="Unique code tiket"
                    required
                />
            </div>
        </div>

        <button
            type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        >
            Submit
        </button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const qrResult = document.getElementById('qr-result');

        function onScanSuccess(decodeText, decodeResult) {
            // console.log(decodeText);

            qrResult.innerHTML = `Berhasil Scan QR: ${decodeText}`;
            redeemQR(decodeText);
        }

        const htmlScanner = new Html5QrcodeScanner("qr-reader", { fps: 10, qrbox: 250 });
        htmlScanner.render(onScanSuccess);

        // Handle manual form submission
        document.getElementById('manualForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const qrId = document.getElementById('qr-id').value.trim();

            // Display input manual QR id
            qrResult.innerHTML = `Input manual QR: ${qrId}`;

            // Simpan QR id untuk proses redeem
            redeemQR(qrId);
        });

        function redeemQR(qrId) {
            fetch('{{ route("redeem.qr") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ qr_id: qrId, ticket_status: 1 })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                alert(data.message);
            })
            .catch(error => {
                // console.error('Error:', error);
                qrResult.innerText = 'Tiket telah digunakan';
            });
        }
    });
</script>



</body>
</html>
