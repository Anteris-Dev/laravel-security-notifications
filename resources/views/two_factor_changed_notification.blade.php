@component('mail::message')
Hello!

Your two factor secret key was recently modified. If this was not you, please report this incident immediately to your administrator.

If you intentionally reset your two factor key, please ignore this notification.

Thank you!<br>
{{ config('app.name') }}
@endcomponent