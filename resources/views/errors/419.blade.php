@extends('layouts.app')

@section('title', 'Error 419')

@section('content')
<div class="flex flex-col items-center justify-center min-h-[70vh] text-center">
    <img src="{{ asset('imgs/error.png') }}" alt="Error 419" class="w-48 md:w-64 mb-6 mt-24">

    <h1 class="text-4xl font-bold mb-3 text-gray-100">Sesión expirada</h1>

    <p class="text-gray-400 mb-8 max-w-md">
        Tu sesión ha expirado por inactividad o por motivos de seguridad.  
        Por favor, actualiza la página o inicia sesión nuevamente.
    </p>

    <a href="{{ route('login') }}" class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors">
        Iniciar sesión
    </a>
</div>
@endsection
