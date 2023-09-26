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
        DB::raw('SUM(montoEfectivo) as ventas_efectivo'),
        DB::raw('SUM(montoTarjeta) as ventas_tarjeta'),
        DB::raw('SUM(montoTransferencia) as ventas_transferencia'),
        DB::raw('SUM(montoEfectivo + montoTarjeta + montoTransferencia) as total_ventas'),
        DB::raw('COUNT(*) as cantidad_ventas')
    )
    ->groupBy('anio', 'mes', 'tipo_producto')
    ->orderBy('anio', 'desc')
    ->orderBy('mes', 'desc')
    ->paginate(5); // Cambia el número de elementos por página según tu preferencia


        $monthlySales = DB::table('ventas')
            ->select(
                DB::raw('DATE_FORMAT(fecha, "%Y-%m") as month'),
                DB::raw('SUM(montoEfectivo + montoTarjeta + montoTransferencia) as total_sales')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();
            
            // Consulta para obtener estadísticas de ventas por mes y tipo de producto (arreglos)
            $arregloSales = DB::table('ventas')
            ->join('tipoproductos', 'ventas.idTipoProducto', '=', 'tipoproductos.id')
            ->select(
                DB::raw('DATE_FORMAT(fecha, "%Y-%m") as month'),
                DB::raw('SUM(montoEfectivo + montoTarjeta + montoTransferencia) as total_sales')
            )
            ->where('tipoproductos.tipo', '=', 'Arreglo') // Cambia 'Arreglos' por el nombre correcto
            ->groupBy('month')
            ->orderBy('month')
            ->get();

           // Consulta para obtener estadísticas de ventas por mes y tipo de producto (tela)
           $telaSales = DB::table('ventas')
           ->join('tipoproductos', 'ventas.idTipoProducto', '=', 'tipoproductos.id')
           ->select(
               DB::raw('DATE_FORMAT(fecha, "%Y-%m") as month'),
               DB::raw('SUM(montoEfectivo + montoTarjeta + montoTransferencia) as total_sales')
           )
           ->where('tipoproductos.tipo', '=', 'Tela') // Cambia 'Arreglos' por el nombre correcto
           ->groupBy('month')
           ->orderBy('month')
           ->get();

           // Consulta para obtener estadísticas de ventas por mes y tipo de producto (merceria)
           $merceriaSales = DB::table('ventas')
           ->join('tipoproductos', 'ventas.idTipoProducto', '=', 'tipoproductos.id')
           ->select(
               DB::raw('DATE_FORMAT(fecha, "%Y-%m") as month'),
               DB::raw('SUM(montoEfectivo + montoTarjeta + montoTransferencia) as total_sales')
           )
           ->where('tipoproductos.tipo', '=', 'Merceria') // Cambia 'Arreglos' por el nombre correcto
           ->groupBy('month')
           ->orderBy('month')
           ->get();
            
           //return view('stats.index', compact('statsData', 'monthlySales', 'arregloSales', 'telaSales', 'merceriaSales'));
           return view('stats.locked');
        }
}
