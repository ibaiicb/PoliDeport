<!doctype html>
<html lang="en-es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
        <title>{{ __('Credentials for User') }}{{ $user->name }}</title>
    </head>
    <body>
        <p>{{ __('Thats the crendentials for the user') }}: {{ $user->name }}</p>
        <ul>
            <li>{{ __('Email') }}: {{ $user->email }}</li>
            <li>{{ __('Password') }}: {{ $password }}</li>
        </ul>
        <p>{{ __('Please, change your password as soon as possible') }}:</p>
        <a href="{{ route('login') }}">{{ __('Change your password here') }}</a>
    </body>
</html>
