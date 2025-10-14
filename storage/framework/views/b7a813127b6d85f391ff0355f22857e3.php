<?php $__env->startComponent('mail::message'); ?>
# Hello <?php echo e($name); ?>,

Thank you for registering with **Independent Insurance Consultant**.

To complete your registration, please confirm your account by clicking the button below:

<?php $__env->startComponent('mail::button', ['url' => $url]); ?>
Confirm your account
<?php echo $__env->renderComponent(); ?>

If you didn’t register, you can ignore this email.

Thanks,<br>
Independent Insurance Consultant
<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\xampp\htdocs\proyecto_iic\resources\views/emails/verify-temp-user.blade.php ENDPATH**/ ?>