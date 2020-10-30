@component('mail::message')
# Account Created

Hi {{ $user->first_name }}
Your account has successfully been created!

@component('mail::button', ['url' => $url, 'color' => 'primary'])
Verify Account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
