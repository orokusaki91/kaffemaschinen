<h1>Hallo</h1>

<p>
    Bitte klicken Sie den folgenden Link an, um Ihr Passwort zurück zu setzen,
    <a href="{{ env('APP_URL') }}/reset/{{ $user->email }}/{{ $code }}">hier klicken!</a>
</p>
