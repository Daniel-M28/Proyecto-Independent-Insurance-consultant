
<x-guest-layout>
    
<div class="mb-4 text-sm text-white">
        {{ __('Reset your password. Please ensure your new password is strong and secure.') }}
    </div>
    
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label class="text-white" for="email" :value="__('Email')" />
            <x-text-input id="email" class="w-full p-3 bg-zinc-700 border border-gray-600 rounded-md placeholder-gray-400 pr-10 text-white" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" readonly />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
<div class="mt-4 relative">
    <x-input-label class="text-white" for="password" :value="__('Password')" />
    <div class="relative">
        <x-text-input id="password"
                      class="w-full p-3 bg-zinc-700 border border-gray-600 rounded-md placeholder-gray-400 pr-10 text-white"
                      type="password"
                      name="password"
                      required autocomplete="new-password" />
        <button type="button"
                id="togglePassword"
                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-200"
                title="Show/Hide password">
            <!-- Ícono de ojo -->
            <svg xmlns="http://www.w3.org/2000/svg" 
                 fill="none" viewBox="0 0 24 24" 
                 stroke-width="1.5" stroke="currentColor" 
                 class="w-5 h-5" id="iconPassword">
                <path stroke-linecap="round" stroke-linejoin="round" 
                      d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 
                         7.36 4.5 12 4.5c4.638 0 8.573 3.007 
                         9.963 7.178.07.207.07.431 0 
                         .639C20.577 16.49 16.64 19.5 12 
                         19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                <path stroke-linecap="round" stroke-linejoin="round" 
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </button>
    </div>
    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

<!-- Confirm Password -->
<div class="mt-4 relative">
    <x-input-label class="text-white" for="password_confirmation" :value="__('Confirm Password')" />
    <div class="relative">
        <x-text-input id="password_confirmation"
                      class="w-full p-3 bg-zinc-700 border border-gray-600 rounded-md placeholder-gray-400 pr-10 text-white"
                      type="password"
                      name="password_confirmation"
                      required autocomplete="new-password" />
        <button type="button"
                id="togglePasswordConfirm"
                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-200"
                title="Show/Hide password">
            <!-- Ícono de ojo -->
            <svg xmlns="http://www.w3.org/2000/svg" 
                 fill="none" viewBox="0 0 24 24" 
                 stroke-width="1.5" stroke="currentColor" 
                 class="w-5 h-5" id="iconPasswordConfirm">
                <path stroke-linecap="round" stroke-linejoin="round" 
                      d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 
                         7.36 4.5 12 4.5c4.638 0 8.573 3.007 
                         9.963 7.178.07.207.07.431 0 
                         .639C20.577 16.49 16.64 19.5 12 
                         19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                <path stroke-linecap="round" stroke-linejoin="round" 
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </button>
    </div>
    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
</div>

<script>
    // Función para alternar el tipo de input y el ícono
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        const isPassword = input.type === 'password';
        input.type = isPassword ? 'text' : 'password';
        icon.innerHTML = isPassword
            ? `<path stroke-linecap="round" stroke-linejoin="round" 
                      d="M3.98 8.223A10.477 10.477 0 001.934 12c1.886 
                         4.073 5.823 7 10.066 7 1.735 0 
                         3.366-.416 4.786-1.144M6.228 
                         6.228A10.451 10.451 0 0112 5c4.243 0 
                         8.18 2.927 10.066 7a10.52 10.52 
                         0 01-4.293 4.5M6.228 6.228L3 
                         3m0 0l18 18M3 3l3.228 3.228" />`
            : `<path stroke-linecap="round" stroke-linejoin="round" 
                      d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 
                         7.51 7.36 4.5 12 4.5c4.638 0 
                         8.573 3.007 9.963 7.178.07.207.07.431 
                         0 .639C20.577 16.49 16.64 19.5 12 
                         19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
               <path stroke-linecap="round" stroke-linejoin="round" 
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />`;
    }

    document.getElementById('togglePassword')
        .addEventListener('click', () => togglePassword('password', 'iconPassword'));

    document.getElementById('togglePasswordConfirm')
        .addEventListener('click', () => togglePassword('password_confirmation', 'iconPasswordConfirm'));
</script>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
