<main class="w-full md:w-10/12 text-white bg-[#060047] max-h-screen overflow-auto">

    @auth
    <a href="/form-porto">
        <button type="button" class=" m-4 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Tambah Porto</button>    
    </a>
    @endauth
    
    <div class="flex flex-col flex-wrap md:flex-row justify-start max-h-screen">
        {{-- Card porto Start --}}
        @foreach ($portos as $porto)
            <div class="w-10/12 self-center md:w-1/3 m-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div>
                    @auth
                        <div class="flex flex-wrap items-center justify-end my-2">
                            <a href="/form-porto/edit/{{$porto->id}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mx-2">
                                @include('component.icons',['type' => 'edit'])
                            </a>

                            <a href="/porto-delete/{{$porto->id}}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 mx-2">
                                @include('component.icons',['type' => 'delete'])
                            </a>
                        </div>        
                    @endauth
                    <img class="px-4 pb-4 w-72 h-72 m-auto rounded-t-lg" src="{{ ($porto->img_url) ? $porto->img_url : Vite::asset('resources/images/dias_coding.png') }}" alt="product image" />
                </div>
                <div class="px-5 pb-5">
                    <a href="#" class="text-2xl font-bold">
                        {{-- <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">Apple Watch Series 7 GPS, Aluminium Case, Starlight Sport</h5> --}}
                        {{ $porto->title }}
                    </a>
                    
                    <div class="text-sm">
                        <p>
                            {{$porto->short_desc}}
                        </p>
                    </div>
                    
                    <div class="flex items-center justify-between my-2">
                        <a href="#" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Detail</a>
                        <a href="{{$porto->link}}" target="_blank" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Kunjungi</a>
                        
                    </div>
                </div>
            </div>
        @endforeach
        {{-- Card Porto End --}}
    
    </div>
</main>
