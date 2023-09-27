@extends('layouts.admin-layout')

@section('head')
    <script>
        const data = {{ Js::from($data) }};
    </script>
@endsection

@section('content')
    <main>
        <h1 class="text-2xl font-bold">Dashboard</h1>
        <div class="grid grid-cols-2">
            <div>
                <canvas id="porto-bar"></canvas>
            </div>
            <div style="height: 30rem">
                <canvas id="porto-pie"></canvas>
            </div>
            <div>
                <canvas id="porto-line"></canvas>
            </div>
        </div>
    </main>
@endsection


@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>

    <script>
        const newDat = {};
        // Mapping And Change Date Format
        Object.keys(data).forEach(key => {
            const newKey = moment(key).format('DD-MM-YYYY');
            newDat[newKey] = data[key];
        });
        
        // Porto Data Chart Bar
        const portoBar = document.getElementById('porto-bar');
        new Chart(portoBar, {
            type: 'bar',
            data: {
            labels: Object.keys(newDat),
            datasets: [{
                label: 'Jumlah Porto Per tanggal',
                data: Object.values(newDat),
                borderWidth: 1
            }]
            },
            options: {
                plugins:{
                    title:{
                        display:true,
                        text: "Grafik Jumlah Porto"
                    }
                },
            scales: {
                y: {
                beginAtZero: true
                }
            }
            }
        });

        const portoPie = document.getElementById('porto-pie');
        new Chart(portoPie, {
            type: 'pie',
            data: {
                labels: Object.keys(newDat),
                datasets: [
                    {
                    label: 'Jumlah Porto Per Tanggal',
                    data: Object.values(newDat),
                    // backgroundColor: Object.values(),
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Grafik Jumlah Porto'
                }
                }
            },
        })

        // Porto Data Chart Bar
        const portoLine = document.getElementById('porto-line');
        new Chart(portoLine, {
            type: 'line',
            data: {
            labels: Object.keys(newDat),
            datasets: [{
                label: 'Jumlah Porto Per tanggal',
                data: Object.values(newDat),
                borderWidth: 1
            }]
            },
            options: {
                plugins:{
                    title:{
                        display:true,
                        text: "Grafik Jumlah Porto"
                    }
                },
            scales: {
                y: {
                beginAtZero: true
                }
            }
            }
        });
    </script>
@endsection