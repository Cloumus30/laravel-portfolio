<main class="w-full md:w-10/12 text-white bg-[#060047] max-h-screen overflow-auto">
    <div class="p-5">
        <form id="form-porto" action="/form-submit" method="POST" onsubmit="submitFormPorto(this)" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label for="app-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul / Nama</label>
                <input type="text" id="app-name" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Aplikasi Note" required>
            </div>
            <div class="mb-6">
                <label for="link" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Link Aplikasi</label>
                <input type="text" id="link" name="link" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="https://notes.com">
            </div>
            <div class="mb-6">
                <label for="editor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi App</label>
                
                <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @include('component.editor')
                </div>
                <input type="text" id="description" name="description" hidden>
            </div>
            <div class="mb-6">
                <label for="photo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">App Photo</label>
                <input onchange="previewImage()" accept="image/png, image/jpg, image/jpeg" class="block w-full py-1 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="photo" name="photo" type="file">
            </div>
            
            <div class="mb-6">
                <img src="" alt="alternative" class="hidden w-52" id="photo-preview">
            </div>

            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
      
    </div>
</main>