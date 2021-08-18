@component('mail::message')
{{ __('Hello!') }}

{{ __('Your password was recently changed. If you did not make this change yourself, please report this incident immediately to your administrator.') }}

{{ __('If you intentionally reset your password, please ignore this notification.') }}

{{ __('Thank you!') }}
{{ config('app.name') }}
@endcomponent