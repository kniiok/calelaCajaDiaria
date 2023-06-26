<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()){
        if (auth()->user()->rol->tipoRol != 'Administrador') {

            return redirect()->route('audit.show', ['user' => auth()->user()]);
        }
        $users = User::orderBy('name', 'asc')->get();
        $user = auth()->user();
        return view('audit.audits', compact('users', 'user'));
        // return view('audit.audits');
    }
    return abort(403, 'Acceso no autorizado');
}

    /**
     * Show the form for creating a new resource.
     */
    public function create($operacion)
    {
        $audit = [
            'operacion' => $operacion,
            'user_id'=> auth()->user()->id,
            'fecha'=> Carbon::now()
        ];
        DB::table('audits')->insert($audit);
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
        if(auth()->user()){
        if ($user && auth()->user()->rol->tipoRol == 'Administrador') {

         return view('audit.audit', compact( 'user'));

        }else if(auth()->user()->id == $user->id){
            
            return view('audit.audit', compact( 'user'));
        
        }
    }
            return abort(403, 'Acceso no autorizado');
        
        // return redirect()->route('audit.show', ['user' => auth()->user()]);
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
