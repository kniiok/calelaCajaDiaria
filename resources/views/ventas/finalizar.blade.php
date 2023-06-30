@extends('layouts.app')

@section('content')

<head>
  <link href="css/animate.min.css" rel="stylesheet">
</head>
<div hidden>
{{$montoEfectivo=0}} 
@for($i=0;$i<count($ventas);$i++)
  {{$montoEfectivo += $ventas[$i]['montoEfectivo']}}
@endfor
</div>

<div class="block mt-10 sm:mx-auto sm:w-full sm:max-w-sm animate__animated animate__fadeIn">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <?php $totalCaja = $fichaDiaria->inicioCaja + $montoEfectivo?>
    <h2 class="mt-10 text-center text-2xl leading-9 tracking-tight text-gray-900 animate__animated animate__fadeIn">El total de la caja actual es de: $ {{$totalCaja}}</h2>
  </div>
  <form action="{{ route('ventas.finalizarDia') }}" method="POST" class="animate__animated animate__fadeIn">
    @csrf
    <input type="hidden" name="id" value="{{ $idActual }}">
    <div>
      <label for="apozoInput" class="block text-sm font-medium leading-6 text-gray-900">¿Cuánto sacas de la caja?</label>
      <div class="m-1">
          <input type="number" id="apozoInput" name="aPozo" placeholder="Número mayor a 0 y menor o igual a la caja actual" required
              class="block w-full rounded-md border-0 p-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 animate__animated animate__fadeIn">
      </div>
  </div>
    <div>
      <label for="descripcionInput" class="block text-sm font-medium leading-6 text-gray-900 animate__animated animate__fadeIn">Descripción:</label>
      <div class="m-1">
        <input id="descripcionInput" name="descripcion" placeholder="Descripción"
          value="No hay descripción"
          class="block w-full mb-8 rounded-md border-0 p-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 animate__animated animate__fadeIn">
      </div>
      
  </div>
    <div>
      <button type="submit"
          class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 animate__animated animate__fadeIn">Finalizar día</button>
  </div>
  </form>
  {{-- @dump($totalCaja) --}}
</div>

<script>
  const aPozoInput = document.getElementById('apozoInput');
  const totalCaja = {{ $totalCaja }};

  aPozoInput.addEventListener('input', function() {
    const value = parseFloat(aPozoInput.value);
    if (isNaN(value) || value < 0) {
      aPozoInput.setCustomValidity('Ingrese un número positivo.');
    } else if (value > totalCaja) {
      aPozoInput.setCustomValidity('Ingrese un número menor o igual que el total de la caja.');
    } else {
      aPozoInput.setCustomValidity('');
    }
  });
</script>
@endsection
