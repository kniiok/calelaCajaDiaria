<?php

namespace App\Http\Controllers;

use App\Models\TipoPago;

class TipoPagoController extends Controller
{
    public function index()
    {
        $tiposPago = TipoPago::all();
        return view('tipospago.index', compact('tiposPago'));
    }
}
