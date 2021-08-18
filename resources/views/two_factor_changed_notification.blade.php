@component('mail::message')
Hello!

Your two factor key was recently modified. If this was not you, please report this incident immediately to your administrator.

If you intentionally reset your two factor token, please ignore this notification.

Thank you!
{{ config('app.name') }}
@endcomponent