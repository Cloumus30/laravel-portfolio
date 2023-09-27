<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @yield('head')
</head>
<body>
    {{-- Navbar --}}
    @include('component.admin.sidebar')

    <div class="p-4 sm:ml-64">
        <div class="p-4 rounded-lg mt-14">
            @yield('content')  
        </div>
    </div>

    @yield('script')
    <script>
        const importEx = document.getElementById('import-excel');
        
        function inputFile(){    
            importEx.click();
        }
    </script>
</body>
</html>