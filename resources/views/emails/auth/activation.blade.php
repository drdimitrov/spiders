@component('mail::message')
# Activate your account

Dear colleague, thanks for signing up. Please activate your account now.

@component('mail::button', ['url' => route('auth.activate', [
	'token' => $user->activation_token,
	'email' => $user->email,
])])
Activate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
