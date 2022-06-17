<!doctype html>
<html lang="en-es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
        <title>{{ __('Verify email') }}</title>
    </head>
    <body>
        <p>{{ __('Verify the email by this link') }}:</p>
        <p>
            <a href="{{ route('change.verify.email') }}">{{ __('Verify email') }}</a>
        </p>
    </body>
</html>
