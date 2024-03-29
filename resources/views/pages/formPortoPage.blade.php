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
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/rk4bir/simple-tags-input@latest/src/simple-tag-input.min.css">

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
        
        @include('component.formPorto', ['data' => $porto ?? null])
        <input type="text" hidden value="{{$tags ?? ''}}" id="tags-master">
      </div>
       <!-- Include the Quill library -->
      <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
      <script src="https://cdn.jsdelivr.net/gh/rk4bir/simple-tags-input@latest/src/simple-tag-input.min.js"></script>

      <script>
        const tagsMaster = document.getElementById('tags-master').value;
        const tagsPorto = document.getElementById('check-tag').value;
        console.log(JSON.parse(tagsMaster))
        /* JavaScript code */
        let options = {
            inputEl: "tags", 
            listEl: "tag-list",
            autocompleteSearchList: JSON.parse(tagsMaster)
        };
        var tagsInput = new simpleTagsInput(options);
        if((typeof tagsPorto !== 'undefined') && (typeof tagsPorto != null)){
            tagsPorto.split(',').forEach(el => {
                tagsInput.addTag(el);
            });
        }
        
      </script>

      <script src="{{Vite::asset('resources/js/nav.js')}}"></script>
      <script src="{{Vite::asset('resources/js/editor.js')}}"></script>
    </body>
</html>
