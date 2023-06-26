<?php

namespace App\Http\Controllers;
use App\Models\Audit;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class UsuarioController extends Controller
{
    public function index()
{
    $users = User::all();
    // dd($users);

    return view('usuarios.index', compact('users'));
}
public function store(Request $request)
    {
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        // Validar los datos del formulario si es necesario

        $userData = [
            'nombre' => $request->input('nombre'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'rol_id' => $request->input('rolUsuario'),
            'estadoUsuario' => $request->input('estadoUsuario'),
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ];
     
        //carga una actividad realizada por el usuario
        $audit = new AuditController();
        $operacion = 'Alta al usuario '.$userData['nombre'].';  -- '. Carbon::now()->format('H:i');
        $audit->create($operacion);
        // Insertar el usuario en la base de datos
        DB::table('users')->insert($userData);
        // Redireccionar o enviar una respuesta JSON según tus necesidades
        return redirect()->back()->with('success', 'Usuario agregado correctamente');
    }
}
