<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export PDF</title>
    <style>
        table {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        table td, table th {
        border: 1px solid #ddd;
        padding: 8px;
        }

        table tr:nth-child(even){background-color: #f2f2f2;}

        table tr:hover {background-color: #ddd;}

        table th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
        }
    </style>
</head>
<body>
    <h3>
        EXPORT PDF Portofolio
    </h3>
    <table>
        <thead>
        <tr>
            <th>id</th>
            <th>Judul</th>
            <th>Deskripsi Singkat</th>
            <th>Link</th>
            <th>Deskripsi</th>
            <th>Bahasa</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->short_desc }}</td>
                <td>{{ $item->link }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->locale }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    
</body>
</html>