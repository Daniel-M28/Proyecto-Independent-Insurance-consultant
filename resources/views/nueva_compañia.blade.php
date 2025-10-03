@extends('layouts.app')

@if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endif

@section('content')

<div class="bg-[#1e1e2f] text-gray-200 font-sans mt-16">
    <div class="flex flex-col lg:flex-row max-w-7xl mx-auto min-h-screen">

        <!-- Sección de información -->
        <div class="w-full lg:w-1/2 p-8 lg:p-16 bg-zinc-800">
            <h1 class="text-4xl font-bold mb-6">Creación de nueva compañía</h1>
            <p class="text-lg leading-relaxed">
                Proporciona la siguiente información para crear tu nueva compañía. Completa cada campo con los datos solicitados. Nos pondremos en contacto contigo lo antes posible.
            </p>
            <img src="{{ asset('imgs/blog-2.jpeg') }}" alt="Cotización" class="mt-8 w-full max-w-md mx-auto lg:mx-0 h-auto rounded-lg shadow-md">
        </div>

        <!-- Formulario -->
        <div class="w-full lg:w-1/2 bg-[#121212] p-8 lg:p-16">

            <!-- Mensajes de éxito y error -->
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

            <form action="{{ route('admin.new-company.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 text-white">
                @csrf

                <!-- Company Name (3 options) -->
                <div>
                    <label class="block mb-1 font-semibold">Company Name</label>
                    <div class="flex flex-col md:flex-row gap-4">
                        <input type="text" name="company_name_1" placeholder="Option 1" required maxlength="60" value="{{ old('company_name_1') }}"
                               class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
                        <input type="text" name="company_name_2" placeholder="Option 2" required maxlength="60" value="{{ old('company_name_2') }}"
                               class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
                        <input type="text" name="company_name_3" placeholder="Option 3" required maxlength="60" value="{{ old('company_name_3') }}"
                               class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
                    </div>
                </div>

                <!-- Owner Name -->
                <div>
                    <label class="block mb-1 font-semibold">Owner</label>
                    <div class="flex flex-col md:flex-row gap-4">
                        <input type="text" name="owner_first_name" placeholder="First Name" value="{{ old('owner_first_name') }}" required maxlength="50"
                               class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
                        <input type="text" name="owner_last_name" placeholder="Last Name" value="{{ old('owner_last_name') }}" required maxlength="50"
                               class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
                    </div>
                </div>

                <!-- SSN -->
                <div>
                    <label class="block mb-1 font-semibold">SSN</label>
                    <input type="text" name="ssn" placeholder="Example: 123-45-6789" value="{{ old('ssn')}}" required maxlength="11"
                           class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
                </div>

                <!-- Date of Birth -->
                <div>
                    <label class="block mb-1 font-semibold">Date of Birth</label>
                    <input type="date" name="dob" value="{{ old('dob')}}" required
                           class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md text-gray-200">
                </div>

                <!-- License Upload -->
                <div class="mb-4">
                    <label for="licenses-commercial" class="block mb-1 font-semibold">
                        Owner license
                    </label>
                    <input type="file" id="licenses-commercial" name="licenses[]" multiple accept=".jpeg,.jpg,.png,.pdf"
                           class="block w-full text-gray-300 mt-2 border border-gray-600 rounded p-2">
                    <small class="text-gray-400">Allowed formats: JPG, PNG, PDF. Max 4 files, 5MB each.</small>
                    @error('licenses')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    @error('licenses.*')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block mb-1 font-semibold">Phone Number</label>
                    <input type="tel" id="phone" name="phone" placeholder="Example: (555) 123-4567" value="{{ old('phone') }}"
                           class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" required>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block mb-1 font-semibold">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email@example.com" maxlength="255" value="{{ old('email') }}"
                           class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" required>
                </div>

                <!-- Business Address -->
                <div>
                    <label for="business-address" class="block mb-1 font-semibold">Business address</label>
                    <input type="text" id="business-address" name="business_address" placeholder="1234 Elm Street" maxlength="100" value="{{ old('business_address') }}"
                           class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" required>
                </div>

                <!-- Cargo Type -->
                <div>
                    <label class="block mb-1 font-semibold">Cargo Type</label>
                    <select name="cargo_type" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md text-gray-200" required>
                        <option value="">Select an option</option>
                        <option value="dryvan" {{ old('cargo_type') == 'dryvan' ? 'selected' : '' }}>Dryvan</option>
                        <option value="reefer" {{ old('cargo_type') == 'reefer' ? 'selected' : '' }}>Reefer</option>
                        <option value="flatbed" {{ old('cargo_type') == 'flatbed' ? 'selected' : '' }}>Flatbed</option>
                        <option value="carhauler" {{ old('cargo_type') == 'carhauler' ? 'selected' : '' }}>Car Hauler</option>
                        <option value="towing" {{ old('cargo_type') == 'towing' ? 'selected' : '' }}>Towing</option>
                    </select>
                </div>

                <!-- Operation Type -->
                <div>
                    <label class="block mb-1 font-semibold">Operation Type</label>
                    <select name="operation_type" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md text-gray-200" required>
                        <option value="">Select an option</option>
                        <option value="interstate" {{ old('operation_type') == 'interstate' ? 'selected' : '' }}>Interstate</option>
                        <option value="intrastate" {{ old('operation_type') == 'intrastate' ? 'selected' : '' }}>Intrastate</option>
                    </select>
                </div>

                <!-- Vehicle Type -->
                <div>
                    <label class="block mb-1 font-semibold">Vehicle Type</label>
                    <input type="text" name="vehicle_type" placeholder="Example: Truck, Van, Car" value="{{ old('vehicle_type') }}" required
                           class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">
                </div>

                <!-- Observations -->
                <div>
                    <label class="block mb-1 font-semibold">Observations</label>
                    <textarea name="observations" rows="4" placeholder="Write your comments here..." maxlength="500"
                              class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400">{{ old('observations') }}</textarea>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 transition-colors text-white font-semibold rounded-md">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
