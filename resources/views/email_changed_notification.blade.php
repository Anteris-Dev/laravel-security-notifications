@component('mail::message')
Hello!

Your email address was recently changed from _{{ $oldEmail }}_ to _{{ $newEmail }}_. If you did not make this change, or do not recognize the email address _{{ $newEmail }}_ please report this incident to your administrator immediately.

If you did make this change, please ignore this email.

Thank you!<br>
{{ config('app.name') }}
@endcomponent
