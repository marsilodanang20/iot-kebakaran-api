<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>REST API IoT Kebakaran</title>
        
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;800&display=swap" rel="stylesheet">

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
                display: flex;
                justify-content: center;
                align-items: center;
                position: relative;
            }
            .full-bg::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.4); /* Dark overlay for readability */
                z-index: 1;
            }
            .centered-text {
                position: relative;
                z-index: 2;
                color: #ffffff;
                font-family: 'Outfit', sans-serif;
                font-size: clamp(1.5rem, 5vw, 4rem);
                text-align: center;
                text-shadow: 0 4px 10px rgba(0,0,0,0.5);
                font-weight: 800;
                padding: 0 20px;
                line-height: 1.2;
                opacity: 0;
                animation: fadeInUp 1s ease-out forwards;
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
    </head>
    <body>
        <div class="full-bg">
            <h1 class="centered-text">abis sidang bisa tidur nyenyak boy😴😴😴</h1>
        </div>
    </body>
</html>
