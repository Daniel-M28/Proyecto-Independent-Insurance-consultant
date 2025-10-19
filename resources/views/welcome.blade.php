@extends('layouts.app')
@php $fullWidth = true; @endphp 

@section('content')

{{--Muestra la confirmación de eliminacion de perfil de usuario 5s --}}
  @if (session('status'))
    <div id="alert-status"  
         class="fixed top-4 left-1/2 transform -translate-x-1/2 
                bg-green-600 text-white p-4 rounded mb-4 text-center shadow-lg 
                z-50 w-[90%] md:w-auto">
        {{ session('status') }}
    </div>

    <script>
        setTimeout(() => {
            const alertBox = document.getElementById('alert-status');
            if (alertBox) {
                alertBox.style.transition = "opacity 0.5s ease";
                alertBox.style.opacity = "0";
                setTimeout(() => alertBox.remove(), 500); 
            }
        }, 3000); 
    </script>
@endif


<!-- Main Section -->
<main id="home" class="relative w-full h-screen bg-cover bg-center" style="background-image: url('{{ asset('imgs/main.jpg') }}');">
  <div class="absolute inset-0 bg-black bg-opacity-75 flex flex-col justify-center items-center text-center text-white px-4">
    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4">Independent Insurance Consultant</h1>
    <h2 class="text-base sm:text-lg md:text-xl lg:text-2xl mb-6">Coverage for your business</h2>
    
    <!--Button get a quote-->
    <a href="{{ route('quote') }}" class="bg-blue-800 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded">
      Get a quote
    </a>
  </div>
</main>


   <!-- About Section -->
  <section id="about" class="w-full bg-zinc-900 text-white py-12 px-4 md:px-8 scroll-mt-20">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center">
    
      <!-- left image -->
      <div class="w-full md:w-1/2 flex justify-center mb-10 md:mb-0">
        <img src="{{ asset('imgs/about-section.png') }}" alt="About Image" class="w-64 md:w-80 lg:w-[28rem]">
      </div>

      <!-- right text -->
      <div class="w-full md:w-1/2 md:pl-8">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">ABOUT US</h2>
         <p class="text-gray-300 mb-6">
            At Independent Insurance Consultant, we specialize in providing commercial truck insurance
             solutions designed to protect drivers, independent owner-operators, and fleet businesses 
             across the United States.
            
            <br>We know that your truck is more than just a vehicle — it's your business, your 
            livelihood, and your future. That's why we're dedicated to offering reliable, affordable,
            and customized coverage that fits your unique needs, from commercial auto liability
            to cargo and physical damage protection.
            <br><br>Our mission is simple: to help you stay protected, compliant, and confident 
            on every mile of your journey. With personalized service and expert guidance, 
            we make insurance easy to understand and easy to trust.
          </p>
     
        <p class="font-bold text-white mb-6">
          At Independent Insurance Consultant, you're not just getting a policy — you're gaining
           a partner committed to keeping you and your business moving forward.
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
    <img src="{{ asset('imgs/blog-1.jpg') }}" alt="MS-150" class="w-full h-56 object-cover">
    <div class="p-6 flex-1 flex flex-col">
      <div class="mb-4">
        <a href="{{ route('quote') }}" class="bg-pink-600 text-white text-lg font-bold px-4 py-2 rounded transition duration-300 ease-in-out hover:bg-pink-500 hover:shadow-md cursor-pointer">
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
    <img src="{{ asset('imgs/blog-2.jpeg') }}" alt="MC BOC-3" class="w-full h-56 object-cover">
    <div class="p-6 flex-1 flex flex-col">
      <div class="mb-4">
        <a href="{{ route('nueva_compañia') }}" class="bg-pink-600 text-white text-lg font-bold px-4 py-2 rounded transition duration-300 ease-in-out hover:bg-pink-500 hover:shadow-md cursor-pointer">
          Creation of companies
        </a>
      </div>
      <p class="text-gray-300 text-sm flex-1">
      Company creation from scratch (US DOT number). We help you with the FMCSA application.      </p>
    </div>
  </div>

  <!-- Card 3 -->
  <div class="bg-zinc-900 border border-gray-700 rounded-md overflow-hidden flex flex-col transform transition duration-300 ease-in-out hover:scale-105 hover:shadow-lg">
    <img src="{{ asset('imgs/blog-3.jpeg') }}" alt="UCR 2025" class="w-full h-56 object-cover">
    <div class="p-6 flex-1 flex flex-col">
      <div class="mb-4">
        <a  href="{{ route('regulatorios_form') }}" class="bg-pink-600 text-white text-lg font-bold px-4 py-2 rounded transition duration-300 ease-in-out hover:bg-pink-500 hover:shadow-md cursor-pointer">
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
    <img src="{{ asset('imgs/factoring.jpg') }}" alt="UCR 2025" class="w-full h-56 object-cover">
    <div class="p-6 flex-1 flex flex-col">
      <div class="mb-4">
        <a href="{{ route('factoring') }}" class="bg-pink-600 text-white text-lg font-bold px-4 py-2 rounded transition duration-300 ease-in-out hover:bg-pink-500 hover:shadow-md cursor-pointer">
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
<section id="testmonial" class="w-full bg-zinc-900 text-white py-16 border-t border-gray-800 scroll-mt-20 min-h-[500px]">
  <div class="max-w-6xl mx-auto px-4">
    <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">REVIEWS</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      
      <div class="bg-zinc-800 p-6 rounded-2xl shadow-md transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:bg-zinc-700/90">
        <h3 class="text-xl font-semibold mb-1">Veronica Rossi</h3>
        <h6 class="text-sm text-gray-400 mb-4">Union, SC</h6>
        <p class="text-gray-300 text-sm leading-relaxed">“With Independent Insurance Consultant I feel at ease. They not only helped me with my truck insurance but also with all the regulatory paperwork. They explained everything step by step and made sure everything was done right. Very professional and friendly team.”</p>
      </div>

      <div class="bg-zinc-800 p-6 rounded-2xl shadow-md transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:bg-zinc-700/90">
        <h3 class="text-xl font-semibold mb-1">Gorge Perez Reyes</h3>
        <h6 class="text-sm text-gray-400 mb-4">Greenwood, IN</h6>
        <p class="text-gray-300 text-sm leading-relaxed">“With Independent Insurance Consultant I feel at ease. They not only helped me with my truck insurance but also with all the regulatory paperwork. They explained everything step by step and made sure everything was done right.”</p>
      </div>

      <div class="bg-zinc-800 p-6 rounded-2xl shadow-md transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:bg-zinc-700/90">
        <h3 class="text-xl font-semibold mb-1">Joshua Encarnación</h3>
        <h6 class="text-sm text-gray-400 mb-4">Tampa, FL</h6>
        <p class="text-gray-300 text-sm leading-relaxed">“I had an issue with my policy and they helped me right away. They offered fast and effective solutions, and that makes all the difference. A reliable service with people who truly understand the needs of Latino truck drivers.”</p>
      </div>

    </div>
  </div>
</section>


<div class="h-8 bg-transparent"></div>

<!-- CONTACT Section -->
<div id="contact" class="w-full bg-zinc-800 text-white border-t border-gray-700">
  <div class="flex flex-col md:flex-row">
    <!-- Map -->
    <div id="map" class="w-full md:w-1/2"></div>

    <!-- Contact info -->
    <div class="w-full md:w-1/2 px-8 py-10 flex flex-col justify-center mt-16 md:mt-0">
      <h3 class="text-2xl font-semibold mb-4">FIND US</h3>
      <p class="text-gray-300 mb-6">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit, laboriosam doloremque odio delectus.
      </p>
      <div class="text-gray-400 space-y-2 text-sm">
        <p><span class="pr-2">📍</span> 7399 N. Shadeland Avenue. #230, Indianapolis, IN 46250</p>
        <p><span class="pr-2">📞</span> (765) 244-5222</p>
        <p><span class="pr-2">✉️</span> info@website.com</p>
      </div>
    </div>
  </div>
</div>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
 
@endsection