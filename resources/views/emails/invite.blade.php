@component('mail::message')

    Доброго дня {{ $user->name }},

    Вас запрошують для реєстрації

    Пройдіть за посиланням для продовження реєстрації:

    @component('mail::button', ['url' => url('/invite/' .$user->email_token)])
        Підтвердити
    @endcomponent


    {{ config('app.name') }}

@endcomponent