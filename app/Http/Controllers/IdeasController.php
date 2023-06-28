<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeasController extends Controller
{
    public function show()
{
    $user = auth()->user();
    $ideas = Idea::where('idUsuario', $user->id)->paginate(5);
    return view('ideas.index', compact('ideas'));
}
public function store(Request $request)
{
    $user = auth()->user();

    $idea = new Idea();
    $idea->idUsuario = $user->id;
    $idea->descripcion = $request->input('descripcion');
    $idea->fecha = now();
    $idea->save();

    return redirect()->route('ideas.index')->with('success', 'La idea se ha guardado correctamente.');
}
public function destroy($id)
    {
        // Buscar la idea por su ID
        $idea = Idea::find($id);

        // Verificar si la idea existe
        if (!$idea) {
            return redirect()->back()->with('error', 'La idea no existe.');
        }

        // Eliminar la idea
        $idea->delete();

        return redirect()->back()->with('success', 'La idea ha sido eliminada correctamente.');
    }
}
