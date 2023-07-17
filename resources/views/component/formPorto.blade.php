@php
    $data = [
        'title' => null,
        'link' => null,
        'short_desc' => null,
        'description' => null,
        'img' => null,
        'img_url' => null,
        'tags' => null,
    ];
    $linkForm = '/form-submit';
    if(isset($porto)){
        $data = [
            'title' => $porto['title'] ?? null,
            'link' => $porto['link'] ?? null,
            'short_desc' => $porto['short_desc'] ?? null,
            'description' => $porto['description'] ?? null,
            'img' => $porto['photo'] ?? null,
            'img_url' => $porto['img_url'] ?? null,
            'tags' => implode(',',$porto['tags']) ?? null,
        ];
        $linkForm = '/form-porto/update/' . $porto['id'];
    }
@endphp
<main class="w-full md:w-10/12 text-white bg-[#060047] max-h-screen overflow-auto">

    <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700 m-5 w-full">
        <ul class="flex flex-wrap -mb-px">
            <li class="mr-2">
                <a href="/form-porto?locale=id" id="tab-local-id" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Indonesia</a>
            </li>
            <li class="mr-2">
                <a href="/form-porto?locale=en" id="tab-local-en" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">English</a>
            </li>
        </ul>
    </div>

    <div class="p-5">
        <form id="form-porto" action="{{$linkForm}}" method="POST" onsubmit="submitFormPorto(this)" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label for="app-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('FormPorto.title') }}</label>
                <input type="text" id="app-name" name="title" value="{{$data['title']}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Aplikasi Note" required>
            </div>
            <div class="mb-6">
                <label for="link" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('FormPorto.link') }}</label>
                <input type="text" id="link" name="link" value="{{$data['link']}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="https://notes.com">
            </div>
            <div class="mb-6">
                <label for="short-desc" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('FormPorto.shortDesc') }}</label>
                <textarea id="short-desc" maxlength="215" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Aplikasi Ini Adalah..." name="short_desc">{{$data['short_desc']}}</textarea>

            </div>

            <div class="mb-6">
                <label for="tags" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('FormPorto.tags') }} (max : 8)</label>
                <input id="tags" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="search" />
                <ul id="tag-list" class="mt-5"></ul>
                <input type="text" hidden id="check-tag" value="{{$data['tags']}}" name="tags_value">
            </div>

            <div class="mb-6">
                <label for="editor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('FormPorto.description') }}</label>
                
                <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @include('component.editor', ['description' => $data['description']])
                </div>
                <input type="text" id="description" name="description" value="{{$data['description']}}" hidden>
            </div>
            <div class="mb-6">
                <label for="photo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('FormPorto.photo') }}</label>
                <input onchange="previewImage()" accept="image/png, image/jpg, image/jpeg" class="block w-full py-1 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="user_avatar_help" id="photo" name="photo" type="file">
            </div>
            
            <div class="mb-6">
                <img src="{{$data['img_url']}}" alt="" class="w-52" id="photo-preview">
            </div>
            <input type="text" id="locale-code" name="locale_code" hidden>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('FormPorto.submit') }}</button>
        </form>
      
    </div>
</main>
