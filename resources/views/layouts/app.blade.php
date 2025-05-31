<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-zinc-900 text-white">

    <header>
        <!-- Navbar -->
        <nav class=" fixed top-0 left-0 w-full z-50 bg-transparent text-white ">
            <div class="max-w-7xl mx-auto flex flex-wrap justify-between items-center px-4 md:px-6 py-4">
                <!-- Left nav -->
                <ul class="hidden md:flex space-x-6 font-semibold p-2">
                    <li><a href="#home" class="hover:text-gray-300">Home</a></li>
                    <li><a href="#about" class="hover:text-gray-300">About</a></li>
                    <li><a href="#blog" class="hover:text-gray-300">Services</a></li>
                    <li><a href="#testmonial" class="hover:text-gray-300">Reviews</a></li>
                    <li><a href="#contact" class="hover:text-gray-300">Contact Us</a></li>
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
                <a href="#" class="absolute left-1/2 transform -translate-x-1/2 pt-4">
                    <img src="{{ asset('imgs/loge.png') }}" alt="Logo" class="h-20 md:h-20" />
                </a>

                <!-- Right nav -->
                <ul class="hidden md:flex space-x-4 font-semibold">
                    @if (Route::has('login'))
                        @auth
                            <li>
                                <a href="{{ url('/dashboard') }}" class="hover:text-gray-300">
                                    {{ auth()->user()->name }}
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('login') }}" class="bg-blue-800 text-white px-4 py-1 rounded hover:bg-blue-700">
                                    Log in
                                </a>
                            </li>
                            @if (Route::has('register'))
                                <li>
                                    <a href="{{ route('register') }}" class="hover:text-gray-300">Register</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>

            <!-- Mobile menu -->
            <div id="mobile-menu" class="md:hidden hidden px-4 pt-2 pb-4 space-y-2 font-semibold bg-black bg-opacity-80">
                <a href="#home" class="block hover:text-gray-300">Home</a>
                <a href="#about" class="block hover:text-gray-300">About</a>
                <a href="#blog" class="block hover:text-gray-300">Services</a>
                <a href="#testmonial" class="block hover:text-gray-300">Reviews</a>
                <a href="#contact" class="block hover:text-gray-300">Contact Us</a>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="block hover:text-gray-300">{{ auth()->user()->name }}</a>
                    @else
                        <a href="{{ route('login') }}" class="block hover:text-gray-300">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="block hover:text-gray-300">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>

       
    </header> 

    <!-- Aquí insertamos el contenido de cada vista -->
    <main class="pt-8 pb-2  max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @yield('content')
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
</body>
</html>