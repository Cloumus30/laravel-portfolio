
<nav id="navbar" class=" bg-transparent text-[#6E07F3] fixed w-full z-20 top-0 left-0">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-center mx-auto p-4">
    <div class="hidden absolute right-5">
        <div>
            @include('icons.sunIcon')
        </div>
    </div>
    <div class="items-center justify-between w-auto" id="navbar-sticky">
      <ul class="flex font-medium rounded-lg bg-transparent">
        <li>
            <a onclick="functionforscroll('home-section')" class="block hover:cursor-pointer py-2 pl-3 pr-4 rounded hover:text-blue-500 hover:bg-gray-100" aria-current="page">{{__('Landing.home')}}</a>
          </li>
          {{-- <li>
            <a onclick="functionforscroll('about-section')" class="block hover:cursor-pointer py-2 pl-3 pr-4 rounded hover:bg-gray-100 hover:text-blue-700">{{__('Landing.about')}}</a>
          </li>
          <li>
            <a onclick="functionforscroll('project-section')" class="block hover:cursor-pointer py-2 pl-3 pr-4 rounded hover:bg-gray-100 hover:text-blue-700">{{__('Landing.project')}}</a>
          </li> --}}
          @auth
            <li>
              <a href="/form-porto" class="block py-2 pl-3 pr-4 rounded hover:bg-gray-100 hover:text-blue-700">Tambah Porto</a>
            </li>    
            <li>
              <a href="/logout" class="block py-2 pl-3 pr-4 rounded hover:bg-gray-100 hover:text-blue-700">Logout</a>
            </li>    
          @endauth
          {{-- Translate Start --}}
          <li>
            <div class="flex items-center md:order-2">
              <button type="button" data-dropdown-toggle="language-dropdown-menu" class="inline-flex items-center font-medium justify-center px-4 py-2 text-sm rounded-lg cursor-pointer hover:bg-gray-100 hover:text-blue-700">
                @include('component/landing-v2/flagTranslate', ['flag' => app()->getLocale()])
              </button>
              <!-- Dropdown -->
              <div class="z-50 hidden my-4 text-base list-none nav-dropdown divide-y divide-gray-100 rounded-lg shadow" id="language-dropdown-menu">
                <ul class="py-2 font-medium" role="none">
                  <li>
                    <a onclick="changeLang('en')" class="block px-4 py-2 text-sm hover:bg-gray-100 hover:cursor-pointer hover:text-blue-700" role="menuitem">
                      @include('component/landing-v2/flagTranslate', ['flag' => 'en'])
                    </a>
                  </li>
                  <li>
                    <a onclick="changeLang('id')" class="block px-4 py-2 text-sm hover:bg-gray-100 hover:cursor-pointer hover:text-blue-700" role="menuitem">
                      <div class="inline-flex items-center">
                        @include('component/landing-v2/flagTranslate', ['flag' => 'id'])
                      </div>
                    </a>
                  </li>
                  
                </ul>
              </div>
              {{-- <button data-collapse-toggle="navbar-language" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-language" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button> --}}
          </div>
          </li>
          {{-- Translate End --}}
      </ul>
    </div>
    </div>
  </nav>
  