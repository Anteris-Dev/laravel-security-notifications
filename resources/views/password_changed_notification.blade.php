@component('mail::message')
Hello!

Your password was recently changed. If you did not make this change yourself, please report this incident immediately to your administrator.

If you intentionally reset your password, please ignore this notification.

Thank you!<br>
{{ config('app.name') }}
@endcomponent