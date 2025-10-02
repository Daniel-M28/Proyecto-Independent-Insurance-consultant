@extends('layouts.app')

@if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif

@section('content')

<div id='exito'><!-- Mensaje de éxito -->
    @if(session('success'))
        <div class=" mt-12 mb-4 p-3 bg-green-600 text-white rounded">
            {{ session('success') }}
        </div>
  </div>
   

    <script>
        setTimeout(() => {
            const alertBox = document.getElementById('exito');
            if (alertBox) {
                alertBox.style.transition = "opacity 0.5s ease";
                alertBox.style.opacity = "0";
                setTimeout(() => alertBox.remove(), 500); 
            }
        }, 3000); 
    </script>
 @endif
 
<div class="bg-[#1e1e2f] text-gray-200 font-sans mt-16">
  <div class="flex flex-col lg:flex-row max-w-7xl mx-auto min-h-screen">
    
    <!-- Sección de información -->
    <div class="w-full lg:w-1/2 p-8 lg:p-16 bg-zinc-800">
      <h1 class="text-4xl font-bold mb-6">Regulatory</h1>
      <p class="text-lg leading-relaxed">
        
        Please provide the following information to request regulatory information.
         Specify which one you require in the comments section. Complete each field 
         with the requested information. We will contact you as soon as possible.
    </div>

    <!-- Formulario -->
    <div class="w-full max-w-2xl bg-[#121212] p-8 lg:p-16 rounded-lg text-white">
      <form action="{{ route('regulatorios.store') }}" method="POST" class="space-y-6">
        @csrf
        <!-- Nombre -->
        <div>
          <label for="name" class="block mb-1 font-semibold">Name</label>
          <input 
            type="text" 
            id="name" 
            name="name" 
            pattern="^[A-Za-z\s]+$" 
            maxlength="30" 
            value="{{ old('name') }}"
            placeholder="Example: Juan"
            oninvalid="this.setCustomValidity('the name can only contain letters and spaces')"
            oninput="this.setCustomValidity('')"
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" 
            required/>
          
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
            value="{{ old('last_name') }}"
            placeholder="Example: Perez Rodriguez"
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
            oninvalid="this.setCustomValidity('Please enter a valid email format')"
            oninput="this.setCustomValidity('')"
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" 
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
          <label for="observations" class="block mb-1 font-semibold">Observations – Request for permit or procedure</label>
          <textarea 
            id="observations" 
            name="observations" 
            rows="4"  
            maxlength="500" 
            value="{{ old('observations') }}"
            placeholder="Describe aquí tu solicitud..."
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400"
          ></textarea>
        </div>

        <!-- Botón -->
        <div>
          <button 
            type="submit"
            class="w-full py-3 bg-blue-600 hover:bg-blue-700 transition-colors text-white font-semibold rounded-md"
          >
            Send Request
          </button>
        </div>

      </form>
    </div>
  </div>
</div>

@if(session('success'))
  <div class="mt-4 p-3 bg-green-600 text-white rounded">
    {{ session('success') }}
  </div>
@endif


@endsection