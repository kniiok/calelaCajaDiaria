@extends('layouts.app')

@section('content')
<div align="center">
    El total de la caja actual es de: $@php echo $fichaDiaria->totalVentas @endphp
<form action="{{ route('ventas.finalizarDia') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $idActual }}">
    <label for="apozoInput">Valor de aPozo:</label>
    <input type="text" name="aPozo" id="apozoInput" placeholder="Valor de aPozo" required><br><br>
    <label for="descripcionInput">Descripción:</label>
    <input type="text" name="descripcion" id="descripcionInput" placeholder="Descripción" required><br><br>
    <button type="submit">Finalizar día</button>
  </form>
</div>
  @endsection