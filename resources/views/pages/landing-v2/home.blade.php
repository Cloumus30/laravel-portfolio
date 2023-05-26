<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cloudias</title>

        <!-- Fonts -->

        <!-- Styles -->
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')

    </head>
    <body class="bg-[#EEEEEE]" >
        @include('component.landing-v2.navbar')
        @if (session('error'))

            @include('component.notif',['error' => session('error')])
        
        @endif

        <main class="mt-40 w-full">
            <div class="pb-16">
                @include('component.landing-v2.section1')
            </div>

            <div class="mt-5">
                @include('component.landing-v2.section2')
            </div>

            <div class="mt-5">
                @include('component.landing-v2.section3')
            </div>
        </main>
        
        
        @vite('resources/js/nav.js')
        <script src="https://cdn.jsdelivr.net/npm/simple-parallax-js@5.5.1/dist/simpleParallax.min.js"></script>

        <script>
            const images = document.getElementsByClassName('images');
            new simpleParallax(images)
        </script>
    </body>
</html>
