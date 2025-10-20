@component('mail::message')
# Hello {{ $name }},

Thank you for registering with **Independent Insurance Consultant**.

To complete your registration, please confirm your account by clicking the button below:

@component('mail::button', ['url' => $url])
Confirm your account
@endcomponent

If you didn't register, you can ignore this email.

Thanks,<br>
Independent Insurance Consultant
@endcomponent
