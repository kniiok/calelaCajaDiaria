@extends('layouts.app')
@section('content')

<div align="center">
    <form action="{{ route('fichas.buscada') }}" method="get" class="my-4">
        @csrf
        <label for="fecha" class="mr-2">Buscar ficha por fecha:</label>
        <input type="date" name="fecha" id="fecha" required class="px-2 py-1 border rounded"><br><br>
        <button type="submit" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Buscar</button>
    </form>
</div>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Caja') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            @if(isset($fecha))
                <table class="w-full border-solid border bg-white">
                    <tr class="bg-gray-200">
                        <td colspan="4" class="py-2 px-4 border-b border-gray-200">
                            Fecha: {{ $fecha }}
                        </td>
                        <td colspan="3" class="py-2 px-4 border-b border-gray-200">
                            @if(isset($fichaDiaria))
                                Inicio de caja: ${{ $fichaDiaria->inicioCaja }}
                            @else
                                No hay ficha para el día {{ $fecha }}
                            @endif
                        </td>
                    </tr>
                    <tr class="bg-gray-100">
                        <td class="py-2 px-4 border-b border-gray-200">Detalle</td>
                        <td class="py-2 px-4 border-b border-gray-200">Efectivo</td>
                        <td class="py-2 px-4 border-b border-gray-200">Tarjeta</td>
                        <td class="py-2 px-4 border-b border-gray-200">Transf/MP</td>
                        <td class="py-2 px-4 border-b border-gray-200">Tela</td>
                        <td class="py-2 px-4 border-b border-gray-200">Arreglo</td>
                        <td class="py-2 px-4 border-b border-gray-200">Total final</td>
                    </tr>
                    @if (isset($ventas) && $ventas->isEmpty())
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-200" colspan="7">No hay ventas</th>
                        </tr>
                    @elseif (isset($ventas))
                        @php
                            $totalEfectivo = 0;
                            $totalTarjeta = 0;
                            $totalTransferencia = 0;
                            $totalTela = 0;
                            $totalArreglo = 0;
                        @endphp
                        @foreach ($ventas as $venta)
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-200">{{ $venta->detalle }}</td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    ${{ $venta->montoEfectivo }}
                                    @php $totalEfectivo += $venta->montoEfectivo; @endphp
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    ${{ $venta->montoTarjeta }}
                                    @php $totalTarjeta += $venta->montoTarjeta; @endphp
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    ${{ $venta->montoTransferencia }}
                                    @php $totalTransferencia += $venta->montoTransferencia; @endphp
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    @if ($venta->idTipoProducto == 1)
                                        ${{ $venta->montoEfectivo + $venta->montoTarjeta + $venta->montoTransferencia }}
                                        @php $totalTela += ($venta->montoEfectivo + $venta->montoTarjeta + $venta->montoTransferencia); @endphp
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    @if ($venta->idTipoProducto == 2)
                                        ${{ $venta->montoEfectivo + $venta->montoTarjeta + $venta->montoTransferencia }}
                                        @php $totalArreglo += ($venta->montoEfectivo + $venta->montoTarjeta + $venta->montoTransferencia); @endphp
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="py-2 px-4 border-b border-gray-200">
                                    ${{ $venta->montoEfectivo + $venta->montoTarjeta + $venta->montoTransferencia }}
                                </td>
                            </tr>
                        @endforeach
                        <tr class="bg-gray-200">
                            <td class="py-2 px-4 border-b border-gray-200">Totales</td>
                            <td class="py-2 px-4 border-b border-gray-200">${{ $totalEfectivo }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">${{ $totalTarjeta }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">${{ $totalTransferencia }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">${{ $totalTela }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">${{ $totalArreglo }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">${{ $totalEfectivo + $totalTarjeta + $totalTransferencia }}</td>
                        </tr>
                    @endif
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
