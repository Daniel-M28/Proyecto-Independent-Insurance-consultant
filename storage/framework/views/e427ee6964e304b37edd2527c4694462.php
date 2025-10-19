<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

      <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <script src="//unpkg.com/alpinejs" defer></script>

</head>
<body class="bg-zinc-900 text-white">

    
<header>
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 w-full z-50 bg-transparent text-white">
        <div class="max-w-7xl mx-auto flex flex-wrap justify-between items-center px-4 md:px-6 py-4">
            

        
            <!-- Left nav -->
            <ul class="hidden md:flex space-x-6 font-semibold p-2">
                <li><a href="<?php echo e(url('/')); ?>#home" class="hover:text-gray-300">Home</a></li>
                <li><a href="<?php echo e(url('/')); ?>#about" class="hover:text-gray-300">About</a></li>
                <li><a href="<?php echo e(url('/')); ?>#services" class="hover:text-gray-300">Services</a></li>
                <li><a href="<?php echo e(url('/')); ?>#testmonial" class="hover:text-gray-300">Reviews</a></li>
                <li><a href="<?php echo e(url('/')); ?>#contact" class="hover:text-gray-300">Contact Us</a></li>
            </ul>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button id="menu-toggle" class="focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Logo center -->
            <a href="<?php echo e(url('/')); ?>#home" class="absolute left-1/2 transform -translate-x-1/2 pt-4">
                <img src="<?php echo e(asset('imgs/loge.png')); ?>" alt="Logo" class="h-20 md:h-20" />
            </a>

            <!-- Right nav -->
            <ul class="hidden md:flex space-x-4 font-semibold items-center">
                <?php if(Route::has('login')): ?>
                    <?php if(auth()->guard()->check()): ?>
                        <!-- Usuario logueado -->
                        <li class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                            <button class="flex items-center space-x-2 focus:outline-none">
                                <span><?php echo e(auth()->user()->name); ?>  <?php echo e(auth()->user()->lastname); ?>   </span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Menú desplegable -->
                            <ul x-show="open" x-transition
                                class="absolute right-0 mt-2 w-48 bg-zinc-800 text-white rounded-md shadow-lg z-50 text-right"
                                style="display: none;">
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
                        <!-- Usuario no logueado -->
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

                <!-- Banderas SIEMPRE visibles -->
                <li class="flex items-center space-x-2">
                    <button class="btn-lang" data-lang="es">
                        <img src="<?php echo e(asset('imgs/es.png')); ?>" alt="Español" width="24" height="16">
                    </button>
                    <button class="btn-lang" data-lang="en">
                        <img src="<?php echo e(asset('imgs/en.png')); ?>" alt="English" width="24" height="16">
                    </button>
                </li>
            </ul>

            
        </div>
    </nav>
</header>


<!--  Mobile menu  -->
    <!-- Mobile menu -->
<div id="mobile-menu"
     class="md:hidden hidden fixed inset-0 top-0 left-0 w-full px-4 pt-2 pb-6 space-y-3 font-semibold 
            bg-black bg-opacity-95 z-50 backdrop-blur-md transition-all duration-300 overflow-y-auto">


            <!-- Checkbox oculto que controla el menú -->
        <input type="checkbox" id="menu-toggle" class="hidden peer" />

        <!-- Botón hamburguesa -->
        <label for="menu-toggle" class="cursor-pointer md:hidden z-50 ">
      <!-- Ícono hamburguesa -->
      <svg
        class="w-7 h-7 peer-checked:hidden"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M4 6h16M4 12h16M4 18h16"
        ></path>
      </svg>

      <!-- Ícono cerrar -->
      <svg
        class="w-7 h-7 hidden peer-checked:block"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M6 18L18 6M6 6l12 12"
        ></path>
        </svg>
     </label>



        <nav class="space-y-3 mt-8">
            <a href="<?php echo e(url('/')); ?>#home" class="block hover:text-gray-300 transition">Home</a>
            <a href="<?php echo e(url('/')); ?>#about" class="block hover:text-gray-300 transition">About</a>
            <a href="<?php echo e(url('/')); ?>#services" class="block hover:text-gray-300 transition">Services</a>
            <a href="<?php echo e(url('/')); ?>#testmonial" class="block hover:text-gray-300 transition">Reviews</a>
            <a href="<?php echo e(url('/')); ?>#contact" class="block hover:text-gray-300 transition">Contact Us</a>
        </nav>

        <div class="border-t border-gray-700 pt-4">
            <?php if(Route::has('login')): ?>
                <?php if(auth()->guard()->check()): ?>
                    <div class="space-y-2">
                        <p class="text-gray-400 text-sm">Signed in as:</p>
                        <p class="text-lg font-semibold"><?php echo e(auth()->user()->name); ?></p>

                        <div class="flex flex-col space-y-2 pt-2">
                            <a href="<?php echo e(url('/dashboard')); ?>" class="block bg-blue-600 hover:bg-blue-700 text-center rounded-lg py-2 transition">Dashboard</a>
                            <a href="<?php echo e(route('profile.edit')); ?>" class="block bg-green-600 hover:bg-green-700 text-center rounded-lg py-2 transition">Profile</a>
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white rounded-lg py-2 transition">Log out</button>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="flex flex-col space-y-2">
                        <a href="<?php echo e(route('login')); ?>" class="block bg-blue-700 hover:bg-blue-800 text-center rounded-lg py-2 transition">Log in</a>
                        <?php if(Route::has('register')): ?>
                            <a href="<?php echo e(route('register')); ?>" class="block bg-blue-700 hover:bg-blue-800 text-center rounded-lg py-2 transition">Register</a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="flex items-center justify-center space-x-3 border-t border-gray-700 pt-4">
            <button class="btn-lang" data-lang="es">
                <img src="<?php echo e(asset('imgs/es.png')); ?>" alt="Español" width="28" height="18">
            </button>
            <button class="btn-lang" data-lang="en">
                <img src="<?php echo e(asset('imgs/en.png')); ?>" alt="English" width="28" height="18">
            </button>
        </div>


   
    </div>
</nav>



    <!-- Aquí insertamos el contenido de cada vista -->
        <!-- Aquí insertamos el contenido de cada vista -->
    <?php if(!empty($fullWidth) && $fullWidth === true): ?>
        
        <?php echo $__env->yieldContent('content'); ?>
    <?php else: ?>
        
        <main class="pt-8 pb-2 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    <?php endif; ?>

    <!-- Footer -->
    <footer class="mt-16 bg-zinc-900 text-white border-t border-gray-700 text-center py-10">
        <div class="flex flex-col sm:flex-row justify-center sm:justify-between gap-6 max-w-4xl mx-auto">
            <div>
                <h3 class="text-lg font-semibold mb-1">EMAIL US</h3>
                <p class="text-gray-400 text-sm">info@insuranceconsultantapp.com</p>
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




<div id="google_translate_element" style="display:none;"></div>


<script>
  function googleTranslateElementInit() {
    new google.translate.TranslateElement(
      { pageLanguage: 'es', includedLanguages: 'es,en', autoDisplay: false },
      'google_translate_element'
    );
  }
</script>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


</body>
</html>

<?php /**PATH C:\xampp\htdocs\proyecto_iic\resources\views/layouts/app.blade.php ENDPATH**/ ?>