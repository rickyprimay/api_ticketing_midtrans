<section class="container mx-auto px-4 md:px-8 mt-8 md:mt-16">
  <div id="controls-carousel" class="relative w-full p-4 rounded-lg" data-carousel="slide">
      <!-- Carousel wrapper -->
      <div class="relative overflow-hidden rounded-lg h-48 md:h-96"> <!-- Adjusted height for mobile view -->
          <!-- Item 1 -->
          <div class="hidden duration-700 ease-in-out" data-carousel-item>
              <img src="{{asset('assets/img/carousel/car-1.png')}}" class="absolute block w-full h-full object-cover" alt="..." /> <!-- Changed to object-cover -->
          </div>
          <!-- Item 2 -->
          <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
              <img src="{{asset('assets/img/carousel/car-2.png')}}" class="absolute block w-full h-full object-cover" alt="..." /> <!-- Changed to object-cover -->
          </div>
          <!-- Item 3 -->
          <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
              <img src="{{asset('assets/img/carousel/car-3.png')}}" class="absolute block w-full h-full object-cover" alt="..." /> <!-- Changed to object-cover -->
          </div>
          <!-- Item 4 -->
          <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
              <img src="{{asset('assets/img/carousel/car-4.png')}}" class="absolute block w-full h-full object-cover" alt="..." /> <!-- Changed to object-cover -->
          </div>
      </div>
  </div>
</section>
