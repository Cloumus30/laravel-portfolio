<main class="w-full md:w-10/12 text-white bg-[#060047] max-h-screen overflow-auto">
    <div class="p-8">
        <div>
            <a href="{{$porto['link'] ?? null}}" target="__blank" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 mx-2">
                Kunjungi
            </a>
        </div>
        <div class="text-center text-5xl">
            <h1 class="">{{$porto['title'] ?? null}}</h1>
        </div>
        <div class="flex my-5">
            <img class="w-1/3 mx-auto" src="{{ ($porto['img_url']) ? $porto['img_url'] : Vite::asset('resources/images/dias_coding.png') }}" alt="image">
        </div>
        <div class="text-lg ml-4">
            {{$porto['short_desc'] ?? null}}
        </div>
        <br>
        <div id="editor-view">
            {!! $porto['description'] ?? null !!}
        </div>
    </div>
</main>