@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<body class="bg-gray-100">
    <section class="border p-4 m-4 bg-white rounded-md">
        <h1 class="text-2xl font-semibold mb-4">Hello {{ auth()->user()->name }}</h1>

        <section class="grid grid-cols-2 gap-6">
            <!-- Top 3 Kendaraan Section -->
            <aside class="p-4 border rounded bg-gray-50">
                <h2 class="text-xl mb-2">Top 3 Kendaraan yang Dipinjam</h2>
                <div id="top3" class="h-64"></div> <!-- Memberi batasan tinggi pada chart -->
            </aside>

            <!-- Vehicles Table Section -->
            <aside class="p-4 border rounded bg-gray-50">
                <h2 class="text-xl mb-2">Daftar Kendaraan</h2>
                <div class="overflow-y-auto max-h-64"> <!-- Batasan tinggi pada tabel agar bisa di-scroll -->
                    <table id="vehicles" class="min-w-full table-auto">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">Kendaraan</th>
                                <th class="border px-4 py-2">Total Dipinjam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $item)
                            <tr>
                                <td class="border px-4 py-2">{{ $item["type"] }} | {{ $item["name"] }}</td>
                                <td class="border px-4 py-2">{{ $item["total"] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </aside>
        </section>
    </section>

    <!-- Load ApexCharts and DataTable Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script>
        // Initialize DataTable for vehicles table
        $(document).ready(function() {
            $('#vehicles').DataTable({
                "paging": false, // Disable pagination for smaller tables
                "info": false // Hide table info
            });
        });

        // Prepare data for ApexCharts
        const top3 = @json($list);

        // Ensure top 3 items are displayed
        if (top3.length < 3) {
            for (let i = top3.length; i < 3; i++) {
                top3.push({
                    type: "-",
                    name: "-",
                    total: 0
                });
            }
        } else {
            top3.splice(3); // Show only top 3
        }

        // Create bar chart using ApexCharts
        const options = {
            chart: {
                type: 'bar',
                height: '250px' // Adjust chart height to make it smaller
            },
            series: [{
                data: top3.map(item => item.total)
            }],
            xaxis: {
                categories: top3.map(item => item.type + " | " + item.name)
            },
            title: {
                text: 'Top 3 Kendaraan yang Dipinjam',
                align: 'center'
            }
        };

        const chart = new ApexCharts(document.querySelector("#top3"), options);
        chart.render();
    </script>
</body>

</html>

@endsection
