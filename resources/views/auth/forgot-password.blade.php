<x-guest-layout>
    <div class="mb-4 text-sm text-white">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" id="passwordForm">
        @csrf

        <!-- Contenedor del spinner -->
        <div id="loader" class="hidden fixed inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center z-50">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
                <span class="text-white font-semibold text-lg">Submitting request...</span>
            </div>
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label class="text-white" for="email" :value="__('Email')" />
            <x-text-input id="email" class="w-full p-3 bg-zinc-700 border border-gray-600 rounded-md placeholder-gray-400 pr-10 text-white" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Script para manejar el spinner -->
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('passwordForm');
        const loader = document.getElementById('loader');
        const submitButton = form.querySelector('button[type="submit"]');

        form.addEventListener('submit', () => {
            loader.classList.remove('hidden'); // mostrar spinner
            submitButton.disabled = true;      // desactivar botón
            submitButton.classList.add('opacity-50', 'cursor-not-allowed');
        });
    });
    </script>
</x-guest-layout>
