@extends('layouts.app')

@section('content')
    <div align="center">
        <form action="{{ route('ventas.store') }}" method="post">
            @csrf
            <br><br>
            <label for="idTipoProducto">Tipo de Producto:</label>
            <select name="idTipoProducto" id="idTipoProducto" required>
                @foreach($tiposProducto as $tipoProducto)
                    <option value="{{ $tipoProducto->id }}">{{ $tipoProducto->tipo }}</option>
                @endforeach
            </select><br><br>

            <label for="detalle">Detalle:</label>
            <input type="text" name="detalle" id="detalle" required><br><br>

            <label for="montoEfectivo">Monto Efectivo:</label>
            <input type="number" name="montoEfectivo" id="montoEfectivo" step="0.01" min="0" value= "0"><br><br>

            <label for="montoTransferencia">Monto Transferencia:</label>
            <input type="number" name="montoTransferencia" id="montoTransferencia" step="0.01" min="0" value= "0"><br><br>

            <label for="montoTarjeta">Monto Tarjeta:</label>
            <input type="number" name="montoTarjeta" id="montoTarjeta" step="0.01" min="0" value= "0"><br><br>

            <button type="submit">Agregar Venta</button>
        </form>
    </div>
@endsection
