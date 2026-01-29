<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>IoT Kebakaran</title>
        <style>
            body, html {
                margin: 0;
                padding: 0;
                height: 100%;
                width: 100%;
                overflow: hidden;
            }
            .full-bg {
                background-image: url("{{ asset('img/pp.jpeg') }}");
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                height: 100%;
                width: 100%;
            }
        </style>
    </head>
    <body>
        <div class="full-bg"></div>
    </body>
</html>
