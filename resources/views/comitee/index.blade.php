<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Panitia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="/image/logowhite.svg" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
  </head>
  <body class="bg-[#454545] flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-lg text-center">
      <h1 class="text-2xl font-bold mb-4">Halaman Panitia</h1>
      <div id="qr-reader" class="qr-reader-custom w-[350px] md:w-[800px]"></div>
      <p id="qr-result" class="mt-4 text-lg font-medium text-gray-700"></p>

      <form>
        <div class="grid gap-6 mb-6 md:grid-cols-2">
          <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Qr id</label>
            <input
              type="text"
              id="first_name"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              placeholder="John"
              required
            />
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
      function onScanSuccess(decodedText, decodedResult) {
        // Handle the decoded result here.
        console.log(`Code matched = ${decodedText}`, decodedResult);
        document.getElementById("qr-reader-results").innerText = `QR Code: ${decodedText}`;
        // Optionally, you can stop the scanner once a QR code is scanned.
        html5QrCode.stop();
      }

      function onScanFailure(error) {
        // Handle scan failure, usually better to ignore and keep scanning.
        console.warn(`Code scan error = ${error}`);
      }

      let html5QrCode = new Html5Qrcode("qr-reader");

      // Start scanning
      html5QrCode
        .start(
          { facingMode: "environment" }, // Default camera or { facingMode: "environment" }
          {
            fps: 10, // Scans per second
            qrbox: { width: 250, height: 250 }, // QR scanning box size
          },
          onScanSuccess,
          onScanFailure
        )
        .catch((err) => {
          // Start failed, handle it.
          console.error(`Unable to start scanning, error: ${err}`);
        });
    </script>
  </body>
</html>