<!-- resources/views/admin/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/logo/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet" />
  </head>
  <body class="bg-gray-100">
    @include('superadmin.components.navbar')
    @include('superadmin.components.sidebar')
    <div class="sm:ml-64 mt-24 px-8 md:px-6">
      @yield('content')
    </div>
    @include('sweetalert::alert')
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
  </body>
</html>
