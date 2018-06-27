@component('mail::message')
# Hello {{ $user->name }}

You changed your email, so we need to verify this new email address. Please use the button bellow: 

@component('mail::button', ['url' => route('users.verify', $user->verification_token)])
Verify Account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
