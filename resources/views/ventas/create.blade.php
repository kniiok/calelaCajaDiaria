@extends('layouts.app')

@section('content')

<head>
    <link href="css/animate.min.css" rel="stylesheet">
    <link href='css/sweetalert2.all.min.css' rel="stylesheet">
</head>

<div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm animate__animated animate__fadeIn">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900 animate__animated animate__fadeIn">Registrar Venta</h2>
    </div>
    <form action="{{ route('ventas.store') }}" method="post" class="animate__animated animate__fadeIn" id="venta-form">
        @csrf
        <div>
            <label for="idTipoProducto" class="block text-sm font-medium leading-6 text-gray-900">Tipo de
                Producto:</label>
            <div class="mt-2">
                <select name="idTipoProducto" id="idTipoProducto"
                    class="block w-full rounded-md border-0 p-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                    required>
                    @foreach ($tiposProducto as $tipoProducto)
                        <option value="{{ $tipoProducto->id }}">{{ $tipoProducto->tipo }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div>
            <label for="detalle" class="block text-sm font-medium leading-6 text-gray-900">Detalle:</label>
            <div class="m-1">
                <input id="text" name="detalle" id="detalle" autocomplete="name" required
                    class="block w-full rounded-md border-0 p-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 animate__animated animate__fadeIn">
            </div>
        </div>
        <div>
            <label for="montoEfectivo" class="block text-sm font-medium leading-6 text-gray-900">Monto Efectivo:</label>
            <div class="m-1">
                <input type="number" name="montoEfectivo" id="montoEfectivo" step="0.01" min="0" value="0"
                    class="block w-full rounded-md border-0 p-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 animate__animated animate__fadeIn">
            </div>
        </div>
        <div>
            <label for="montoTarjeta" class="block text-sm font-medium leading-6 text-gray-900">Monto Tarjeta:</label>
            <div class="m-1">
                <input type="number" name="montoTarjeta" id="montoTarjeta" step="0.01" min="0" value="0"
                    class="block w-full rounded-md border-0 p-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 animate__animated animate__fadeIn">
            </div>
        </div>
        <div>
            <label for="montoTransferencia" class="block text-sm font-medium leading-6 text-gray-900">Monto
                Transferencia:</label>
            <div class="m-1">
                <input type="number" name="montoTransferencia" id="montoTransferencia" step="0.01" min="0"
                    value="0"
                    class="block w-full rounded-md border-0 p-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 animate__animated animate__fadeIn">
            </div>
        </div>
        <div>
            <button type="submit"
                class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 animate__animated animate__fadeIn">Agregar
                Venta</button>
        </div>
    </form>
</div>
<script src='js/sweetalert2.all.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ventaForm = document.getElementById('venta-form');

        ventaForm.addEventListener('submit', function (event) {
            event.preventDefault();
            // Mostrar el mensaje de confirmación
            Swal.fire({
                title: 'Venta agregada correctamente',
                text: 'Se redirigirá a la Ficha Diaria.',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            }).then((result) => {
                ventaForm.submit();
            });
        });
    });
</script>

@endsection
