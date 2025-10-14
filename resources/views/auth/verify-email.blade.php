
<x-guest-layout>
    <div class="mb-4 text-sm text-gray-100">
        {{ __('Thank you for registering! Before you begin, in order to access the panel, you must verify your email address by clicking on the link we just sent to the email address associated with your registration.
If you have not received the email, click on the resend verification email button..') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

 
</x-guest-layout>


@endsection