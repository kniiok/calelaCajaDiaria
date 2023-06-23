<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\User;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->rol->tipoRol != 'Administrador') {

            return redirect()->route('audit.show', ['user' => auth()->user()->id]);
        }
        $users = User::orderBy('nombre', 'asc')->get();
        $user = auth()->user();
        return view('audit.audits', compact('users', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $tiposProducto = TipoProducto::all();]
        //$tiposPago = TipoPago::all();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if ($user) {
            $auditoriasDelUsuario = $user->audits;
            $rol = $user->rol->tipoRol;
            // dd($auditoriasDelUsuario);
            return view('audit.audit', compact('auditoriasDelUsuario', 'user', 'rol'));
        }
        return redirect()->action([AuditController::class, 'index']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Audit $audit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Audit $audit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Audit $audit)
    {
        //
    }
}
