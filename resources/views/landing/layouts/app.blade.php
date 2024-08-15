<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketify</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/logo/logo.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        @media (min-width: 640px) {
            .card-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (min-width: 768px) {
            .card-grid {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }
        }

        .card {
            position: relative;
            width: 300px;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .imgDisplay {
            position: relative;
        }

        .y-date-boxInfo {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: white;
            padding: 0.5rem;
            border-radius: 0.5rem;
            text-align: center;
        }

        .y-date-month {
            font-size: 0.75rem;
            font-weight: bold;
            color: #ff6b6b;
        }

        .y-date-day {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .y-card-title {
            padding: 1rem;
        }

        .boxTitle {
            font-size: 1.125rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .boxAddress {
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 0.5rem;
        }

        .y-separator {
            border: none;
            border-top: 1px solid #e5e7eb;
            margin: 0.5rem 0;
        }

        .boxInfo {
            font-size: 0.875rem;
            color: #6b7280;
        }

        .boxPrice {
            font-size: 1rem;
            font-weight: bold;
            color: #f97316;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .show-with-animation {
            animation: slideIn 0.5s ease-out forwards;
        }
    </style>
    @include('landing.components.navbar')

    @yield('content')

    @include('landing.components.footer')

    @include('sweetalert::alert')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const smoothScrollLinks = document.querySelectorAll('a[href^="#"]');
            smoothScrollLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();

                    const targetId = this.getAttribute('href').substring(1);
                    const targetElement = document.getElementById(targetId);

                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</body>

</html>
