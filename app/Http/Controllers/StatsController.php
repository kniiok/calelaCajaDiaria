<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
    public function showStats()
    {
        // Consulta para obtener estadísticas de ventas por mes, año y tipo de producto
        $statsData = DB::table('ventas')
            ->join('tipoproductos', 'ventas.idTipoProducto', '=', 'tipoproductos.id')
            ->select(
                DB::raw('YEAR(fecha) as anio'),
                DB::raw('MONTH(fecha) as mes'),
                'tipoproductos.tipo as tipo_producto',
                DB::raw('SUM(montoEfectivo + montoTarjeta + montoTransferencia) as total_ventas')
            )
            ->groupBy('anio', 'mes', 'tipo_producto')
            ->orderBy('anio', 'desc')
            ->orderBy('mes', 'desc')
            ->get();

            return view('stats.index', compact('statsData'));
        }
}
