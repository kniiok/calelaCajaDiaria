@extends('layouts.app')
@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg animate__animated animate__fadeIn">
            <table class="w-full border-solid border bg-white animate__animated animate__fadeIn">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border-b border-gray-200 text-left">Año</th>
                        <th class="py-2 px-4 border-b border-gray-200 text-left">Mes</th>
                        <th class="py-2 px-4 border-b border-gray-200 text-left">Tipo de Producto</th>
                        <th class="py-2 px-4 border-b border-gray-200 text-left">Ventas en Efectivo</th>
                        <th class="py-2 px-4 border-b border-gray-200 text-left">Ventas en Tarjeta</th>
                        <th class="py-2 px-4 border-b border-gray-200 text-left">Ventas en Transferencia</th>
                        <th class="py-2 px-4 border-b border-gray-200 text-left">Total de Ventas</th>
                        <th class="py-2 px-4 border-b border-gray-200 text-left">Cantidad de Ventas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($statsData as $stat)
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200 text-left">{{ $stat->anio }}</td>
                            <td class="py-2 px-4 border-b border-gray-200 text-left">{{ strftime('%B', mktime(0, 0, 0, $stat->mes, 10)) }}</td>
                            <td class="py-2 px-4 border-b border-gray-200 text-left">{{ $stat->tipo_producto }}</td>
                            <td class="py-2 px-4 border-b border-gray-200 text-left">{{ $stat->ventas_efectivo }}</td>
                            <td class="py-2 px-4 border-b border-gray-200 text-left">{{ $stat->ventas_tarjeta }}</td>
                            <td class="py-2 px-4 border-b border-gray-200 text-left">{{ $stat->ventas_transferencia }}</td>
                            <td class="py-2 px-4 border-b border-gray-200 text-left">{{ $stat->total_ventas }}</td>
                            <td class="py-2 px-4 border-b border-gray-200 text-left">{{ $stat->cantidad_ventas }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                <canvas id="monthlySalesChart" width="400" height="200"></canvas>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                var ctx = document.getElementById('monthlySalesChart').getContext('2d');
                var labels = @json($monthlySales->pluck('month'));
                var data = @json($monthlySales->pluck('total_sales'));
                var dataArreglos = @json($arregloSales);
                var dataTelas = @json($telaSales);
                var dataMerceria = @json($merceriaSales);
                var chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Ventas por Mes',
                            data: data,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            x: [{
                                type: 'time',
                                time: {
                                    unit: 'month',
                                    displayFormats: {
                                        month: 'MMM YYYY'
                                    }
                                },
                                title: {
                                    display: true,
                                    text: 'Mes'
                                }
                            }],
                            y: {
                                title: {
                                    display: true,
                                    text: 'Ventas'
                                }
                            }
                        }
                    }
                });
                chart.data.datasets.push({
        label: 'Ventas de Arreglos por Mes',
        data: dataArreglos.map(entry => entry.total_sales),
        backgroundColor: 'rgba(255, 99, 132, 0.2)', // Cambia el color si lo deseas
        borderColor: 'rgba(255, 99, 132, 1)', // Cambia el color si lo deseas
        borderWidth: 1,
    });

    chart.data.datasets.push({
        label: 'Ventas de Telas por Mes',
        data: dataTelas.map(entry => entry.total_sales),
        backgroundColor: 'rgba(54, 162, 235, 0.2)', // Cambia el color si lo deseas
        borderColor: 'rgba(54, 162, 235, 1)', // Cambia el color si lo deseas
        borderWidth: 1,
    });

    chart.data.datasets.push({
        label: 'Ventas de Mercería por Mes',
        data: dataMerceria.map(entry => entry.total_sales),
        backgroundColor: 'rgba(255, 206, 86, 0.2)', // Cambia el color si lo deseas
        borderColor: 'rgba(255, 206, 86, 1)', // Cambia el color si lo deseas
        borderWidth: 1,
    });

    // Actualiza el gráfico
    chart.update();
            </script>
            
            
            </div>
        </div>
    </div>
</div>
@endsection
