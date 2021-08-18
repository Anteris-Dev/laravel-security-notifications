@component('mail::message')
{{ __('Hello!') }}

{{ __('Your two factor key was recently modified. If this was not you, please report this incident immediately to your administrator.') }}

{{ __('If you intentionally reset your two factor token, please ignore this notification.') }}

{{ __('Thank you!') }}
{{ config('app.name') }}
@endcomponent