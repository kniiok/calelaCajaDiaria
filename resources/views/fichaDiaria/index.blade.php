@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Caja') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="w-full border-solid border bg-white">
                        <thead>
                            <tr class="bg-gray-200">
                                <th colspan="8" class="py-2 px-4 border-b border-gray-200">
                                <div class="flex justify-between items-center">
                                        <span>Fecha: {{ date("d/m/Y") }}</span>
                                        <span>
                                            Inicio de caja: ${{ $fichaDiaria->inicioCaja }}
                                        </span>
                                        <div class="flex">
                                        <a href="{{ route('ventas.finalizar') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Finalizar día
                                    </a>
                                        <a href="{{ route('ventas.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                                            Agregar venta
                                        </a>

                                      </div>
                                    </div>
                                </th>
                            </tr>
                            <tr class="bg-gray-100">
                                <th class="py-2 px-4 border-b border-gray-200">Detalle</th>
                                <th class="py-2 px-4 border-b border-gray-200">Efectivo</th>
                                <th class="py-2 px-4 border-b border-gray-200">Tarjeta</th>
                                <th class="py-2 px-4 border-b border-gray-200">Transf/MP</th>
                                <th class="py-2 px-4 border-b border-gray-200">Tela</th>
                                <th class="py-2 px-4 border-b border-gray-200">Arreglo</th>
                                <th class="py-2 px-4 border-b border-gray-200">Total final</th>
                                <th class="py-2 px-4 border-b border-gray-200"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($ventas->isEmpty())
                                <tr>
                                    <th class="py-2 px-4 border-b border-gray-200" colspan="8">No hay ventas</th>
                                </tr>
                            @else
                                @php
                                    $totalEfectivo = 0;
                                    $totalTarjeta = 0;
                                    $totalTransferencia = 0;
                                    $totalTela = 0;
                                    $totalArreglo = 0;
                                @endphp
                                @foreach ($ventas as $venta)
                                    <tr>
                                        <td class="py-2 px-4 border-b border-gray-200" style="text-align: center;">{{ $venta->detalle }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200" style="text-align: right;">
                                            ${{ $venta->montoEfectivo }}
                                            @php $totalEfectivo += $venta->montoEfectivo; @endphp
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200" style="text-align: right;">
                                            ${{ $venta->montoTarjeta }}
                                            @php $totalTarjeta += $venta->montoTarjeta; @endphp
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200" style="text-align: right;">
                                            ${{ $venta->montoTransferencia }}
                                            @php $totalTransferencia += $venta->montoTransferencia; @endphp
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200" style="text-align: right;">
                                            @if ($venta->idTipoProducto == 1)
                                                ${{ $venta->montoEfectivo + $venta->montoTarjeta + $venta->montoTransferencia }}
                                                @php $totalTela += ($venta->montoEfectivo + $venta->montoTarjeta + $venta->montoTransferencia); @endphp
                                            @else
                                                $0
                                            @endif
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200" style="text-align: right;">
                                            @if ($venta->idTipoProducto == 2)
                                                ${{ $venta->montoEfectivo + $venta->montoTarjeta + $venta->montoTransferencia }}
                                                @php $totalArreglo += ($venta->montoEfectivo + $venta->montoTarjeta + $venta->montoTransferencia); @endphp
                                            @else
                                                $0
                                            @endif
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200"></td>
                                        <td class="py-2 px-4 border-b border-gray-200" width='10px'>
                                            <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" onsubmit="return confirm('¿Realmente deseas eliminar la venta {{$venta->detalle}} de valor {{$venta->montoEfectivo+$venta->MontoTarjeta+$venta->MontoTransferencia}}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                @php
                                    $totalFinal = $totalEfectivo + $totalTarjeta + $totalTransferencia;
                                @endphp
                            @endif
                        </tbody>
                        <tfoot>
                            <tr class="bg-gray-200">
                                <td class="py-2 px-4 border-b border-gray-200" style="text-align: center;">Total ventas:</td>
                                <td class="py-2 px-4 border-b border-gray-200" style="text-align: right;">${{ $totalEfectivo }}</td>
                                <td class="py-2 px-4 border-b border-gray-200" style="text-align: right;">${{ $totalTarjeta }}</td>
                                <td class="py-2 px-4 border-b border-gray-200" style="text-align: right;">${{ $totalTransferencia }}</td>
                                <td class="py-2 px-4 border-b border-gray-200" style="text-align: right;">${{ $totalTela }}</td>
                                <td class="py-2 px-4 border-b border-gray-200" style="text-align: right;">${{ $totalArreglo }}</td>
                                <td class="py-2 px-4 border-b border-gray-200" style="text-align: right;">${{ $totalFinal }}</td>
                                <td class="py-2 px-4 border-b border-gray-200"></td>
                            </tr>
                            <tr class="bg-gray-200">
                                <td class="py-2 px-4 border-b border-gray-200" style="text-align: center;">Total caja:</td>
                                <td class="py-2 px-4 border-b border-gray-200" style="text-align: right;">${{ $totalCaja = $totalEfectivo + $fichaDiaria->inicioCaja }}</td>
                                <td></td><td></td><td></td><td></td><td></td><td></td>
                            </tr>
                            <tr class="bg-gray-200">
                                <td class="py-2 px-4 border-b border-gray-200" style="text-align: center;">A pozo:</td>
                                <td class="py-2 px-4 border-b border-gray-200" style="text-align: right;">${{ $aPozo = $fichaDiaria->aPozo }}</td>
                                <td></td><td></td><td></td><td></td><td></td><td></td>
                            </tr>
                            <tr class="bg-gray-200">
                                <td class="py-2 px-4 border-b border-gray-200" style="text-align: center;">Caja chica:</td>
                                <td class="py-2 px-4 border-b border-gray-200" style="text-align: right;">${{ $cajaChica = $totalCaja - $aPozo }}</td>
                                <td></td><td></td><td></td><td></td><td></td><td></td>
                            </tr>
                            <tr class="bg-gray-200">
                                <td class="py-2 px-4 border-b border-gray-200" style="text-align: center;">Descripción:</td>
                                <th colspan="7" class="py-2 px-4 border-b border-gray-200">{{ $fichaDiaria->descripcion }}</th>
                            </tr>            
                        </tfoot>
                        
                    </table>
       
                @php
                    $fichaDiaria->totalVentas = $totalFinal;
                    $fichaDiaria->totalTela = $totalTela;
                    $fichaDiaria->totalArreglo = $totalArreglo;
                    $fichaDiaria->aPozo = $aPozo;
                    $fichaDiaria->cajaChica = $cajaChica;
                    $fichaDiaria->descripcion = $fichaDiaria->descripcion;
                    $fichaDiaria->save();    
                @endphp
                </div>
            </div>
        </div>
    </div>

@endsection
