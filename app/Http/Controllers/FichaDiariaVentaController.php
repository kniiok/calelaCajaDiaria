<?php

namespace App\Http\Controllers;

use App\Models\FichaDiaria;
use App\Models\TipoProducto;
use App\Models\TipoPago;
use Illuminate\Http\Request;
use App\Models\Venta;
use Carbon\Carbon;


class FichaDiariaVentaController extends Controller
{
    public function mostrarFichaDiariaHoy()
{
    $fechaActual = Carbon::now()->toDateString();

    // Obtener la ficha diaria anterior a la actual
    $fichaAnterior = FichaDiaria::whereDate('created_at', '<', $fechaActual)
        ->orderBy('created_at', 'desc')
        ->first();

    if ($fichaAnterior) {
        // Obtener el valor de "cajaChica" de la ficha diaria anterior
        $inicioCaja = $fichaAnterior->cajaChica;
    } else {
        // Si no hay una ficha anterior, establecer un valor predeterminado
        $inicioCaja = 0; // Valor inicial de la caja
    }


    // Buscar la ficha diaria actual
    $fichaDiaria = FichaDiaria::whereDate('created_at', $fechaActual)->first();

    // Verificar si se encontró la ficha diaria para la fecha actual
    if ($fichaDiaria) {
        $ventas = $fichaDiaria->ventas;
    } else {
        // Si no se encontró la ficha diaria, crear una nueva
        $fichaDiaria = FichaDiaria::create([
            'idUsuario' => auth()->user()->id,
            'inicioCaja' => $inicioCaja,
            'totalVentas' => 0,
            'aPozo' => 0,
            'cajaChica' => 0,
            'descripcion' => 'No hay descripción'
        ]);

        $ventas = [];
    }
    // Calcular los totales de ventas por tipo
    $totalEfectivo = $ventas/*->where('idTipoPago', 1)*/->sum('montoEfectivo');
    $totalTarjeta = $ventas/*->where('idTipoPago', 2)*/->sum('montoTarjeta');
    $totalTransferencia = $ventas/*->where('idTipoPago', 3)*/->sum('montoTransferencia');
    $totalArreglo = $ventas->where('idTipoProducto', 1)->sum('montoEfectivo','montoTarjeta','montoTransferencia');
    $totalTela = $ventas->where('idTipoProducto', 2)->sum('montoEfectivo','montoTarjeta','montoTransferencia');

    // Calcular el total final
    $totalFinal = $totalEfectivo + $totalTarjeta + $totalTransferencia;

    // Pasar los totales a la vista
    return view('fichaDiaria.index', compact('fichaDiaria', 'ventas', 'totalEfectivo', 'totalTarjeta', 'totalTransferencia', 'totalArreglo', 'totalTela', 'totalFinal'));
}
public function create()
{
    $tiposProducto = TipoProducto::all();
    //$tiposPago = TipoPago::all();
    return view('ventas.create', compact('tiposProducto'));
}

public function store(Request $request)
{
    // Obtener la ficha diaria actual
    $fichaDiaria = FichaDiaria::whereDate('created_at', Carbon::today())->first();

    // Validar y guardar la venta
    $venta = new Venta();
    $venta->idTipoProducto = $request->idTipoProducto;
    //$venta->idTipoPago = $request->idTipoPago;
    $venta->montoEfectivo = $request->montoEfectivo;
    $venta->montoTarjeta = $request->montoTarjeta;
    $venta->montoTransferencia = $request->montoTransferencia;
    $venta->detalle = $request->detalle;
    $venta->idFichaDiaria = $fichaDiaria->id; // Asignar el ID de la ficha diaria actual
    //$venta->monto = $request->monto;
    $venta->fecha = Carbon::now(); // Establecer la fecha actual
    $venta->save();

    // Redireccionar a la vista fichaDiaria.index
    return redirect()->route('fichadiaria.hoy');
}

public function finalizar()
{
    // Obtener la ficha diaria actual
    $fichaDiaria = FichaDiaria::whereDate('created_at', Carbon::today())->first();

    // Verificar si se encontró la ficha diaria para la fecha actual
    if (!$fichaDiaria) {
        return redirect()->route('fichadiaria.hoy')->with('error', 'No se encontró la ficha diaria para la fecha actual.');
    }

    // Pasar la ficha diaria a la vista del formulario de finalización del día
    return view('ventas.finalizar', compact('fichaDiaria'))->with('idActual', $fichaDiaria->id)->with('totalCaja', $fichaDiaria->totalCaja);
}

public function finalizarDia(Request $request)
{
    // Obtener la ficha diaria actual
    $fichaDiaria = FichaDiaria::whereDate('created_at', Carbon::today())->first();

    // Validar los datos del formulario
    $request->validate([
        'aPozo' => 'required',
        'descripcion' => 'required',
    ]);

    // Actualizar los valores de aPozo y descripción en la ficha diaria actual
    $fichaDiaria->aPozo = $request->aPozo;
    $fichaDiaria->descripcion = $request->descripcion;
    $fichaDiaria->save();

    // Redireccionar a la vista fichaDiaria.index
    return redirect()->route('fichadiaria.hoy')->with('success', 'Día finalizado exitosamente');
}


}