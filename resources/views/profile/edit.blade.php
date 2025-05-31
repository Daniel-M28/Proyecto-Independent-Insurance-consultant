@extends('layouts.app')

@section('content')
    <div class="py-16 bg-zinc-800 text-gray-100 min-h-screen mt-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <h2 class="text-2xl font-semibold mb-4 text-white text-center sm:text-left">
                {{ __('Profile') }}
            </h2>

            <div class="p-6 bg-zinc-900 shadow sm:rounded-lg text-gray-100">
                <div class="max-w-xl mx-auto sm:mx-0">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-6 bg-zinc-900 shadow sm:rounded-lg text-gray-100">
                <div class="max-w-xl mx-auto sm:mx-0">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-6 bg-zinc-900 shadow sm:rounded-lg text-gray-100">
                <div class="max-w-xl mx-auto sm:mx-0">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection
