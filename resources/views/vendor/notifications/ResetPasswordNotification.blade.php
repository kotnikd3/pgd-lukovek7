@component('mail::message')
# Pozdravljeni!

To e-pošto ste prejeli, ker želite ponastaviti svoje geslo na spletni strani PGDLukovek.
<br>
Kliknite spodnji gumb za ponastavitev gesla.

@component('mail::button', ['url' => $actionUrl])
Ponastavi geslo
@endcomponent

Z lepimi pozdravi,<br>
{{ config('app.name') }}

{{-- Subcopy --}}
@isset($actionText)
@component('mail::subcopy')
@lang(
    "Če imate težavo s klikom na gumb 'Ponastavi geslo', kopirajte spodnjo povezavo v brskalnik: [:actionURL](:actionURL)",
    [
        'actionURL' => $actionUrl,
    ]
)
@endcomponent
@endisset

@endcomponent
