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
    </head>
    <body >
      @include('component.navbar')
      @if (session('error'))
    
      @include('component.notif',['error' => session('error')])
      
      @endif
      @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      <div class="flex flex-row">

        @include('component.navside')
        
        @include('component.home.detailPorto', ['porto' => $porto ?? null])
        
      </div>
      <!-- Include the Quill library -->
      <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

      <script src="{{Vite::asset('resources/js/nav.js')}}"></script>

      <script src="{{Vite::asset('resources/js/editorView.js')}}"></script>
    </body>
</html>
