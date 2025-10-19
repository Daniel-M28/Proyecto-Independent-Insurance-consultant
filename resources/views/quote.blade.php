@extends('layouts.app')

@section('content')


<div class="bg-[#1e1e2f] text-gray-200 font-sans mt-16">
  <div class="flex flex-col lg:flex-row max-w-7xl mx-auto min-h-screen">

    <!-- Sección izquierda con info e imágenes -->
    <div class="w-full lg:w-1/2 p-8 lg:p-16 bg-zinc-800">
        
    <!-- Mensajes de éxito y error -->
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



      <h1 class="text-4xl font-bold mb-6">Commercial Insurance Quote</h1>
      <p class="text-lg leading-relaxed">
        Provide the following information to obtain your quote.
      </p>
      <img src="{{ asset('imgs/quote.png') }}" alt="Cotización Comercial" class="mt-8 w-full max-w-md mx-auto lg:mx-0 h-auto rounded-lg shadow-md">
      <div class="text-center mt-4">
        <button onclick="mostrarFormulario('comercial')" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-semibold transition">Request a Commercial Quote</button>
      </div>

      <h1 class="text-4xl font-bold mb-6 mt-32">Personal Car Quote</h1>
      <p class="text-lg leading-relaxed">
        Provide the following information to quote your personal vehicle.
      </p>
      <img src="{{ asset('imgs/auto.png') }}" alt="Cotización Auto Personal" class="mt-8 w-full max-w-md mx-auto lg:mx-0 h-auto rounded-lg shadow-md">
      <div class="text-center mt-4">
        <button onclick="mostrarFormulario('personal')" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-semibold transition">Request a Personal Car Quote</button>
      </div>
    </div>

    <!-- Sección derecha con formularios -->
    <div class="w-full lg:w-1/2 bg-[#121212] p-8 lg:p-16">
      
      <!-- Formulario Comercial -->

 <!-- Mensajes de éxito y error, responsive -->
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


<!-- Spinner compartido, fuera de los formularios -->
<div id="loader" class="hidden fixed inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center z-50">
    <div class="flex items-center gap-2">
        <div class="w-8 h-8 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
        <span class="text-white font-semibold text-lg">Submitting request...</span>
    </div>
</div>


<form 
    id="form-comercial" 
    action="{{ route('commercial.store') }}" 
    method="post" 
    enctype="multipart/form-data" 
    class="space-y-6"
>
    @csrf


    <h2 class="text-2xl font-bold mb-4">Commercial Form</h2>

    <!-- USDOT -->
    <div>
        <label for="usdot" class="block mb-1 font-semibold">USDOT</label>
        <input 
            type="text" 
            id="usdot" 
            name="usdot" 
            placeholder="USDOT number" 
            inputmode="numeric" 
            pattern="^[0-9]{1,8}$" 
            maxlength="8"  
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" 
            required
            value="{{ old('usdot') }}"
            oninvalid="this.setCustomValidity(!this.value ? 'USDOT is required' : 'Enter only numbers, up to 8 digits')"
            oninput="this.setCustomValidity('')"
        >
    </div>

    <!-- Name -->
    <div>
        <label for="name-commercial" class="block mb-1 font-semibold">Name</label>
        <input 
            type="text" 
            id="name-commercial" 
            name="name" 
            placeholder="Example: Juan" 
            maxlength="30" 
            pattern="^[A-Za-z\s]+$" 
            value="{{ old('name') }}"
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" 
            required
            oninvalid="this.setCustomValidity(!this.value ? 'Name is required' : 'Only letters are allowed')"
            oninput="this.setCustomValidity('')"
        >
    </div>

    <!-- Lastname -->
    <div>
        <label for="lastname-commercial" class="block mb-1 font-semibold">Lastname</label>
        <input 
            type="text" 
            id="lastname-commercial" 
            name="lastname" 
            placeholder="Example: Perez Rodriguez" 
            maxlength="30" 
            pattern="^[A-Za-z\s]+$" 
            value="{{ old('lastname') }}"
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400"
            required
            oninvalid="this.setCustomValidity(!this.value ? 'Lastname is required' : 'Only letters are allowed')"
            oninput="this.setCustomValidity('')"
        >
    </div>

    <!-- Phone -->
    <div>
        <label for="phone-commercial" class="block mb-1 font-semibold">Phone Number</label>
        <input 
            type="tel" 
            id="phone-commercial" 
            name="phone" 
            placeholder="Example (555) 123-4567" 
            inputmode="numeric" 
            pattern="^(\(\d{3}\)\s?|\d{3}[-\s]?)\d{3}[-\s]?\d{4}$" 
            maxlength="20" 
            value="{{ old('phone') }}"
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" 
            required
            oninvalid="this.setCustomValidity(!this.value ? 'Phone number is required' : 'Enter a valid phone number format')"
            oninput="this.setCustomValidity('')"
        >
    </div>

    <!-- Email -->
    <div>
        <label for="email-commercial" class="block mb-1 font-semibold">Email</label>
        <input 
            type="email" 
            id="email-commercial" 
            name="email" 
            placeholder="Email@example.com" 
            maxlength="255" 
            value="{{ old('email') }}"
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" 
            required
            oninvalid="this.setCustomValidity(!this.value ? 'Email is required' : 'Enter a valid email address')"
            oninput="this.setCustomValidity('')"
        >
    </div>

    <!-- Business address -->
    <div>
        <label for="business-address" class="block mb-1 font-semibold">Business address</label>
        <input 
            type="text" 
            id="business-address" 
            name="business_address" 
            placeholder="1234 Elm Street, Springfield, IL 62704" 
            maxlength="100" 
            value="{{ old('business_address') }}"
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" 
            required
            oninvalid="this.setCustomValidity(!this.value ? 'Business address is required' : 'Invalid format')"
            oninput="this.setCustomValidity('')"
        >
    </div>

    <!-- VIN -->
    <div>
        <label for="vin-commercial" class="block mb-1 font-semibold">VIN</label>
        <input 
            type="text" 
            id="vin-commercial" 
            name="vin" 
            placeholder="Example: 1HGCM82633A123456, JH4KA8260MC123456" 
            pattern="^[A-HJ-NPR-Z0-9]{17}(,\s*[A-HJ-NPR-Z0-9]{17})*$" 
            value="{{ old('vin') }}"
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" 
            required
            oninvalid="this.setCustomValidity(!this.value ? 'VIN is required' : 'Enter one or more valid 17-character VINs')"
            oninput="this.setCustomValidity('')"
        >
        <small>Separate multiple VINs with commas</small>
    </div>

    <!-- Parking space (optional) -->
    <div>
        <label for="yard-commercial" class="block mb-1 font-semibold">Parking space (optional)</label>
        <input 
            type="text" 
            id="yard-commercial" 
            name="yard" 
            placeholder="1234 Elm Street, Springfield, IL 62704"  
            maxlength="100"  
            value="{{ old('yard') }}"
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400"
        >
    </div>

    <!-- Miles -->
    <div>
        <label for="miles-commercial" class="block mb-1 font-semibold">Miles</label>
        <input 
            type="number" 
            id="miles-commercial" 
            name="miles" 
            min="1" 
            max="1000000" 
            step="1" 
            placeholder="Example 1500" 
            value="{{ old('miles') }}"
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" 
            required
            oninvalid="this.setCustomValidity(!this.value ? 'Miles are required' : 'Enter a number between 1 and 1,000,000')"
            oninput="this.setCustomValidity('')"
        >
    </div>

    <!-- Type of load -->
    <div>
        <label for="type-of-load" class="block mb-1 font-semibold">Type of load</label>
        <select 
            id="type-of-load" 
            name="type_of_load" 
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md text-gray-200" 
            required
            oninvalid="this.setCustomValidity('Please select a type of load')"
            oninput="this.setCustomValidity('')"
        >
            <option value="">-- Select an option --</option>
            <option value="dryvan" {{ old('type_of_load')=='dryvan' ? 'selected' : '' }}>Dryvan</option>
            <option value="reefer" {{ old('type_of_load')=='reefer' ? 'selected' : '' }}>Reefer</option>
            <option value="flatbed" {{ old('type_of_load')=='flatbed' ? 'selected' : '' }}>Flatbed</option>
            <option value="carhauler" {{ old('type_of_load')=='carhauler' ? 'selected' : '' }}>Car Hauler</option>
            <option value="towing" {{ old('type_of_load')=='towing' ? 'selected' : '' }}>Towing</option>
        </select>
    </div>

    <!-- Coverages -->
    <div>
        <label class="block mb-1 font-semibold">Coverages</label>
        <div class="flex flex-col gap-2">
            <label class="inline-flex items-center">
                <input 
                    type="checkbox" 
                    name="coverages[]" 
                    value="liability" 
                    class="form-checkbox text-blue-500 bg-gray-700 border-gray-600 rounded"
                    required
                >
                <span class="ml-2">Liability $1M</span>
            </label>
            <label class="inline-flex items-center">
                <input 
                    type="checkbox" 
                    name="coverages[]" 
                    value="cargo" 
                    class="form-checkbox text-blue-500 bg-gray-700 border-gray-600 rounded"
                >
                <span class="ml-2">Cargo $100K</span>
            </label>
        </div>
    </div>

    <!-- Licenses -->
    <div class="mb-4">
    <label for="licenses-commercial" class="block mb-1 font-semibold">
        Driver license(s) and other documents
    </label>
    <input 
        type="file" 
        id="licenses-commercial" 
        name="licenses[]" 
        multiple 
        accept=".jpeg,.jpg,.png,.pdf" 
        class="block w-full text-gray-300 mt-2 border border-gray-600 rounded p-2"
        required
    > 
    <small class="text-gray-400">Allowed formats: JPG, PNG, PDF. Max 6 files, 5MB each.</small>
    @error('licenses')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
    @error('licenses.*')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>


    <!-- Comments -->
    <div>
        <label for="comments-commercial" class="block mb-1 font-semibold">Additional comments</label>
        <textarea 
            id="comments-commercial" 
            name="comments" 
            rows="4" 
            maxlength="500" 
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400"
            oninvalid="this.setCustomValidity('Maximum 500 characters allowed')"
            oninput="this.setCustomValidity('')"
        >{{ old('comments') }}</textarea>
    </div>

    <!-- Button -->
    <button 
        type="submit" 
        class="w-full py-3 bg-blue-600 hover:bg-blue-700 transition-colors text-white font-semibold rounded-md"
    >
        Request a Quote
    </button>
</form>


<!-- Formulario Auto Personal -->
 

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

<form 
    id="form-personal" 
    action="{{ route('admin.personal-quotes.store') }}" 
    method="post" 
    enctype="multipart/form-data" 
    class="space-y-6 hidden"
>
    @csrf
    <!-- Contenedor del spinner y texto -->


    <h2 class="text-2xl font-bold mb-4">Personal Vehicle Form</h2>

    <!-- Name -->
    <div>
        <label for="name-personal" class="block mb-1 font-semibold">Name</label>
        <input 
            type="text" 
            id="name-personal" 
            name="name" 
            placeholder="Example: Juan" 
            pattern="^[A-Za-z\s]+$" 
            maxlength="30" 
            value="{{ old('name') }}"
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" 
            required
            oninvalid="this.setCustomValidity(this.validity.valueMissing ? 'Name is required' : 'Only letters are allowed')"
            oninput="this.setCustomValidity('')"
        >
    </div>

    <!-- Lastname -->
    <div>
        <label for="lastname-personal" class="block mb-1 font-semibold">Lastname</label>
        <input 
            type="text" 
            id="lastname-personal" 
            name="lastname" 
            placeholder="Example: Perez Rodriguez" 
            pattern="^[A-Za-z\s]+$" 
            maxlength="30" 
            value="{{ old('lastname') }}"
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" 
            required
            oninvalid="this.setCustomValidity(this.validity.valueMissing ? 'Lastname is required' : 'Only letters are allowed')"
            oninput="this.setCustomValidity('')"
        >
    </div>

    <!-- Date of Birth -->
    <div>
        <label class="block mb-1 font-semibold">Date of birth</label>
        <input 
            type="date" 
            name="dob"  
            max="{{ date('Y-m-d') }}" 
            value="{{ old('dob') }}" 
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md text-gray-300" 
            required
            oninvalid="this.setCustomValidity('Date of birth is required')"
            oninput="this.setCustomValidity('')"
        >
    </div>

    <!-- Email -->
    <div>
        <label for="email-personal" class="block mb-1 font-semibold">Email</label>
        <input 
            type="email" 
            id="email-personal" 
            name="email" 
            placeholder="email@example.com" 
            maxlength="255" 
            value="{{ old('email') }}"
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" 
            required
            oninvalid="this.setCustomValidity(this.validity.valueMissing ? 'Email is required' : 'Please enter a valid email address')"
            oninput="this.setCustomValidity('')"
        >
    </div>

    <!-- Phone -->
    <div>
        <label for="phone-personal" class="block mb-1 font-semibold">Phone Number</label>
        <input 
            type="tel" 
            id="phone-personal" 
            name="phone" 
            placeholder="Example (555) 123-4567" 
            inputmode="numeric" 
            pattern="^(\(\d{3}\)\s?|\d{3}[-\s]?)\d{3}[-\s]?\d{4}$" 
            maxlength="20" 
            value="{{ old('phone') }}"
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" 
            required
            oninvalid="this.setCustomValidity(this.validity.valueMissing ? 'Phone number is required' : 'Enter a valid US phone number')"
            oninput="this.setCustomValidity('')"
        >
    </div>

    <!-- Address -->
    <div>
        <label for="address-personal" class="block mb-1 font-semibold">Address</label>
        <input 
            type="text" 
            id="address-personal" 
            name="address" 
            placeholder="1234 Elm Street, Springfield, IL 62704" 
            maxlength="100" 
            value="{{ old('address') }}"
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" 
            required
            oninvalid="this.setCustomValidity('Address is required')"
            oninput="this.setCustomValidity('')"
        >
    </div>

    <!-- ISS Date -->
    <div>
        <label class="block mb-1 font-semibold">Date of issue ISS</label>
        <input 
            type="date" 
            name="iss_date" 
            max="{{ date('Y-m-d') }}" 
            value="{{ old('iss_date') }}"
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md text-gray-300" 
            required
            oninvalid="this.setCustomValidity('Issue date is required')"
            oninput="this.setCustomValidity('')"
        >
    </div>

    <!-- Occupation -->
    <div>
        <label class="block mb-1 font-semibold">Occupation</label>
        <input 
            type="text" 
            id="occupation-personal" 
            name="occupation" 
            maxlength="50" 
            placeholder="Driver"
            value="{{ old('occupation') }}"
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md"  
            required
            oninvalid="this.setCustomValidity('Occupation is required')"
            oninput="this.setCustomValidity('')"
        >
    </div>

    <!-- Miles -->
    <div>
        <label for="miles" class="block mb-1 font-semibold">Miles</label>
        <input 
            type="number" 
            id="miles" 
            name="miles" 
            min="1" 
            max="1000000" 
            step="1" 
            placeholder="Example: 500" 
            value="{{ old('miles') }}"
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" 
            required
            oninvalid="this.setCustomValidity(this.validity.valueMissing ? 'Miles are required' : 'Enter a number between 1 and 1,000,000')"
            oninput="this.setCustomValidity('')"
        >
    </div>

    <!-- VIN -->
    <div>
        <label for="vin" class="block mb-1 font-semibold">VIN</label>
        <input 
            type="text" 
            id="vin" 
            name="vin" 
            pattern="^[A-HJ-NPR-Z0-9]{17}(,\s*[A-HJ-NPR-Z0-9]{17})*$" 
            value="{{ old('vin') }}"
            placeholder="Example: 1HGCM82633A123456, JH4KA8260MC123456" 
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" 
            required
            oninvalid="this.setCustomValidity(this.validity.valueMissing ? 'VIN is required' : 'Enter a valid VIN (17 characters)')"
            oninput="this.setCustomValidity('')"
        >
        <small>Enter your 17-character VIN. If you have more than one, separate them with commas</small>
    </div>

    <!-- Coverage -->
    <div>
        <label class="block mb-1 font-semibold">Coverages</label>
        <select 
            name="coverage" 
            id="coverage-personal" 
            value="{{ old('coverage') }}"
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md text-gray-200"  
            required
            oninvalid="this.setCustomValidity('Coverage is required')"
            oninput="this.setCustomValidity('')"
        >
            <option value="">-- Select coverage --</option>
            <option value="basic">Basic</option>
            <option value="full cover">Full Cover</option>
        </select>
    </div>

    <!-- Vehicle Data -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block mb-1 font-semibold">Vehicle Type</label>
            <input 
                type="text" 
                name="vehicle_type" 
                placeholder="Car-Pickup" 
                maxlength="30" 
                value="{{ old('vehicle_type') }}"
                class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md" 
                required
                oninvalid="this.setCustomValidity('Vehicle type is required')"
                oninput="this.setCustomValidity('')"
            >
        </div>
        <div>
            <label class="block mb-1 font-semibold">Usage</label>
            <input 
                type="text" 
                name="usage" 
                value="{{ old('usage') }}"
                placeholder="Personal"  
                maxlength="30" 
                class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md" 
                required
                oninvalid="this.setCustomValidity('Usage is required')"
                oninput="this.setCustomValidity('')"
            >
        </div>
        <div>
            <label class="block mb-1 font-semibold">Make</label>
            <input 
                type="text" 
                name="make" 
                placeholder="Toyota" 
                maxlength="30" 
                value="{{ old('make') }}"
                class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md" 
                required
                oninvalid="this.setCustomValidity('Make is required')"
                oninput="this.setCustomValidity('')"
            >
        </div>
        <div>
            <label class="block mb-1 font-semibold">Model</label>
            <input 
                type="text" 
                name="model" 
                placeholder="Camry" 
                maxlength="30"  
                value="{{ old('model') }}"
                class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md" 
                required
                oninvalid="this.setCustomValidity('Model is required')"
                oninput="this.setCustomValidity('')"
            >
        </div>
        <div>
            <label class="block mb-1 font-semibold">Body Class</label>
            <input 
                type="text" 
                name="body_class" 
                placeholder="Sedan" 
                maxlength="30" 
                value="{{ old('body_class') }}"
                class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md" 
                required
                oninvalid="this.setCustomValidity('Body class is required')"
                oninput="this.setCustomValidity('')"
            >
        </div>
    </div>

   <!-- DL License -->
<div>
    <label for="license-personal" class="block mb-1 font-semibold">DL License (Upload file)</label>
    <input 
        type="file" 
        id="license-personal" 
        name="license-personal[]" 
        accept=".jpeg,.jpg,.png,.pdf"
        class="block w-full text-gray-300 mt-2"
        required 
        multiple
    >
    <small class="text-gray-400">Allowed formats: JPG, PNG, PDF. Max 6 files, 5MB each.</small>
     @error('licenses')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
    @error('licenses.*')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>



    <!-- Observations -->
    <div>
        <label class="block mb-1 font-semibold">Observations</label>
        <textarea 
            rows="4" 
            name="observations" 
            value="{{ old('observations') }}"
            maxlength="500" 
            class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md"
        ></textarea>
    </div>

    <!-- Button -->
    <button 
        type="submit" 
        class="w-full py-3 bg-blue-600 hover:bg-blue-700 transition-colors text-white font-semibold rounded-md"
    >
        Request a Quote
    </button>
</form>

    

<script>
    //intercambiar vista de formularios
  function mostrarFormulario(tipo) {
    const comercial = document.getElementById('form-comercial');
    const personal = document.getElementById('form-personal');

    if (tipo === 'comercial') {
      comercial.classList.remove('hidden');
      personal.classList.add('hidden');
    } else if (tipo === 'personal') {
      personal.classList.remove('hidden');
      comercial.classList.add('hidden');
    }
  }

  // Mostrar comercial al cargar
  document.addEventListener('DOMContentLoaded', () => {
    mostrarFormulario('comercial');
  });
</script>


<!-- Script para manejar el spinner  -->
<!-- Script para manejar un spinner compartido entre dos formularios -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const forms = [
        document.getElementById('form-comercial'),
        document.getElementById('form-personal')
    ];

    const loader = document.getElementById('loader'); // spinner compartido

    forms.forEach(form => {
        if (form) {
            const submitButton = form.querySelector('button[type="submit"]');
            
            form.addEventListener('submit', () => {
                loader.classList.remove('hidden'); // muestra el spinner
                submitButton.disabled = true;      // desactiva el botón
                submitButton.classList.add('opacity-50', 'cursor-not-allowed');
            });
        }
    });
});
</script>


@endsection
