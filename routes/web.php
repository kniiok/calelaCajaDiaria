<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FichaDiariaVentaController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// routes/web.php

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('login');
    }
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/usuarios/agregar', function () {
    return view('usuarios/insert');
})->name('usuarios.insert');

Route::get('/usuarios/agregar/confirmar', [UsuarioController::class, 'store'])->name('usuarios.store');


Route::get('/fichadiaria', [FichaDiariaVentaController::class, 'mostrarFichaDiariaHoy'])->name('fichadiaria.hoy');
Route::get('/ventas/create', [FichaDiariaVentaController::class, 'create'])->name('ventas.create');
Route::post('/ventas', [FichaDiariaVentaController::class, 'store'])->name('ventas.store');
Route::get('/ventas/finalizar', [FichaDiariaVentaController::class, 'finalizar'])->name('ventas.finalizar');
Route::post('/ventas', [FichaDiariaVentaController::class, 'finalizarDia'])->name('ventas.finalizarDia');
