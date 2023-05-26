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
    <body class="bg-[#EEEEEE]" >
        @include('component.landing-v2.navbar')
        @if (session('error'))

            @include('component.notif',['error' => session('error')])
        
        @endif

        <main class="mt-40 w-3/4 mx-auto pb-14">
            <div class="flex flex-col mx-auto justify-center">
                <div>
                    <a href="" target="__blank" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 mx-2">
                        Kunjungi
                    </a>
                </div>
                <div class="text-center text-5xl">
                    <h1 class=""> Judul </h1>
                </div>
                <div class="flex my-5">
                    <img class="w-1/3 mx-auto" src="{{Vite::asset('resources/images/dias_coding.png') }}" alt="image">
                </div>
                <div class="text-lg ml-4 ">
                   Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eveniet fuga quibusdam provident, voluptatem sequi laborum nostrum eaque corporis ex facilis, quos esse enim repellendus earum pariatur magni corrupti, et quaerat?
                </div>
                <br>
                <div id="editor-view" class="">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repellat, magni perferendis quam inventore impedit iste aut illo veritatis tempora explicabo maiores culpa nisi dolorem error fugiat quaerat atque dolore saepe possimus aspernatur expedita accusantium? Voluptas, corrupti ipsum! Veritatis labore adipisci blanditiis dicta sequi magni provident reprehenderit vero non impedit earum, cumque quia, architecto dolorum minus voluptates ipsa maiores itaque obcaecati suscipit eveniet distinctio, exercitationem nemo placeat. Laboriosam libero sequi voluptatibus reprehenderit. Vero rem quisquam dolore quod rerum placeat voluptas, ipsam consectetur explicabo consequatur inventore cupiditate commodi labore aspernatur asperiores repellat, harum maxime exercitationem amet doloremque dolores eos natus libero! Aliquam ex laudantium tempora vitae facere saepe amet, id recusandae atque in nam explicabo quam harum dolore velit officia quisquam quibusdam illum pariatur accusamus repellendus ad ea. Nemo earum ipsum dolorum unde? Obcaecati dolorem consectetur sed cumque veritatis quis, omnis tempore libero. Distinctio, veritatis aliquam illo ut cumque voluptate nostrum cupiditate consectetur, amet sunt architecto iure beatae at sit, quia doloribus omnis qui quas modi quo eius! Quidem, temporibus quisquam, tenetur, animi laborum voluptates delectus impedit hic modi quasi similique nemo saepe labore esse. Unde error debitis delectus tenetur. Eligendi voluptatum quibusdam sequi repellendus nobis aliquam, minus ullam unde ex voluptatem itaque assumenda, reiciendis pariatur natus ab quam suscipit facere quos mollitia voluptatibus earum quis soluta non. Reiciendis dicta ratione quam, molestias fuga inventore autem repudiandae provident. Temporibus quidem totam autem corrupti magni saepe vero ducimus, sunt iste ea aperiam sint! Error placeat quibusdam quos voluptatibus porro eveniet, tempore earum? Ab perspiciatis, illum natus voluptate quia beatae ipsum repellendus, amet atque doloribus quis sint fuga eius culpa deleniti iusto obcaecati numquam? Labore excepturi sapiente quas sint voluptates earum voluptas aspernatur eveniet assumenda? Corporis nesciunt officia dolore doloribus est odio dolorem perspiciatis maxime, quia maiores a voluptate minima odit rem libero aperiam necessitatibus facilis corrupti, fugit eligendi, aspernatur commodi dolorum repellat. Maxime blanditiis, perferendis, velit magni architecto obcaecati repudiandae molestiae rem corrupti, aperiam eligendi! Necessitatibus recusandae animi, maiores quod at modi sequi quos illo porro provident laboriosam quis facere eaque facilis vel asperiores, repudiandae vitae nesciunt, nobis molestiae aliquam. Earum consequuntur aliquam, dicta explicabo reiciendis inventore aliquid alias facilis quisquam natus, in molestias recusandae eligendi repudiandae! Dolore ea fugit quaerat, quis ullam, obcaecati sit porro commodi modi, dicta sunt ipsa quia? Nulla, autem quo corrupti, illo id ipsum debitis praesentium amet similique quae dignissimos! Nemo cum ex pariatur maiores alias veniam expedita magni. Accusantium ipsam quibusdam saepe blanditiis modi quaerat quam, totam reprehenderit consectetur! Odio voluptates possimus officia et iure sit reprehenderit aperiam suscipit, ut laboriosam harum debitis mollitia doloribus corporis tempore minus quisquam vero enim, aut velit voluptas placeat incidunt quo asperiores? Quis molestias ab quibusdam, a sint corporis commodi quisquam provident enim tempore sed modi ex? Perspiciatis soluta quidem doloremque impedit consequatur at deleniti blanditiis temporibus. Ad fuga esse voluptatem sapiente ea consequatur molestias eum molestiae officia, assumenda cum distinctio autem blanditiis, non cumque fugit libero nam iusto dolorum qui eius pariatur quod earum. Recusandae pariatur incidunt fugiat voluptate ullam!
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
