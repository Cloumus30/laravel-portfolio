
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
            <a href="/#home-section" class="block py-2 pl-3 pr-4 rounded hover:text-blue-500 hover:bg-gray-100" aria-current="page">Home</a>
          </li>
          <li>
            <a href="/#about-section" class="block py-2 pl-3 pr-4 rounded hover:bg-gray-100 hover:text-blue-700">About</a>
          </li>
          <li>
            <a href="/#project-section" class="block py-2 pl-3 pr-4 rounded hover:bg-gray-100 hover:text-blue-700">Project</a>
          </li>
          @auth
            <li>
              <a href="/form-porto" class="block py-2 pl-3 pr-4 rounded hover:bg-gray-100 hover:text-blue-700">Tambah Porto</a>
            </li>    
            <li>
              <a href="/logout" class="block py-2 pl-3 pr-4 rounded hover:bg-gray-100 hover:text-blue-700">Logout</a>
            </li>    
          @endauth
      </ul>
    </div>
    </div>
  </nav>
  