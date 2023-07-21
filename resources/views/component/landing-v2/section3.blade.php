<section id="project-section" class="flex flex-col justify-center pt-10">
    <div class=" text-4xl md:text-5xl text-center font-[Inter] py-5 mb-24">
        <h1>{{__('Landing.latestProject')}}</h1>
    </div>
    <div class="">
        @foreach ($portos as $item)
            <div class="h-full mt-20 mb-52 text-center px-7 md:px-16 w-full flex flex-wrap justify-around">
                <div class="md:w-1/2 w-full">
                    <a href="{{$item->link}}" target="_blank" class=" hover:underline flex justify-center text-2xl mb-3 font-bold md:mb-0"> 
                        <div class="peer" data-tooltip-target="tooltip-kunjungi">
                            {{$item->title}} 
                        </div>
                        <img class="w-5 h-5 hidden peer-hover:block" src="{{Vite::asset('resources/images/icons/linking.png')}}" alt="">
                    </a>
                    <div id="tooltip-kunjungi" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">
                        Kunjungi Website
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
        
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
                            <a href="/form-porto/edit/{{$item->m_porto_id}}?locale={{app()->getLocale()}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mx-2">
                                @include('component.icons',['type' => 'edit'])
                            </a>

                            <a href="/porto-delete/{{$item->m_porto_id}}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 mx-2">
                                @include('component.icons',['type' => 'delete'])
                            </a>
                        </div>    
                    @endauth
                    
                </div>
                <a href="/porto/detail/{{$item->m_porto_id}}?locale={{app()->getLocale()}}" data-tooltip-target="tooltip-detail" class="flex hover:bg-slate-300 justify-center md:w-1/2 w-full order-first md:order-last mb-5">
                    <img class="w-[80%] aspect-auto images" src="{{ ($item->img_url) ? $item->img_url : Vite::asset('resources/images/dias_coding.png') }}" alt="">
                </a>
                <div id="tooltip-detail" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">
                    Detail Project
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>    
        @endforeach
    </div>
    
</section>