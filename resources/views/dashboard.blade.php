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

            <div class="mt-8 flex flex-col sm:flex-row justify-center items-center gap-4">
                <a href="{{ route('certificados.index') }}"
                   class="px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white text-lg font-semibold rounded-lg shadow-lg transition-colors">
                    Generate COI
                </a>

                <a href="#"
                   class="px-8 py-4 bg-green-600 hover:bg-green-700 text-white text-lg font-semibold rounded-lg shadow-lg transition-colors">
                    View My Policy
                </a>

                 @can('admin.users.index')
                 <a href="{{ route('admin.users.index') }}"
                    class="px-8 py-4 bg-blue-600 hover:bg-green-700 text-white text-lg font-semibold rounded-lg shadow-lg transition-colors">
                     Users
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>


@endsection
