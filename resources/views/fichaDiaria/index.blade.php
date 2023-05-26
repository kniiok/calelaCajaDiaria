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
                            Inicio de caja: $1000
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
                        <td class="py-2 px-4 border-b border-gray-200">Algo</td>
                        <td class="py-2 px-4 border-b border-gray-200">Algo</td>
                        <td class="py-2 px-4 border-b border-gray-200">Algo</td>
                        <td class="py-2 px-4 border-b border-gray-200">Algo</td>
                        <td class="py-2 px-4 border-b border-gray-200">Algo</td>
                        <td class="py-2 px-4 border-b border-gray-200">Algo</td>
                        <td class="py-2 px-4 border-b border-gray-200">Algo</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200">Total ventas:</td>
                        <td class="py-2 px-4 border-b border-gray-200">$</td>
                        <td class="py-2 px-4 border-b border-gray-200">$</td>
                        <td class="py-2 px-4 border-b border-gray-200">$</td>
                        <td class="py-2 px-4 border-b border-gray-200">$</td>
                        <td class="py-2 px-4 border-b border-gray-200">$</td>
                        <td class="py-2 px-4 border-b border-gray-200">$</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200">Total caja:</td>
                        <td class="py-2 px-4 border-b border-gray-200">$</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200">A pozo:</td>
                        <td class="py-2 px-4 border-b border-gray-200">$</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200">Caja chica:</td>
                        <td class="py-2 px-4 border-b border-gray-200">$</td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200">Descripción:</td>
                        <td colspan="7" class="py-2 px-4 border-b border-gray-200">No hay descripción</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
@endsection