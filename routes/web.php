<?php

use App\Http\Controllers\AuditController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FichaDiariaVentaController;
use App\Http\Controllers\IdeasController;
use App\Http\Controllers\StatsController;



Route::redirect('/', '/fichadiaria');


Route::get('/fichadiaria', function () {
    if (auth()->check()) {
        return redirect()->route('fichadiaria.hoy');
    } else {
        return redirect()->route('login');
    }
});

Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::group(['middleware' => ['rol_id:1']], function () {
        Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
        Route::get('/agregarr', [UsuarioController::class, 'store'])->name('usuarios.store');
        Route::get('/auditorias', [AuditController::class, 'index'])->name('audit.index');
        Route::get('/auditorias{user}', [AuditController::class, 'show'])->name('audit.show');
        Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.eliminar');
        Route::get('/agregar', function () {
            return view('usuarios/insert');
        })->name('usuarios.insert');
    });
});
Route::get('/auditoriausuario{user}', [AuditController::class, 'show'])->name('audit.user');
Route::get('/fichadiaria', [FichaDiariaVentaController::class, 'mostrarFichaDiariaHoy'])->name('fichadiaria.hoy');
Route::get('/create', [FichaDiariaVentaController::class, 'create'])->name('ventas.create');
Route::post('/ventas', [FichaDiariaVentaController::class, 'store'])->name('ventas.store');
Route::get('/finalizar', [FichaDiariaVentaController::class, 'finalizar'])->name('ventas.finalizar');
Route::post('/listo', [FichaDiariaVentaController::class, 'finalizarDia'])->name('ventas.finalizarDia');
Route::delete('/ventas/{venta}', [FichaDiariaVentaController::class, 'destroy'])->name('ventas.destroy');
Route::get(('/buscar'), function (){
    return view('buscarFicha.index');})->name('fichas.buscar');
    Route::get('/stats', [StatsController::class, 'showStats'])->name('stats');
    Route::get('/buscada', [FichaDiariaVentaController::class, 'buscar'])->name('fichas.buscada');
Route::get('/ideas', [IdeasController::class, 'show'])->name('ideas.index');
Route::post('/ideas/store', [IdeasController::class, 'store'])->name('ideas.store');
Route::delete('/ideas/{id}', [IdeasController::class, 'destroy'])->name('ideas.destroy');
Route::get('/realizar-respaldo', function () {
    $command = 'start /MIN cmd.exe /C "C:\xampp\mysql\bin\mysqldump.exe -u root calela > D:\OneDrive\Escritorio\database.sql"';
    pclose(popen($command, 'r'));
    
    return Redirect(route('fichadiaria.hoy'));
});