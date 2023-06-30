@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Caja') }}
        </h2>
    </x-slot>
    <head>
        <link href="css/animate.min.css" rel="stylesheet">
    </head>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg animate__animated animate__fadeIn">
                <div class="overflow-x-auto animate__animated animate__fadeIn">
                    <table class="w-full border-solid border bg-white animate__animated animate__fadeIn">
                        <thead>
                            <tr class="bg-gray-200">
                                <th colspan="8" class="py-2 px-4 border-b border-gray-200">
                                <div class="flex justify-between items-center">
                                        <span>Fecha: {{ date("d/m/Y") }}</span>
                                        <span>
                                            
                                            Inicio de caja: ${{ number_format($fichaDiaria->inicioCaja, 2, ',', '.') }}
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
                                <th class="py-2 px-4 border-b border-gray-200" style="text-align: left;">Detalle</th>
                                <th class="py-2 px-4 border-b border-gray-200" style="text-align: right;">Efectivo</th>
                                <th class="py-2 px-4 border-b border-gray-200" style="text-align: right;">Tarjeta</th>
                                <th class="py-2 px-4 border-b border-gray-200" style="text-align: right;">Transf/MP</th>
                                <th class="py-2 px-4 border-b border-gray-200" style="text-align: right;">Tela</th>
                                <th class="py-2 px-4 border-b border-gray-200" style="text-align: right;">Arreglo</th>
                                <th class="py-2 px-4 border-b border-gray-200" style="text-align: right;">Total final</th>
                                <th class="py-2 px-4 border-b border-gray-200" style="text-align: right;">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($ventas==[])
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
                                        <td class="py-2 px-4 border-b border-gray-200" style="text-align: left;">{{ $venta->detalle }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200" style="text-align: right;">
                                            ${{ number_format($venta->montoEfectivo, 2, ',', '.') }}
                                            @php $totalEfectivo += $venta->montoEfectivo; @endphp
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200" style="text-align: right;">
                                            ${{ number_format($venta->montoTarjeta, 2, ',', '.') }}
                                            @php $totalTarjeta += $venta->montoTarjeta; @endphp
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200" style="text-align: right;">
                                            ${{ number_format($venta->montoTransferencia, 2, ',', '.') }}
                                            @php $totalTransferencia += $venta->montoTransferencia; @endphp
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200" style="text-align: right;">
                                            @if ($venta->idTipoProducto == 1)
                                                ${{ number_format($venta->montoEfectivo + $venta->montoTarjeta + $venta->montoTransferencia, 2, ',', '.') }}
                                                @php $totalTela += ($venta->montoEfectivo + $venta->montoTarjeta + $venta->montoTransferencia); @endphp
                                            @else
                                                $0,00
                                            @endif
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200" style="text-align: right;">
                                            @if ($venta->idTipoProducto == 2)
                                                ${{ number_format($venta->montoEfectivo + $venta->montoTarjeta + $venta->montoTransferencia, 2, ',', '.') }}
                                                @php $totalArreglo += ($venta->montoEfectivo + $venta->montoTarjeta + $venta->montoTransferencia); @endphp
                                            @else
                                                $0,00
                                            @endif
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200"></td>
                                        <td class="py-2 px-4 border-b border-gray-200" style="text-align: right;">
                                            <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" onsubmit="return confirm('¿Realmente deseas eliminar la venta {{$venta->detalle}} de valor {{$venta->montoEfectivo+$venta->MontoTarjeta+$venta->MontoTransferencia}}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                    X
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
                                <td class="py-2 px-4 border-b border-gray-200" style="text-align: left;">Total ventas:</td>
                                <td class="py-2 px-4 border-b border-gray-200" style="text-align: right;">${{ number_format($totalEfectivo, 2, ',', '.') }}</td>
                                <td class="py-2 px-4 border-b border-gray-200" style="text-align: right;">${{ number_format($totalTarjeta, 2, ',', '.') }}</td>
                                <td class="py-2 px-4 border-b border-gray-200" style="text-align: right;">${{ number_format($totalTransferencia, 2, ',', '.') }}</td>
                                <td class="py-2 px-4 border-b border-gray-200" style="text-align: right;">${{ number_format($totalTela, 2, ',', '.') }}</td>
                                <td class="py-2 px-4 border-b border-gray-200" style="text-align: right;">${{ number_format($totalArreglo, 2, ',', '.') }}</td>
                                <td class="py-2 px-4 border-b border-gray-200" style="text-align: right;">${{ number_format($totalFinal, 2, ',', '.') }}</td>
                                <td class="py-2 px-4 border-b border-gray-200"></td>
                            </tr>
                            <tr class="bg-gray-200">
                                <td class="py-2 px-4 border-b border-gray-200" style="text-align: left;">Total caja:</td>
                                <td class="py-2 px-4 border-b border-gray-200" style="text-align: right;">${{ number_format($totalCaja = $totalEfectivo + $fichaDiaria->inicioCaja, 2, ',', '.') }}</td>
                                <td></td><td></td><td></td><td></td><td></td><td></td>
                            </tr>
                            <tr class="bg-gray-200">
                                <td class="py-2 px-4 border-b border-gray-200" style="text-align: left;">A pozo:</td>
                                <td class="py-2 px-4 border-b border-gray-200" style="text-align: right;">${{ number_format($aPozo = $fichaDiaria->aPozo, 2, ',', '.') }}</td>
                                <td></td><td></td><td></td><td></td><td></td><td></td>
                            </tr>
                            <tr class="bg-gray-200">
                                <td class="py-2 px-4 border-b border-gray-200" style="text-align: left;">Caja chica:</td>
                                <td class="py-2 px-4 border-b border-gray-200" style="text-align: right;">${{ number_format($cajaChica = $totalCaja - $aPozo, 2, ',', '.') }}</td>
                                <td></td><td></td><td></td><td></td><td></td><td></td>
                            </tr>
                            <tr class="bg-gray-200">
                                <td class="py-2 px-4 border-b border-gray-200" style="text-align: left;">Descripción:</td>
                                <th colspan="7" class="py-2 px-4 border-b border-gray-200" style="text-align: left;">{{ $fichaDiaria->descripcion }}</th>
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
