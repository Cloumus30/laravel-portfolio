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
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <link rel="stylesheet" href="//cdn.quilljs.com/1.3.6/quill.bubble.css">

        <style>
            .ql-editor{
                font-size: 1.3em;
            }
        </style>
    </head>
    <body class="bg-[#EEEEEE]" >
        @include('component.landing-v2.navbar')
        @if (session('error'))

            @include('component.notif',['error' => session('error')])
        
        @endif

        <main class="mt-40 w-3/4 mx-auto pb-14">
            <div class="flex flex-col mx-auto justify-center">
                <div>
                    <a href="{{$porto['link'] ?? null}}" target="__blank" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 mx-2">
                        Kunjungi
                    </a>
                </div>
                <div class="text-center text-4xl mt-4 md:mt-0 md:text-5xl">
                    <h1 class=""> {{$porto['title'] ?? null}} </h1>
                </div>
                <div class="flex my-5">
                    <img class="w-1/3 mx-auto" src="{{ ($porto['img_url']) ? $porto['img_url'] : Vite::asset('resources/images/dias_coding.png') }}" alt="image">
                </div>
                <div class="text-xl md:text-2xl ml-4 ">
                    {{$porto['short_desc'] ?? null}}
                </div>
                <br>
                <div id="editor-view" class="text-xl">
                    {!! $porto['description'] ?? null !!}
                </div>
            </div>
            
        </main>
        
        <!-- Include the Quill library -->
      <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

        @vite('resources/js/nav.js')
        @vite('resources/js/editorView.js')
        <script src="https://cdn.jsdelivr.net/npm/simple-parallax-js@5.5.1/dist/simpleParallax.min.js"></script>

        <script>
            const images = document.getElementsByClassName('images');
            new simpleParallax(images)
        </script>
    </body>
</html>
