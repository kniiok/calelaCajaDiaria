@extends('layouts.app')
@section('content')
    <div class="block mt-5 sm:mx-auto sm:w-full sm:max-w-sm">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-5 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Buscador de ficha</h2>
        </div>
        <form action="{{ route('fichas.buscada') }}" method="get" class="my-4">
            @csrf
            <div>
                <label for="detalle" class="block text-sm font-medium leading-6 text-gray-900">Buscar ficha por
                    fecha:</label>
                <div class="m-1">
                    <input type="date" name="fecha" id="fecha" required
                        class="block w-full rounded-md border-0 p-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div>
                <button type="submit"
                    class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Buscar</button>
            </div>
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
                @if (isset($fecha))
                    <table class="w-full border-solid border bg-white">
                        <tr class="bg-gray-200">
                            <td colspan="4" class="py-2 px-4 border-b border-gray-200">
                                Fecha: {{ $fecha }}
                            </td>
                            <td colspan="3" class="py-2 px-4 border-b border-gray-200">
                                @if (isset($fichaDiaria))
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
                                <td class="py-2 px-4 border-b border-gray-200">
                                    ${{ $totalEfectivo + $totalTarjeta + $totalTransferencia }}</td>
                            </tr>
                        @endif
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
