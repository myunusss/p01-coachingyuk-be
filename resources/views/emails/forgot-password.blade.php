
@slot('header')
@component('mail::header', ['url' => config('app.url')])
<img src="http://coachingyuk.com/favicon.ico" alt="Coachingyuk"/>
@endcomponent
@endslot

@component('mail::message')
# Reset Password Request

Dear {{ $user->first_name }},<br>
We've received a request to reset your password. If you didn't make the request, just ignore this email. Otherwise you can reset your password using this link:<br>


@component('mail::button', ['url' => $url, 'color' => 'primary'])
Reset Password
@endcomponent

If you have any questions, please feel free to contact support@coachingyuk.com.<br>
<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
