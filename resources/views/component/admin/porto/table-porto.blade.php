
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    No
                </th>
                <th scope="col" class="px-6 py-3">
                    Judul
                </th>
                <th scope="col" class="px-6 py-3">
                    Penjelasan Singkat
                </th>
                <th scope="col" class="px-6 py-3">
                    Gambar
                </th>
                <th scope="col" class="px-6 py-3">
                    Link
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">
                        {{$index + 1}}
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$item->title}}
                    </th>
                    <td class="px-6 py-4">
                        {{$item->short_desc}}
                    </td>
                    <td class="px-6 py-4">
                        {{$item->img_url}}
                    </td>
                    <td class="px-6 py-4">
                        {{$item->link}}
                    </td>
                    <td class="px-6 py-4 flex">
                        <a href="/form-porto/edit/{{$item->m_porto_id}}?locale={{app()->getLocale()}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 text-center mx-2">
                            @include('component.icons',['type' => 'edit'])
                        </a>

                        <a href="/porto-delete/{{$item->m_porto_id}}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1 text-center mx-2">
                            @include('component.icons',['type' => 'delete'])
                        </a>
                    </td>
                </tr>    
            @endforeach
        </tbody>
    </table>
</div>
