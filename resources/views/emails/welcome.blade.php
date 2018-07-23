@component('mail::message')

    Дорогий {{ $name }},

    Дякуємо за реєстрацію.

    Пройдіть за посиланням для підтвердження та активації вашого аккаунту:

    @component('mail::button', ['url' => url('/verifyemail/' .$email_token)])
        Підтвердити
    @endcomponent


    {{ config('app.name') }}

@endcomponent