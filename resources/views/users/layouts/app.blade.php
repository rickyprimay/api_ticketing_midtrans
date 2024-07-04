<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Events</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/logo/logo.png') }}">
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</body>
</html>
