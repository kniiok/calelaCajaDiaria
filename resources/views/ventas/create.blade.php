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

            <label for="idTipoPago">Tipo de Pago:</label>
            <select name="idTipoPago" id="idTipoPago" required>
                @foreach($tiposPago as $tipoPago)
                    <option value="{{ $tipoPago->id }}">{{ $tipoPago->tipo }}</option>
                @endforeach
            </select><br><br>

            <label for="detalle">Detalle:</label>
            <input type="text" name="detalle" id="detalle" required><br><br>

            <label for="monto">Monto:</label>
            <input type="number" name="monto" id="monto" step="0.01" required><br><br>

            <button type="submit">Agregar Venta</button>
        </form>
    </div>
@endsection
