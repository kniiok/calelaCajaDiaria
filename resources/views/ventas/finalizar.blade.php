@extends('layouts.app')

@section('content')
<div class="block mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <h2 class="mt-10 text-center text-2xl leading-9 tracking-tight text-gray-900">El total de la caja actual es de: $ {{$fichaDiaria->totalVentas}}</h2>
  </div>
<form action="{{ route('ventas.finalizarDia') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $idActual }}">
    <div>
      <label for="apozoInput" class="block text-sm font-medium leading-6 text-gray-900">Valor de pozo:</label>
      <div class="m-1">
          <input id="text" name="aPozo" id="apozoInput"  placeholder="Valor de aPozo" required
              class="block w-full rounded-md border-0 p-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
      </div>
  </div>
    <div>
      <label for="descripcionInput" class="block text-sm font-medium leading-6 text-gray-900 ">Descripción:</label>
      <div class="m-1">
          <input id="text" name="descripcion" id="descripcionInput"  placeholder="Descripción" required
              class="block w-full mb-8 rounded-md border-0 p-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
      </div>
  </div>
    <div>
      <button type="submit"
          class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Finalizar dia</button>
  </div>
  </form>
</div>
  @endsection