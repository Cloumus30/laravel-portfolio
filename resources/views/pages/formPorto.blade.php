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
    <body >
      @include('component.navbar')
      <div class="flex flex-row">

        @include('component.navside')
        
        
        
      </div>
       
      <script src="{{Vite::asset('resources/js/nav.js')}}"></script>
    </body>
</html>
