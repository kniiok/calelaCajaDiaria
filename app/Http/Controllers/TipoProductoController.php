<?php

namespace App\Http\Controllers;

use App\Models\TipoProducto;

class TipoProductoController extends Controller
{
    public function index()
    {
        $tiposProducto = TipoProducto::all();
        return view('tiposproducto.index', compact('tiposProducto'));
    }
}
