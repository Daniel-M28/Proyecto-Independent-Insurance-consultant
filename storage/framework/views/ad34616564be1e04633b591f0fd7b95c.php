<section>
    <header>
        <h2 class="text-lg font-medium text-white">
            <?php echo e(__('Profile Information')); ?>

        </h2>

        <p class="mt-1 text-sm text-gray-300">
            <?php echo e(__("Update your account's profile information and email address.")); ?>

        </p>
    </header>

    <form id="send-verification" method="post" action="<?php echo e(route('verification.send')); ?>">
        <?php echo csrf_field(); ?>
    </form>

    <form method="post"
          action="<?php echo e(route('profile.update')); ?>"
          class="mt-6 space-y-6"
          x-data="profileForm()"
          @submit.prevent="submit"
    >
        <?php echo csrf_field(); ?>
        <?php echo method_field('patch'); ?>

       <!-- Name -->
<div>
    <label for="name" class="block text-sm font-medium text-white"><?php echo e(__('Name')); ?></label>
    <input
        id="name"
        name="name"
        type="text"
        x-model="form.name"
        required
        autofocus
        autocomplete="name"
        class="mt-1 block w-full bg-zinc-800  text-white rounded-md shadow-sm rounded-md 
               focus:outline-none focus:ring-0 "
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('edit-name')): ?> readonly <?php endif; ?>
    />
    <template x-if="errors.name">
        <p class="mt-2 text-sm text-red-500" x-text="errors.name[0]"></p>
    </template>
</div>

<!-- Last Name -->
<div>
    <label for="lastname" class="block text-sm font-medium text-white"><?php echo e(__('Last Name')); ?></label>
    <input
        id="lastname"
        name="lastname"
        type="text"
        x-model="form.lastname"
        required
        autocomplete="family-name"
        class="mt-1 block w-full bg-zinc-800  text-white rounded-md 
               focus:outline-none focus:ring-0 "
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('edit-name')): ?> readonly <?php endif; ?>
    />
    <template x-if="errors.lastname">
        <p class="mt-2 text-sm text-red-500" x-text="errors.lastname[0]"></p>
    </template>
</div>

<!-- Email -->
<div>
    <label for="email" class="block text-sm font-medium text-white"><?php echo e(__('Email')); ?></label>
    <input
        id="email"
        name="email"
        type="email"
        x-model="form.email"
        required
        autocomplete="username"
        class="mt-1 block w-full bg-zinc-800 border border-gray-600 text-white rounded-md shadow-sm "
    />
    <template x-if="errors.email">
        <p class="mt-2 text-sm text-red-500" x-text="errors.email[0]"></p>
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
    function profileForm() {
        return {
            success: false,
            form: {
                name: <?php echo json_encode(old('name', $user->name), 512) ?>,
                lastname: <?php echo json_encode(old('lastname', $user->lastname), 512) ?>,
                email: <?php echo json_encode(old('email', $user->email), 512) ?>,
            },
            errors: {},
            async submit() {
                this.success = false;
                this.errors = {};

                try {
                    const response = await fetch('<?php echo e(route('profile.update')); ?>', {
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
<?php /**PATH C:\xampp\htdocs\proyecto_iic\resources\views/profile/partials/update-profile-information-form.blade.php ENDPATH**/ ?>