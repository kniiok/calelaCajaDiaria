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
                        <th class="py-2 px-4 border-b border-gray-200 text-left">Total de Ventas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($statsData as $stat)
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200 text-left">{{ $stat->anio }}</td>
                            <td class="py-2 px-4 border-b border-gray-200 text-left">{{ date('F', mktime(0, 0, 0, $stat->mes, 10)) }}</td>
                            <td class="py-2 px-4 border-b border-gray-200 text-left">{{ $stat->tipo_producto }}</td>
                            <td class="py-2 px-4 border-b border-gray-200 text-left">{{ $stat->total_ventas }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection