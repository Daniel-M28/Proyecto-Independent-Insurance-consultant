@extends('layouts.app')

@if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif

  

@section('content')



<div class="min-h-screen flex flex-col sm:justify-center items-center pt-20 sm:pt-0 bg-zinc-900 ">
@if(session('success'))
                <div class="mt-24 mb-4 p-3 bg-green-600 text-white rounded">
                    {{ session('success') }}
                </div>
            @endif
            
    <h1 class="text-white text-4xl mb-6">Login</h1>

    {{-- Session Status --}}
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <div class="w-full sm:max-w-md px-6 py-4 bg-[#121212] shadow-md overflow-hidden sm:rounded-lg">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email Address --}}
            <div>
                <label for="email" class="block text-sm font-medium text-white">Email</label>
                <input id="email" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" type="email" name="email" value="{{ old('email') }}" placeholder="email@example.com" required autofocus autocomplete="username">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
<div class="mt-4 relative">
  <label for="password" class="block text-sm font-medium text-white">Password</label>

  <input 
    id="password" 
    class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400 pr-10" 
    type="password" 
    name="password" 
    placeholder="password" 
    required 
    autocomplete="current-password">

  <!-- Botón ojito -->
  <button 
    type="button" 
    title="Show password"
    onclick="togglePassword('password', this)" 
    class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-200">
    <!-- Ícono de ojo -->
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
      <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.008 9.963 7.178.07.21.07.432 0 .643C20.573 16.49 16.638 19.5 12 19.5c-4.639 0-8.577-3.008-9.964-7.178z" />
      <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
    </svg>
  </button>

  @error('password')
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
  @enderror
</div>

<!-- Script reutilizable -->
<script>
  function togglePassword(id, btn) {
    const input = document.getElementById(id);
    const isPassword = input.type === "password";
    input.type = isPassword ? "text" : "password";
    btn.title = isPassword ? "Hide password" : "Show password";
    btn.querySelector("svg").classList.toggle("opacity-50");
  }
</script>


            {{-- Remember Me --}}
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-2 text-sm text-white">Remember me</span>
                </label>
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="text-sm text-white underline hover:text-gray-300" href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                @endif

                <button type="submit" class="ml-3 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Log in
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
