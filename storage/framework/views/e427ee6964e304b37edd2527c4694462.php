<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

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
                <li><a href="<?php echo e(url('/')); ?>#reviews" class="hover:text-gray-300">Reviews</a></li>
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
                                <span><?php echo e(auth()->user()->name); ?></span>
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

            <!-- Mobile menu -->
            <div id="mobile-menu" class="md:hidden hidden px-4 pt-2 pb-4 space-y-2 font-semibold bg-black bg-opacity-80">
                <a href="#home" class="block hover:text-gray-300">Home</a>
                <a href="#about" class="block hover:text-gray-300">About</a>
                <a href="#blog" class="block hover:text-gray-300">Services</a>
                <a href="#testmonial" class="block hover:text-gray-300">Reviews</a>
                <a href="#contact" class="block hover:text-gray-300">Contact Us</a>
                <?php if(Route::has('login')): ?>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(url('/dashboard')); ?>" class="block hover:text-gray-300"><?php echo e(auth()->user()->name); ?></a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="block hover:text-gray-300">Log in</a>
                        <?php if(Route::has('register')): ?>
                            <a href="<?php echo e(route('register')); ?>" class="block hover:text-gray-300">Register</a>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- Banderas también en móvil -->
                <div class="flex items-center space-x-2 pt-2">
                    <button class="btn-lang" data-lang="es">
                        <img src="<?php echo e(asset('imgs/es.png')); ?>" alt="Español" width="24" height="16">
                    </button>
                    <button class="btn-lang" data-lang="en">
                        <img src="<?php echo e(asset('imgs/en.png')); ?>" alt="English" width="24" height="16">
                    </button>
                </div>
            </div>
        </div>
    </nav>
</header>



    <!-- Aquí insertamos el contenido de cada vista -->
    <main class="pt-8 pb-2  max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <footer class="mt-16 bg-zinc-900 text-white border-t border-gray-700 text-center py-10">
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