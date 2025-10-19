@extends('layouts.app')

@if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif

@section('content')

    
<div class="bg-[#1e1e2f] text-gray-200 font-sans mt-16">
  <div class="flex flex-col lg:flex-row max-w-7xl mx-auto min-h-screen">
    
    <!-- Sección de información -->
    <div class="w-full lg:w-1/2 p-8 lg:p-16 bg-zinc-800">

     <!-- Mensajes de éxito y error responsive-->
    <div class="block lg:hidden mb-6">
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-600 text-white rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-3 bg-red-600 text-white rounded">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-4 p-3 bg-red-600 text-white rounded">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>


      <h1 class="text-4xl font-bold mb-6">Factoring</h1>
      <p class="text-lg leading-relaxed">
       Please provide the following information to request regulatory information.
         Specify which one you require in the comments section. Complete each field 
         with the requested information. We will contact you as soon as possible.
      </p>
        <img src="{{ asset('imgs/factoring.jpg') }}" alt="Cotización" class="mt-8 w-full max-w-md mx-auto lg:mx-0 h-auto rounded-lg shadow-md">
    </div>



    <!-- Formulario -->
    <div class="w-full max-w-2xl bg-[#121212] p-8 lg:p-16 rounded-lg text-white">

       <!-- Mensajes de éxito y error -->
            @if(session('success'))
    <div class="hidden lg:block mb-4 p-3 bg-green-600 text-white rounded">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="hidden lg:block mb-4 p-3 bg-red-600 text-white rounded">
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="hidden lg:block mb-4 p-3 bg-red-600 text-white rounded">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            
      <form action="{{ route('factoring.store') }}" method="POST" class="space-y-6 relative" id="factoringForm">
    @csrf

    <!-- Contenedor del spinner y texto -->
<div id="loader" class="hidden fixed inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center z-50">
    <div class="flex items-center gap-2">
        <!-- Spinner -->
        <div class="w-8 h-8 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
        <!-- Texto -->
        <span class="text-white font-semibold text-lg">Submitting request...</span>
    </div>
</div>

        <!-- Nombre -->
        <div>
          <label for="name" class="block mb-1 font-semibold">Name</label>
          <input 
            type="text" 
            id="name" 
            name="name" 
            pattern="^[A-Za-z\s]+$" 
            maxlength="30" 
            placeholder="Example: Juan"
            value="{{ old('name') }}"
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" 
            required
            oninvalid="this.setCustomValidity('the name can only contain letters and spaces')"
            oninput="this.setCustomValidity('')"/>
        </div>
       
        <!-- Apellidos -->
        <div>
          <label for="last-name" class="block mb-1 font-semibold">Lastname</label>
          <input 
            type="text" 
            id="last-name" 
            name="last_name" 
            pattern="^[A-Za-z\s]+$" 
            maxlength="30" 
            placeholder="Example: Perez Rodriguez"
            value="{{ old('last_name') }}"
            oninvalid="this.setCustomValidity('the lastname can only contain letters and spaces')"
            oninput="this.setCustomValidity('')"
            required
            
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" 
            
          >
        </div>


        <!-- Correo electrónico -->
        <div>
          <label for="email" class="block mb-1 font-semibold">Email</label>
          <input 
            type="email" 
            id="email" 
            name="email" 
            maxlength="255" 
            placeholder="email@example.com"
            value="{{ old('email') }}"
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" 
            oninvalid="this.setCustomValidity('Please enter a valid email format')"
            oninput="this.setCustomValidity('')"
            required
          >
        </div>

      
        <!-- Teléfono -->
        <div>
          <label for="phone-number" class="block mb-1 font-semibold">Phone Number</label>
         <input 
        type="tel" 
        id="phone-number" 
        name="phone_number" 
        placeholder="Example: (555) 123-4567" 
        inputmode="numeric" 
        pattern="\(?[0-9]{3}\)?[ -]?[0-9]{3}[ -]?[0-9]{4}" 
        maxlength="20" 
        value="{{ old('phone_number') }}"
        required
        class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
        </div>

    @error('phone_number')
        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
    @enderror

        <!-- Observaciones -->
        <div>
          <label for="observations" class="block mb-1 font-semibold">Observations – Request for service</label>
          <textarea 
            id="observations" 
            name="observations" 
            rows="4"  
            maxlength="500" 
            placeholder="Describe your application:"
            value="{{ old('observations') }}"
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400"
            required
          ></textarea>
        </div>

       <!-- Botón -->
    <div>
        <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md">
            Send Request
        </button>
    </div>
</form>

<!-- Script para manejar el spinner  -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('factoringForm');
    const loader = document.getElementById('loader');
    const submitButton = form.querySelector('button[type="submit"]');

    form.addEventListener('submit', () => {
        loader.classList.remove('hidden'); // muestra el spinner
        submitButton.disabled = true;      // desactiva el botón
        submitButton.classList.add('opacity-50', 'cursor-not-allowed');
    });
});
</script>



@endsection