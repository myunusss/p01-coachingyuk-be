
@slot('header')
@component('mail::header', ['url' => config('app.url')])
<img src="http://coachingyuk.com/favicon.ico" alt="Coachingyuk"/>
@endcomponent
@endslot

@component('mail::message')
# Account Created

Dear {{ $user->first_name }},<br>
Thank you for registering for Coachingyuk, a coaching platform to accelerate your growth in career, business, and life. Please find below your registration information:<br>
<br>
Username: {{ $user->username }}<br>
<br>
Click on the button below to go to your account. If you have any questions, please feel free to contact support@coachingyuk.com.

@component('mail::button', ['url' => $url, 'color' => 'primary'])
Verify Account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
