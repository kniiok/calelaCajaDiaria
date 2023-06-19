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
                <table class="w-full border-solid border bg-white">
                    <tr class="bg-gray-200">
                        <td colspan="4" class="py-2 px-4 border-b border-gray-200">
                            Fecha: {{ date("Y-m-d") }}
                        </td>
                        <td colspan="3" class="py-2 px-4 border-b border-gray-200">
                            Inicio de caja: ${{ $fichaDiaria->inicioCaja }}
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
                    <tr>
                        @if($ventas->isEmpty())
                            <th class="py-2 px-4 border-b border-gray-200" colspan="7">No hay ventas</th>
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
                                    <td class="py-2 px-4 border-b border-gray-200">{{ $venta->detalle }}</td>
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        @if ($venta->idTipoPago == '1')
                                            ${{ $venta->monto }}
                                            @php $totalEfectivo += $venta->monto; @endphp
                                        @else
                                            $0
                                        @endif
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        @if ($venta->idTipoPago == '2')
                                            ${{ $venta->monto }}
                                            @php $totalTarjeta += $venta->monto; @endphp
                                        @else
                                            $0
                                        @endif
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        @if ($venta->idTipoPago == '3')
                                            ${{ $venta->monto }}
                                            @php $totalTransferencia += $venta->monto; @endphp
                                        @else
                                            $0
                                        @endif
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        @if ($venta->idTipoProducto == 2)
                                            ${{ $venta->monto }}
                                            @php $totalTela += $venta->monto; @endphp
                                        @else
                                            $0
                                        @endif
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200">
                                        @if ($venta->idTipoProducto == 1)
                                            ${{ $venta->monto }}
                                            @php $totalArreglo += $venta->monto; @endphp
                                        @else
                                            $0
                                        @endif
                                    </td>
                                    <td class="py-2 px-4 border-b border-gray-200"></td>
                                </tr>
                            @endforeach
                            @php
                                $totalFinal = $totalEfectivo + $totalTarjeta + $totalTransferencia;// + $totalTela + $totalArreglo;
                            @endphp
                        @endif
                        
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200">Total ventas:</td>
                        <td class="py-2 px-4 border-b border-gray-200">${{ $totalEfectivo }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">${{ $totalTarjeta }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">${{ $totalTransferencia }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">${{ $totalTela }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">${{ $totalArreglo }}</td>
                        <td class="py-2 px-4 border-b border-gray-200">${{ $totalFinal }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200">Total caja:</td>
                        <td class="py-2 px-4 border-b border-gray-200">${{ $totalCaja = $totalEfectivo + $fichaDiaria->inicioCaja }}</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200">A pozo:</td>
                        <td class="py-2 px-4 border-b border-gray-200">${{ $aPozo = $fichaDiaria->aPozo}}</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200">Caja chica:</td>
                        <td class="py-2 px-4 border-b border-gray-200">${{$cajaChica = $totalFinal-$aPozo}}</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200">Descripción:</td>
                        <th colspan="7" class="py-2 px-4 border-b border-gray-200">{{$fichaDiaria->descripcion}}</th>
                    </tr>
                    <tr>
                        <td colspan="7" class="py-2 px-4 border-b border-gray-200 text-center">
                            <a href="{{ route('ventas.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Agregar venta
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7" class="py-2 px-4 border-b border-gray-200 text-center">
                            <a href="{{ route('ventas.finalizar') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Finalizar día
                            </a>
                        </td>
                    </tr>                   
                </table>
                @php
    $totalFinal = $totalEfectivo + $totalTarjeta + $totalTransferencia;
    $fichaDiaria->totalVentas = $totalFinal;
    $fichaDiaria->aPozo = $aPozo;
    $fichaDiaria->cajaChica = $cajaChica;
    $fichaDiaria->descripcion = $fichaDiaria->descripcion;
    $fichaDiaria->save();
@endphp

            </div>
        </div>
    </div>
@endsection