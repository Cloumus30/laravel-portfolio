<section id="project-section" class="flex flex-col justify-center pt-10">
    <div class=" text-4xl md:text-5xl text-center font-[Inter] py-5">
        <h1>Latest Project</h1>
    </div>
    <div class="">
        @foreach ($portos as $item)
            <div class="h-full mt-14 text-center px-7 md:px-16 w-full flex flex-wrap justify-around">
                <div class="md:w-1/2 w-full">
                    <a href="/porto/detail/{{$item->id}}" class=" hover:underline text-2xl mb-3 font-bold md:mb-0">{{$item->title}}</a>
        
                    <p class="md:text-xl">
                        {{$item->short_desc}}
                    </p>
                    <div class="flex flex-wrap md:gap-3 mt-10 justify-center">
                        @foreach ($item->tags as $tag)
                        <p type="button" class="text-[#6E07F3] border border-[#6E07F3] bg-transparent hover:bg-purple-700 hover:text-white focus:outline-none font-medium rounded-full text-xs px-4 py-2.5 md:text-sm md:px-5 md:py-2.5 text-center mr-2 mb-2 ">{{$tag->name}}</p>    
                        @endforeach
                    </div>
                    @auth
                        <div class="flex flex-wrap md:gap-3 mt-10 justify-center">
                            <a href="/form-porto/edit/{{$item->id}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mx-2">
                                @include('component.icons',['type' => 'edit'])
                            </a>

                            <a href="/porto-delete/{{$item->id}}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 mx-2">
                                @include('component.icons',['type' => 'delete'])
                            </a>
                        </div>    
                    @endauth
                    
                </div>
                <a href="/porto/detail/{{$item->id}}" class="flex hover:bg-slate-300 justify-center md:w-1/2 w-full order-first md:order-last mb-5">
                    <img class="w-72 aspect-auto images" src="{{ ($item->img_url) ? $item->img_url : Vite::asset('resources/images/dias_coding.png') }}" alt="">
                </a>
            </div>    
        @endforeach
    </div>
    
</section>