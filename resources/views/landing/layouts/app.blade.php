<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Events</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
  <style>
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
  </style>
  @include('landing.components.navbar') 
  
  @yield('content')
  
  @include('landing.components.footer') 


  <script>
    

    document.addEventListener('DOMContentLoaded', function() {
        const smoothScrollLinks = document.querySelectorAll('a[href^="#"]');
        smoothScrollLinks.forEach(link => {
            link.addEventListener('click', function(e) {
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
