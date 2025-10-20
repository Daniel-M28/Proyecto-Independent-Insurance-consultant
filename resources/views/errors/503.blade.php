@extends('layouts.app')

@section('title', 'Mantenimiento en curso')

@section('content')
<div class="flex flex-col items-center justify-center min-h-[70vh] text-center">
    <img src="{{ asset('imgs/error.png') }}" alt="Error 503" class="w-48 md:w-64 mb-6 mt-24">

    <h1 class="text-4xl font-bold mb-3 text-gray-100">Estamos en mantenimiento</h1>

    <p class="text-gray-400 mb-8 max-w-md">
        Estamos realizando mejoras en el sistema.  
        Vuelve a intentarlo en unos minutos. ¡Gracias por tu paciencia!
    </p>

    <a href="{{ url('/') }}" class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors">
        Volver al inicio
    </a>
</div>
@endsection
