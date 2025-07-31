<section>
    <header>
        <h2 class="text-lg font-medium text-white">
            <?php echo e(__('Update Password')); ?>

        </h2>

        <p class="mt-1 text-sm text-gray-300">
            <?php echo e(__('Ensure your account is using a long, random password to stay secure.')); ?>

        </p>
    </header>

    <form
        method="post"
        action="<?php echo e(route('password.update')); ?>"
        class="mt-6 space-y-6"
        x-data="passwordForm()"
        @submit.prevent="submit"
    >
        <?php echo csrf_field(); ?>
        <?php echo method_field('put'); ?>

        <!-- Current Password -->
        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-white">
                <?php echo e(__('Current Password')); ?>

            </label>
            <input
                id="update_password_current_password"
                name="current_password"
                type="password"
                autocomplete="current-password"
                class="mt-1 block w-full bg-zinc-800 border border-gray-600 text-white rounded-md shadow-sm focus:ring-indigo-500"
                x-model="form.current_password"
            />
            <template x-if="errors.current_password">
                <p class="mt-2 text-sm text-red-500" x-text="errors.current_password[0]"></p>
            </template>
        </div>

        <!-- New Password -->
        <div>
            <label for="update_password_password" class="block text-sm font-medium text-white">
                <?php echo e(__('New Password')); ?>

            </label>
            <input
                id="update_password_password"
                name="password"
                type="password"
                autocomplete="new-password"
                class="mt-1 block w-full bg-zinc-800 border border-gray-600 text-white rounded-md shadow-sm focus:ring-indigo-500"
                x-model="form.password"
            />
            <template x-if="errors.password">
                <p class="mt-2 text-sm text-red-500" x-text="errors.password[0]"></p>
            </template>
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-white">
                <?php echo e(__('Confirm Password')); ?>

            </label>
            <input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                class="mt-1 block w-full bg-zinc-800 border border-gray-600 text-white rounded-md shadow-sm focus:ring-indigo-500"
                x-model="form.password_confirmation"
            />
            <template x-if="errors.password_confirmation">
                <p class="mt-2 text-sm text-red-500" x-text="errors.password_confirmation[0]"></p>
            </template>
        </div>

        <!-- Botón + Mensaje -->
        <div class="flex items-center gap-4">
            <button
                type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-indigo-300"
            >
                <?php echo e(__('Save')); ?>

            </button>

            <p x-show="success" x-transition class="text-sm text-green-400">Saved.</p>
        </div>
    </form>
</section>

<!-- Alpine.js Script -->
<script>
    function passwordForm() {
        return {
            success: false,
            form: {
                current_password: '',
                password: '',
                password_confirmation: '',
            },
            errors: {},
            async submit() {
                this.success = false;
                this.errors = {};

                try {
                    const response = await fetch('<?php echo e(route('password.update')); ?>', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            _method: 'PUT',
                            ...this.form
                        }),
                    });

                    if (response.ok) {
                        this.success = true;
                        this.form.current_password = '';
                        this.form.password = '';
                        this.form.password_confirmation = '';
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
<?php /**PATH C:\xampp\htdocs\proyecto_iic\resources\views/profile/partials/update-password-form.blade.php ENDPATH**/ ?>