<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <title>Independent insurance consultant</title>

  <?php if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'))): ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
  <?php endif; ?>
</head>

<body id="home">

<!-- Navbar -->
<nav class="fixed top-0 left-0 w-full z-50 bg-transparent text-white">
  <div class="max-w-7xl mx-auto flex flex-wrap justify-between items-center px-4 md:px-6 py-4">
    <!-- Left nav -->
    <ul class="hidden md:flex space-x-6 font-semibold p-2">
      <li><a href="#home" class="hover:text-gray-300">Home</a></li>
      <li><a href="#about" class="hover:text-gray-300">About</a></li>
      <li><a href="#services" class="hover:text-gray-300">Services</a></li>
      <li><a href="#testmonial" class="hover:text-gray-300">Reviews</a></li>
      <li><a href="#contact" class="hover:text-gray-300">Contact Us</a></li>
    </ul>


    <!-- Mobile menu button -->
    <div class="md:hidden">
      <button id="menu-toggle" class="focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
    </div>

    <!-- Logo center -->
    <a href="#" class="absolute left-1/2 transform -translate-x-1/2 pt-4">
      <img src="<?php echo e(asset('imgs/loge.png')); ?>" alt="Logo" class="h-20 md:h-20">
    </a>

    <ul class="hidden md:flex space-x-4 font-semibold items-center relative">
  <?php if(Route::has('login')): ?>
    <?php if(auth()->guard()->check()): ?>
      <li x-data="{ open: false }" class="relative">
        <!-- Botón con la letra inicial igual -->
        <button @click="open = !open" @click.away="open = false"
                class="hover:text-gray-300 focus:outline-none">
          <?php echo e(Auth::user()->name); ?>

        </button>

        <!-- Menú desplegable -->
        <ul x-show="open" x-transition
            @mouseenter="open = true" @mouseleave="open = false"
            class="absolute right-[-20px] mt-2 w-48 bg-zinc-800 text-white rounded-md shadow-lg z-50 text-right"
            style="display: none;"
        >
          <li>
            <a href="<?php echo e(url('/dashboard')); ?>" class="block px-4 py-2 hover:bg-zinc-700">Dashboard</a>
          </li>
          <li>
            <a href="<?php echo e(route('profile.edit')); ?>" class="block px-4 py-2 hover:bg-zinc-700">Edit Profile</a>
          </li>
          <li>
            <form method="POST" action="<?php echo e(route('logout')); ?>">
              <?php echo csrf_field(); ?>
              <button type="submit" class="w-full text-right px-4 py-2 hover:bg-zinc-700">
                Log out
              </button>
            </form>
          </li>
        </ul>
      </li>
    <?php else: ?>
      <li>
        <a href="<?php echo e(route('login')); ?>" class="bg-blue-800 text-white px-4 py-1 rounded hover:bg-blue-700">
          Log in
        </a>
      </li>
      <?php if(Route::has('register')): ?>
        <li>
          <a href="<?php echo e(route('register')); ?>" class="hover:text-gray-300">Register</a>
        </li>
      <?php endif; ?>
    <?php endif; ?>
  <?php endif; ?>
</ul>


  <!-- Mobile menu -->
  <div id="mobile-menu" class="md:hidden hidden px-4 pt-2 pb-4 space-y-2 font-semibold bg-black bg-opacity-80">
    <a href="#home" class="block hover:text-gray-300">Home</a>
    <a href="#about" class="block hover:text-gray-300">About</a>
    <a href="#services" class="block hover:text-gray-300">Services</a>
    <a href="#testmonial" class="block hover:text-gray-300">Reviews</a>
    <a href="#contact" class="block hover:text-gray-300">Contact Us</a>
    <?php if(Route::has('login')): ?>
      <?php if(auth()->guard()->check()): ?>
        <a href="<?php echo e(url('/dashboard')); ?>" class="block hover:text-gray-300"> <?php echo e(Auth::user()->name); ?></a>
      <?php else: ?>
        <a href="<?php echo e(route('login')); ?>" class="block hover:text-gray-300">Log in</a>
        <?php if(Route::has('register')): ?>
          <a href="<?php echo e(route('register')); ?>" class="block hover:text-gray-300">Register</a>
        <?php endif; ?>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</nav>


  


<!-- Hero Section -->
<header id="home" class="relative w-full h-screen bg-cover bg-center" style="background-image: url('<?php echo e(asset('imgs/main.jpg')); ?>');">
  <div class="absolute inset-0 bg-black bg-opacity-75 flex flex-col justify-center items-center text-center text-white px-4">
    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4">Independent Insurance Consultant</h1>
    <h2 class="text-base sm:text-lg md:text-xl lg:text-2xl mb-6">Coverage for your business</h2>
    <a href="<?php echo e(route('quote')); ?>" class="bg-blue-800 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded">
      Get a quote
    </a>
  </div>
</header>






   <!-- About Section -->
<section id="about" class="w-full bg-zinc-900 text-white py-12 px-4 md:px-8 scroll-mt-20">
  <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center">
    
    <!-- Imagen izquierda -->
    <div class="w-full md:w-1/2 flex justify-center mb-10 md:mb-0">
      <img src="<?php echo e(asset('imgs/about-section.png')); ?>" alt="About Image" class="w-64 md:w-80 lg:w-[28rem]">
    </div>

    <!-- Texto derecha -->
    <div class="w-full md:w-1/2 md:pl-8">
      <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">ABOUT US</h2>
      <p class="text-gray-300 mb-6">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur, quisquam accusantium nostrum modi, nemo, officia veritatis ipsum facere maxime assumenda voluptatum enim! Labore maiores placeat impedit, vero sed est voluptas! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita alias dicta autem, maiores doloremque quo perferendis, ut obcaecati harum,
      </p>
      <p class="text-gray-300 mb-6">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum necessitatibus iste, nulla recusandae porro minus nemo eaque cum repudiandae quidem voluptate magnam voluptatum? <br>
        Nobis, saepe sapiente omnis qui eligendi pariatur. quis voluptas. Assumenda facere adipisci quaerat. Illum doloremque quae omnis vitae.
      </p>
      <p class="font-bold text-white mb-6">
        Lonsectetur adipisicing elit. Blanditiis aspernatur, ratione dolore vero asperiores explicabo.
      </p>
      <p class="text-gray-300">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos ab itaque modi, reprehenderit fugit soluta, molestias optio repellat incidunt iure sed deserunt nemo magnam rem explicabo vitae. Cum, nostrum, quidem.
      </p>
    </div>
  </div>
</section>

   
   <!-- OUR SERVICES Section -->
<section id="services" class="w-full bg-zinc-800 text-white py-12 px-4 md:px-8 text-center scroll-mt-20">
  <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">OUR SERVICES</h2>

  <!-- Tabs -->
  <div class="flex justify-center mb-10">
  <div class="flex gap-2">
    <button class="bg-pink-600 text-white px-4 py-2 rounded font-semibold m-0">
      Regulatory requirements
    </button>
  </div>
</div>


 <!-- Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-7xl mx-auto px-4">

  <!-- Card 1 -->
  <div class="bg-zinc-900 border border-gray-700 rounded-md overflow-hidden flex flex-col transform transition duration-300 ease-in-out hover:scale-105 hover:shadow-lg">
    <img src="<?php echo e(asset('imgs/blog-1.jpg')); ?>" alt="MS-150" class="w-full h-56 object-cover">
    <div class="p-6 flex-1 flex flex-col">
      <div class="mb-4">
        <a href="<?php echo e(route('quote')); ?>" class="bg-pink-600 text-white text-lg font-bold px-4 py-2 rounded transition duration-300 ease-in-out hover:bg-pink-500 hover:shadow-md cursor-pointer">
         Insurance policies
        </a>
      </div>
      <p class="text-gray-300 text-sm flex-1">
        Protect your business and personal vehicle: We provide personalized quotes for commercial and personal insurance. We analyze your needs and offer you the right coverage options. A quote is free, and we'll help you make an informed decision.
      </p>
    </div>
  </div>

  <!-- Card 2 -->
  <div class="bg-zinc-900 border border-gray-700 rounded-md overflow-hidden flex flex-col transform transition duration-300 ease-in-out hover:scale-105 hover:shadow-lg">
    <img src="<?php echo e(asset('imgs/blog-2.jpeg')); ?>" alt="MC BOC-3" class="w-full h-56 object-cover">
    <div class="p-6 flex-1 flex flex-col">
      <div class="mb-4">
        <a href="<?php echo e(route('nueva_compañia')); ?>" class="bg-pink-600 text-white text-lg font-bold px-4 py-2 rounded transition duration-300 ease-in-out hover:bg-pink-500 hover:shadow-md cursor-pointer">
          Creation of companies
        </a>
      </div>
      <p class="text-gray-300 text-sm flex-1">
      Company creation from scratch (US DOT number). We help you with the FMCSA application.      </p>
    </div>
  </div>

  <!-- Card 3 -->
  <div class="bg-zinc-900 border border-gray-700 rounded-md overflow-hidden flex flex-col transform transition duration-300 ease-in-out hover:scale-105 hover:shadow-lg">
    <img src="<?php echo e(asset('imgs/blog-3.jpeg')); ?>" alt="UCR 2025" class="w-full h-56 object-cover">
    <div class="p-6 flex-1 flex flex-col">
      <div class="mb-4">
        <a  href="<?php echo e(route('regulatorios')); ?>" class="bg-pink-600 text-white text-lg font-bold px-4 py-2 rounded transition duration-300 ease-in-out hover:bg-pink-500 hover:shadow-md cursor-pointer">
          Regulatory permits
        </a>
      </div>
      <p class="text-gray-300 text-sm flex-1">
        MC Number: Reinstatement (revoked or dismissed) or new application.<br>
        BOC-3, UCR, DOT Reinstatement.<br>
        Company Registration (Articles of Incorporation).<br>
        MVR, Criminal Background Check (state or national), BOIR.
      </p>
    </div>
  </div>

  <!-- Card 4 -->
  <div class="bg-zinc-900 border border-gray-700 rounded-md overflow-hidden flex flex-col transform transition duration-300 ease-in-out hover:scale-105 hover:shadow-lg">
    <img src="<?php echo e(asset('imgs/factoring.jpg')); ?>" alt="UCR 2025" class="w-full h-56 object-cover">
    <div class="p-6 flex-1 flex flex-col">
      <div class="mb-4">
        <a href="<?php echo e(route('factoring')); ?>" class="bg-pink-600 text-white text-lg font-bold px-4 py-2 rounded transition duration-300 ease-in-out hover:bg-pink-500 hover:shadow-md cursor-pointer">
          Factoring
        </a>
      </div>
      <p class="text-gray-300 text-sm flex-1">
        Having trouble paying your freight? We'll take care of it.
      </p>
    </div>
  </div>

</div>


</section>


   <!-- REVIEWS Section -->
<section id="testmonial" class="w-full bg-zinc-900 text-white py-16 border-t border-gray-800 scroll-mt-20 h-[500px]">
  <div class="max-w-6xl mx-auto px-4">
    <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">REVIEWS</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      
      <!-- Review Card -->
      <div class="bg-zinc-800 p-6 rounded-2xl shadow-md hover:shadow-xl transition-shadow">
        <h3 class="text-xl font-semibold mb-1">John Doe</h3>
        <h6 class="text-sm text-gray-400 mb-4">Web Designer</h6>
        <p class="text-gray-300 text-sm leading-relaxed">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum nobis eligendi, quaerat accusamus ipsum sequi dignissimos consequuntur blanditiis natus. Aperiam!</p>
      </div>

      <!-- Review Card -->
      <div class="bg-zinc-800  p-6 rounded-2xl shadow-md hover:shadow-xl transition-shadow">
        <h3 class="text-xl font-semibold mb-1">Steve Thomas</h3>
        <h6 class="text-sm text-gray-400 mb-4">UX/UI Designer</h6>
        <p class="text-gray-300 text-sm leading-relaxed">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum minus obcaecati cum eligendi perferendis magni dolorum ipsum magnam, sunt reiciendis natus. Aperiam!</p>
      </div>

      <!-- Review Card -->
      <div class="bg-zinc-800  p-6 rounded-2xl shadow-md hover:shadow-xl transition-shadow">
        <h3 class="text-xl font-semibold mb-1">Miranda Joy</h3>
        <h6 class="text-sm text-gray-400 mb-4">Graphic Designer</h6>
        <p class="text-gray-300 text-sm leading-relaxed">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, nam. Earum nobis eligendi, dignissimos consequuntur blanditiis natus. Aperiam!</p>
      </div>

    </div>
  </div>
</section>


  <!-- CONTACT Section -->
  <div id="contact" class="w-full bg-zinc-800 text-white border-t border-gray-700">
    <div class="flex flex-col md:flex-row">
      
      <!-- Mapa -->
  <div id="map" ></div>

  <!-- Leaflet JS -->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  


      <!-- Información de contacto -->
      <div class="w-full md:w-1/2 px-8 py-10 flex flex-col justify-center">
        <h3 class="text-2xl font-semibold mb-4">FIND US</h3>
        <p class="text-gray-300 mb-6">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit, laboriosam doloremque odio delectus, sunt magnam laborum impedit molestiae, magni quae ipsum, ullam eos! Alias suscipit impedit et, adipisci illo quam.
        </p>
        <div class="text-gray-400 space-y-2 text-sm">
          <p><span class="pr-2">📍</span> 7399 N. Shadeland Avenue. #230, Indianapolis, IN 46250</p>
          <p><span class="pr-2">📞</span> (765) 244-5222</p>
          <p><span class="pr-2">✉️</span> info@website.com</p>
        </div>
      </div>

    </div>
  </div>

  <!-- Footer -->
    <footer class="bg-zinc-900 text-white border-t border-gray-700 text-center py-10">
        <div class="flex flex-col sm:flex-row justify-center sm:justify-between gap-6 max-w-4xl mx-auto">
            <div>
                <h3 class="text-lg font-semibold mb-1">EMAIL US</h3>
                <p class="text-gray-400 text-sm">info@website.com</p>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-1">CALL US</h3>
                <p class="text-gray-400 text-sm">(765) 244-5222</p>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-1">FIND US</h3>
                <p class="text-gray-400 text-sm">7399 N. Shadeland Avenue. #230, Indianapolis, IN 46250</p>
            </div>
        </div>
    </footer>

</body>
</html>
 
<?php /**PATH C:\xampp\htdocs\proyecto_iic\resources\views/welcome.blade.php ENDPATH**/ ?>