<section>
    <header>
        <h2 class="text-lg font-medium text-white">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-300">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post"
          action="{{ route('profile.update') }}"
          class="mt-6 space-y-6"
          x-data="profileForm()"
          @submit.prevent="submit"
    >
        @csrf
        @method('patch')

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-white">{{ __('Name') }}</label>
            <input
                id="name"
                name="name"
                type="text"
                x-model="form.name"
                required
                autofocus
                autocomplete="name"
                class="mt-1 block w-full bg-zinc-800 border border-gray-600 text-white rounded-md shadow-sm focus:ring-indigo-500"
            />
            <template x-if="errors.name">
                <p class="mt-2 text-sm text-red-500" x-text="errors.name[0]"></p>
            </template>
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-white">{{ __('Email') }}</label>
            <input
                id="email"
                name="email"
                type="email"
                x-model="form.email"
                required
                autocomplete="username"
                class="mt-1 block w-full bg-zinc-800 border border-gray-600 text-white rounded-md shadow-sm focus:ring-indigo-500"
            />
            <template x-if="errors.email">
                <p class="mt-2 text-sm text-red-500" x-text="errors.email[0]"></p>
            </template>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-gray-300">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="underline text-sm text-indigo-400 hover:text-indigo-600 focus:outline-none">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Botón + Mensaje -->
        <div class="flex items-center gap-4">
            <button
                type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-indigo-300"
            >
                {{ __('Save') }}
            </button>

            <p x-show="success" x-transition class="text-sm text-green-400">Saved.</p>
        </div>
    </form>
</section>

<!-- Alpine.js Script -->
<script>
    function profileForm() {
        return {
            success: false,
            form: {
                name: @json(old('name', $user->name)),
                email: @json(old('email', $user->email)),
            },
            errors: {},
            async submit() {
                this.success = false;
                this.errors = {};

                try {
                    const response = await fetch('{{ route('profile.update') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            _method: 'PATCH',
                            ...this.form
                        }),
                    });

                    if (response.ok) {
                        this.success = true;
                        setTimeout(() => this.success = false, 3000);
                    } else if (response.status === 422) {
                        const data = await response.json();
                        this.errors = data.errors;
                    } else {
                        console.error('Unexpected error');
                    }
                } catch (error) {
                    console.error('Error al enviar:', error);
                }
            }
        }
    }
</script>
