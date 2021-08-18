@component('mail::message')
{{ __('Hello!') }}

{{ __('Your email address was recently changed from :oldEmail to :newEmail.', [ 'oldEmail' => $oldEmail, 'newEmail' => $newEmail ] }} {{ __('If you did not make this change, or do not recognize the email address :newEmail please report this incident to your administrator immediately.', [ 'newEmail' => $newEmail ]) }}

{{ __('If you did make this change, please ignore this email.') }}

{{ __('Thank you!') }}
{{ config('app.name') }}
@endcomponent