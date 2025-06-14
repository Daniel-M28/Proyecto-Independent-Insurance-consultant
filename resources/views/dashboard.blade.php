@extends('layouts.app')

@section('content')
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
                <a href="#"
                   class="px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white text-lg font-semibold rounded-lg shadow-lg transition-colors">
                    Generate COI
                </a>

                <a href="#"
                   class="px-8 py-4 bg-green-600 hover:bg-green-700 text-white text-lg font-semibold rounded-lg shadow-lg transition-colors">
                    View My Policy
                </a>
            </div>
        </div>
    </div>
</div>


@endsection
