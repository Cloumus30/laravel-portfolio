<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cloudias</title>

        <!-- Fonts -->

        <!-- Styles -->
        @vite('resources/css/app.css')
    </head>
    <body class="flex flex-row">
       <nav class="w-3/12 bg-rose-500 text-white h-screen"> 

         @include('component.navside')
         
       </nav>
       <main class="w-10/12 text-white bg-[#060047] max-h-screen">
        Body Main
       </main>
    </body>
</html>
