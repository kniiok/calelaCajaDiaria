@extends('layouts.app')
@section('content')

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Usuarios') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <table class="w-full border-solid border bg-white">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border-b border-gray-200">ID</th>
                        <th class="py-2 px-4 border-b border-gray-200">Nombre</th>
                        <th class="py-2 px-4 border-b border-gray-200"></th>
                        <!-- Otros campos de usuario que deseas mostrar -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200" style="text-align: center;">{{ $user->id }}</td>
                            <td class="py-2 px-4 border-b border-gray-200" style="text-align: center;">{{ $user->name }}</td>
                            <td class="py-2 px-4 border-b border-gray-200" style="text-align: center;">
                                <form action="{{ route('usuarios.eliminar', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ml-2 bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Eliminar usuario</button>
                                </form>
                            </td>
                            <!-- Otros campos de usuario que deseas mostrar -->
                        </tr>
                    @endforeach
                    <tr class="bg-gray-200">
                        <td colspan="3" class="py-2 px-4 border-b border-gray-200">
                            <div align="center">
                                <a href="/usuarios/agregar" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Agregar usuario</a>
                                </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection