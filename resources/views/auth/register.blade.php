@extends('layouts.app')
@if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endif

@section('content')
<div class="min-h-screen flex flex-col md:flex-row bg-zinc-900">

  <!-- Imagen izquierda -->
  <div class="md:w-1/2 w-full flex items-center justify-center p-8">
    <img src="{{ asset('imgs/loge.png') }}" alt="Logo" class="max-h-[500px] object-contain">
  </div>

  <!-- Formulario derecha -->
  <div class="md:w-1/2 w-full flex flex-col justify-center px-8 md:px-12">
    <h1 class="text-white text-4xl mb-4 text-center">Register</h1>

    <div class="bg-zinc-800 shadow-md rounded-lg p-8">
      <form method="POST" action="{{ route('register') }}">
          @csrf

          {{-- Name y Lastname en la misma línea --}}
          <div class="flex gap-4">
            <div class="w-1/2">
                <label for="name" class="block text-sm font-medium text-white">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm text-black">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="w-1/2">
                <label for="lastname" class="block text-sm font-medium text-white">Last Name</label>
                <input id="lastname" type="text" name="lastname" value="{{ old('lastname') }}" required autocomplete="family-name" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm text-black">
                @error('lastname')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
          </div>

          {{-- Email --}}
          <div class="mt-4">
              <label for="email" class="block text-sm font-medium text-white">Email</label>
              <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm text-black">
              @error('email')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
          </div>

          {{-- Password --}}
          <div class="mt-4">
              <label for="password" class="block text-sm font-medium text-white">Password</label>
              <input id="password" type="password" name="password" required autocomplete="new-password" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm text-black">
              @error('password')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
          </div>

          {{-- Confirm Password --}}
          <div class="mt-4">
              <label for="password_confirmation" class="block text-sm font-medium text-white">Confirm Password</label>
              <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm text-black">
              @error('password_confirmation')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
          </div>

          {{-- Actions --}}
          <div class="flex items-center justify-end mt-4">
              <a href="{{ route('login') }}" class="underline text-sm text-white hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  Already registered?
              </a>

              <button type="submit" class="ml-4 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  Register
              </button>
          </div>
      </form>
    </div>
  </div>
</div>
@endsection
