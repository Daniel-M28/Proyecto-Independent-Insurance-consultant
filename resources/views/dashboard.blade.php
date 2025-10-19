@extends('layouts.app')

@section('content')

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
                setTimeout(() => alertBox.remove(), 400); // elimina después del fade
            }
        }, 3000); 
    </script>
@endif



   <div class="py-12 mt-16">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-6 text-white text-center">
            <h1 class="text-3xl font-bold">
                {{ __('Welcome :name', ['name' => Auth::user()->name]) }}
            </h1>
            <p class="text-lg mt-2 text-gray-300">
                What would you like to do today?
            </p>

  <div 
  class="@can('admin.users.index') 
            mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 max-w-6xl mx-auto 
         @else 
            mt-8 flex flex-col sm:flex-row justify-center items-center gap-6 flex-wrap 
         @endcan">

    {{-- Solo visible para admin --}}
    @can('admin.users.index')
    <a href="{{ route('admin.users.index') }}"
       class="w-full sm:w-64 h-16 flex items-center justify-center bg-blue-600 hover:bg-blue-700 
              text-white text-lg font-semibold text-center rounded-lg shadow-lg transition">
        Users
    </a>
    @endcan

    {{-- Botón visible para todos --}}
    <a href="{{ route('certificados.index') }}"
       class="w-full sm:w-64 h-16 flex items-center justify-center bg-blue-600 hover:bg-blue-700 
              text-white text-lg font-semibold text-center rounded-lg shadow-lg transition">
        Generate COI
    </a>

    {{-- Diferente color según rol --}}
    @if(auth()->user()->hasRole('administrador'))
        <a href="{{ route('policies.index') }}"
           class="w-full sm:w-64 h-16 flex items-center justify-center bg-blue-600 hover:bg-blue-700 
                  text-white text-lg font-semibold text-center rounded-lg shadow-lg transition">
            View my policy
        </a>
    @else
        <a href="{{ route('policies.index') }}"
           class="w-full sm:w-64 h-16 flex items-center justify-center bg-green-600 hover:bg-green-700 
                  text-white text-lg font-semibold text-center rounded-lg shadow-lg transition">
            View my policy
        </a>
    @endif

    {{-- Botones visibles para admin y asesor --}}
    @if(auth()->user()->hasRole('administrador') || auth()->user()->hasRole('asesor'))

        <a href="{{ route('admin.commercial.index') }}"
           class="w-full sm:w-64 h-16 flex items-center justify-center bg-blue-600 hover:bg-blue-700 
                  text-white text-lg font-semibold text-center rounded-lg shadow-lg transition">
            Commercial quotes
        </a>

        <a href="{{ route('admin.regulatorios') }}"
           class="w-full sm:w-64 h-16 flex items-center justify-center bg-green-600 hover:bg-green-700 
                  text-white text-lg font-semibold text-center rounded-lg shadow-lg transition">
           Regulatory
        </a>

        <a href="{{ route('admin.factoring') }}"
           class="w-full sm:w-64 h-16 flex items-center justify-center bg-green-600 hover:bg-green-700 
                  text-white text-lg font-semibold text-center rounded-lg shadow-lg transition">
            Factoring
        </a>

        <a href="{{ route('admin.new-company.index') }}"
           class="w-full sm:w-64 h-16 flex items-center justify-center bg-green-600 hover:bg-green-700 
                  text-white text-lg font-semibold text-center rounded-lg shadow-lg transition">
            New companies
        </a>

        <a href="{{ route('admin.personal-quotes.index') }}"
           class="w-full sm:w-64 h-16 flex items-center justify-center bg-green-600 hover:bg-green-700 
                  text-white text-lg font-semibold text-center rounded-lg shadow-lg transition">
            Personal quotes
        </a>

    @endif

</div>

    </div>
</div>


@endsection
