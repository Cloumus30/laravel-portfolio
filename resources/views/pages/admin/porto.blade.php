@extends('layouts.admin-layout')

@section('content')
    <main>
        <h1 class="text-2xl font-bold">Porto Page</h1>
        <div class="btn-group flex justify-end my-3">
            <button type="button" data-modal-target="import-modal" data-modal-toggle="import-modal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                Import Excel
            </button>

            <a href="/admin/porto-export" target="_blank" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                Export Excel
            </a>

            <a href="/admin/porto-export-pdf" target="_blank" class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                Export PDF
            </a>

            <a href="/form-porto" class="text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                Tambah Porto
            </a>

            <input type="file" hidden id="import-excel">
        </div>
        <div class="mt-5">
            @include('component.admin.porto.table-porto', ['data' => $data])
            {{ $data->links() }}
        </div>
    </main>
  
  <!-- Main modal -->
  <div id="import-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative w-full max-w-md max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="import-modal">
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                  </svg>
                  <span class="sr-only">Close modal</span>
              </button>
              <div class="px-6 py-6 lg:px-8">
                  <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Import Excel</h3>
                  <form class="space-y-6" action="/admin/porto-import" method="POST" enctype="multipart/form-data">
                    @csrf
                      <div>
                          <label for="file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload File</label>
                          <input accept=".xlsx, .xls, .csv" type="file" name="file" id="file" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="name@company.com" required>
                      </div>
                      
                      <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Import Data</button>
                      
                  </form>
              </div>
          </div>
      </div>
  </div> 
  
@endsection

@section('script')
    
@endsection