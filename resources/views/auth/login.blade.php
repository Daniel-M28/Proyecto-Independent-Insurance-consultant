@extends('layouts.app')

@if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif

@section('content')
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-zinc-900">

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
            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-white">Password</label>
                <input id="password" class="w-full p-3 bg-zinc-800 border border-gray-600 rounded-md placeholder-gray-400" type="password" name="password" placeholder="password" required autocomplete="current-password">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

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
