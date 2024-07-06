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
    <div class="grid grid-cols-1">
      <div class="bg-white p-6 shadow-lg text-center">
        <h1 class="text-2xl font-bold mb-4">Halaman Panitia</h1>
        <div id="qr-reader" class="qr-reader-custom w-[500px]"></div>
        <p id="qr-result" class="mt-4 text-lg font-medium text-gray-700"></p>
      </div>
      <form class="bg-white text-center">
        <div class="flex gap-6 mt-10 md:mt-0 mb-6 md:grid-cols-1 justify-center items-center">
          <div>
            <label for="first_name" class="block mb-2 text-center text-sm font-medium text-gray-900">QR id</label>
            <input
              type="text"
              id="qr-id"
              class="bg-gray-600 border border-gray-900 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 " style="width: 100%"
              placeholder="unique code tiket"
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
        function domReady(fn) {
          if (document.readyState === "complete" || document.readyState === "interactive") {
            setTimeout(fn, 1);
          } else {
            document.addEventListener("DOMContentLoaded", fn);
          }
        }
      
        domReady(function () {
          var myqr = document.getElementById("qr-result");
          var lastResult,
            countResult = 0;
      
          function onScanSuccess(decodeText, decodeResult) {
            if (decodeText !== lastResult) {
              ++countResult;
              lastResult = decodeText;
      
              // Parse JSON from QR code content
              var qrData = JSON.parse(decodeText);
      
              // Display unique_code in qr-result element
              myqr.innerHTML = `Hasil Scan ke-${countResult}: ${qrData.unique_code}`;
            }
          }
      
          var htmlscanner = new Html5QrcodeScanner("qr-reader", { fps: 10, qrbox: 250 });
          htmlscanner.render(onScanSuccess);
        });
      </script>
      
  </body>
</html>