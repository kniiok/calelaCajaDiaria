<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
        // Validar los datos del formulario si es necesario

        $userData = [
            'nombre' => $request->input('nombre'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'rolUsuario' => $request->input('rolUsuario'),
            'estadoUsuario' => $request->input('estadoUsuario'),
        ];

        // Insertar el usuario en la base de datos
        DB::table('users')->insert($userData);

        // Redireccionar o enviar una respuesta JSON según tus necesidades
        return redirect()->back()->with('success', 'Usuario agregado correctamente');
    }
}
