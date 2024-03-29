<?php

namespace App\Http\Controllers;

use App\Models\FichaDiaria;
use App\Models\TipoProducto;
//use App\Models\TipoPago;
use Illuminate\Http\Request;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class FichaDiariaVentaController extends Controller
{
    public function mostrarFichaDiariaHoy()
    {
        if (auth()->user()) {

            //Establece la zona horaria de Argentina
            date_default_timezone_set('America/Argentina/Buenos_Aires');

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
        // Calcular los totales de ventas por tipo
        $totalEfectivo = $ventas/*->where('idTipoPago', 1)*/->sum('montoEfectivo');
        $totalTarjeta = $ventas/*->where('idTipoPago', 2)*/->sum('montoTarjeta');
        $totalTransferencia = $ventas/*->where('idTipoPago', 3)*/->sum('montoTransferencia');
        $totalArreglo = $ventas->where('idTipoProducto', 1)->sum('montoEfectivo','montoTarjeta','montoTransferencia');
        $totalTela = $ventas->where('idTipoProducto', 2)->sum('montoEfectivo','montoTarjeta','montoTransferencia');
        // Calcular el total final
        $totalFinal = $totalEfectivo + $totalTarjeta + $totalTransferencia;
    } else {
        // Si no se encontró la ficha diaria, crear una nueva
        $fichaDiaria = FichaDiaria::create([
            'inicioCaja' => $inicioCaja,
            'totalVentas' => 0,
            'aPozo' => 0,
            'cajaChica' => 0,
            'descripcion' => 'No hay descripción'
        ]);
        $totalEfectivo = 0;
        $totalTarjeta = 0;
        $totalTransferencia = 0;
        $totalArreglo = 0;
        $totalTela = 0;
        // Calcular el total final
        $totalFinal = 0;
        $ventas = [];
    }
    

    // Pasar los totales a la vista
    return view('fichaDiaria.index', compact('fichaDiaria', 'ventas', 'totalEfectivo', 'totalTarjeta', 'totalTransferencia', 'totalArreglo', 'totalTela', 'totalFinal'));
}else{
    return Redirect::route('login');
}
    }
public function create()
{
    $tiposProducto = TipoProducto::all();
    //$tiposPago = TipoPago::all();
    return view('ventas.create', compact('tiposProducto'));
}

    public function buscar(Request $request)
    {

        $fecha = $request->fecha;
        $fichaDiaria = FichaDiaria::whereDate('created_at', $fecha)->first();
        $ventas = Venta::whereDate('fecha', $fecha)->get();
        // Obtener la fecha seleccionada en el formulario
        $fechaSeleccionada = $request->input('fecha');

        // Convertir la fecha seleccionada a objeto Carbon para facilitar la manipulación
        $fecha = Carbon::createFromFormat('Y-m-d', $fechaSeleccionada);

        // Formatear la fecha como una cadena legible
        $fechaFormateada = $fecha->format('d/m/Y');

        // Calcular la fecha anterior
        $fechaAnterior = $fecha->subDay()->toDateString();

        // Calcular la fecha siguiente
        $fechaSiguiente = $fecha->addDay()->toDateString();
        if (!$fichaDiaria) {
            return view('buscarFicha.index', ['fecha' => $fecha, 'error' => true, 'fechaSeleccionada' => $fechaSeleccionada, 'fechaAnterior' => $fechaAnterior, 'fechaSiguiente' => $fechaSiguiente]);
        }

        return view('buscarFicha.index', compact('fecha', 'fichaDiaria', 'ventas'));
    }

    public function store(Request $request)
    {
        date_default_timezone_set('America/Argentina/Buenos_Aires');

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


        //carga una actividad realizada por el usuario
        $audit = new AuditController();
        $tipoProducto = TipoProducto::find($request->idTipoProducto);
        $total = $request->montoTransferencia + $request->montoTarjeta + $request->montoEfectivo;
        $operacion = 'Registro de venta N° ' . $venta->id . '; Detalle: ' . $venta->detalle . ' - Producto: ' . $tipoProducto->tipo . '; Valor total: $' . number_format($total, 0, ',', '.') . ';  - ' . Carbon::now()->format('H:i');
        $audit->create($operacion);
        // usleep(1000000);
        // Redireccionar a la vista fichaDiaria.index
        return redirect()->route('fichadiaria.hoy');
    }

    public function finalizar()
{
    date_default_timezone_set('America/Argentina/Buenos_Aires');

    // Obtener la ficha diaria actual
    $fichaDiaria = FichaDiaria::whereDate('created_at', Carbon::today())->first();

    // Verificar si se encontró la ficha diaria para la fecha actual
    if (!$fichaDiaria) {
        return redirect()->route('fichadiaria.hoy')->with('error', 'No se encontró la ficha diaria para la fecha actual.');
    }

    // Obtener las ventas asociadas a la ficha diaria
    $ventas = $fichaDiaria->ventas;

    // Pasar la ficha diaria y las ventas a la vista del formulario de finalización del día
    return view('ventas.finalizar', compact('fichaDiaria', 'ventas'))->with('idActual', $fichaDiaria->id)->with('totalCaja', $fichaDiaria->totalCaja);
}


    public function finalizarDia(Request $request)
{
    date_default_timezone_set('America/Argentina/Buenos_Aires');

    // Obtener la ficha diaria actual
    $fichaDiaria = FichaDiaria::whereDate('created_at', Carbon::today())->first();

    // Validar los datos del formulario
    $request->validate([
        'aPozo' => 'required',
    ]);

    // Actualizar los valores de aPozo y descripción en la ficha diaria actual
    $fichaDiaria->aPozo = $request->aPozo;
    // Actualizar la descripción en la ficha diaria actual
    $fichaDiaria->descripcion = $request->descripcion;
    //Guardar
    $fichaDiaria->save();

    //carga una actividad realizada por el usuario
    $audit = new AuditController();
    $operacion = 'Finalizo dia el Usuario '.auth()->user()->name.'; Valor a pozo: $'.$fichaDiaria->aPozo.'; Caja chica: $'.$fichaDiaria->cajaChica.'; Descripción: '.$fichaDiaria->descripcion.';  - '. Carbon::now()->format('H:i');
    $audit->create($operacion);
    // usleep(1200000);
    // Redireccionar a la vista fichaDiaria.index
    return redirect('/realizar-respaldo')->with('success', 'Día finalizado exitosamente');
}
    public function destroy(Venta $venta)
    {
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        //carga una actividad realizada por el usuario
        $audit = new AuditController();
        $tipoProducto = TipoProducto::find($venta->idTipoProducto);
        $total = $venta->montoTransferencia + $venta->montoTarjeta + $venta->montoEfectivo;
        $operacion = 'Elimino la venta N° ' . $venta->id . '; Detalle: ' . $venta->detalle .
            ' - Por producto tipo: ' . $tipoProducto->tipo
            . '; por un valor total: ' . number_format($total, 0, ',', '.')
            . ';  - ' . Carbon::now()->format('H:i');
        $audit->create($operacion);
        $venta->delete();
        //Dormir
        usleep(1200000);
        // Redireccionar o realizar otras acciones necesarias
        return redirect()->route('fichadiaria.hoy')->with('ventaEliminadaId', $venta->id);
    }
}
