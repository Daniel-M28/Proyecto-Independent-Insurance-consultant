<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-white">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-300">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <!-- Botón que abre el modal -->
    <button
        id="open-delete-modal"
        class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
        type="button"
    >
        {{ __('Delete Account') }}
    </button>

    <!-- Modal oculto por defecto -->
    <div
        id="delete-account-modal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50"
    >
        <div class="bg-gray-900 rounded-lg shadow-lg max-w-lg w-full p-6">
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-white">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-300">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <div class="mt-6">
                    <label for="password" class="sr-only">{{ __('Password') }}</label>
                    <input
                        id="password"
                        name="password"
                        lastname="password"
                        type="password"
                        placeholder="{{ __('Password') }}"
                        class="w-3/4 mt-1 bg-gray-800 text-white rounded-md shadow-sm focus:ring focus:ring-red-500"
                        required
                    />
                    @if ($errors->userDeletion->has('password'))
                        <p class="mt-2 text-sm text-red-500">{{ $errors->userDeletion->first('password') }}</p>
                    @endif
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button
                        type="button"
                        id="cancel-delete-modal"
                        class="bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded"
                    >
                        {{ __('Cancel') }}
                    </button>

                    <button
                        type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                    >
                        {{ __('Delete Account') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script para abrir/cerrar modal -->
    <script>
        document.getElementById('open-delete-modal').addEventListener('click', function () {
            document.getElementById('delete-account-modal').classList.remove('hidden');
        });

        document.getElementById('cancel-delete-modal').addEventListener('click', function () {
            document.getElementById('delete-account-modal').classList.add('hidden');
        });

        // También cierra el modal al hacer click fuera del contenido
        document.getElementById('delete-account-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        @if ($errors->userDeletion->any())
            document.getElementById('delete-account-modal').classList.remove('hidden');
        @endif
    });
</script>

</section>
