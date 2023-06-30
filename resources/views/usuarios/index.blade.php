@extends('layouts.app')
@section('content')

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight animate__animated animate__fadeIn">
        {{ __('Usuarios') }}
    </h2>
</x-slot>

<head>
    <link href="css/animate.min.css" rel="stylesheet">
</head>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg animate__animated animate__fadeIn">
            <table class="w-full border-solid border bg-white animate__animated animate__fadeIn">
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
                                @if ($user->id !== auth()->user()->id)
                                    <form action="{{ route('usuarios.eliminar', $user->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar al usuario {{$user->id}}: {{$user->name}}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="ml-2 bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded animate__animated animate__fadeIn">Eliminar usuario</button>
                                    </form>
                                @endif
                            </td>
                            <!-- Otros campos de usuario que deseas mostrar -->
                        </tr>
                    @endforeach
                    <tr class="bg-gray-200">
                        <td colspan="3" class="py-2 px-4 border-b border-gray-200">
                            <div align="center">
                                <a href="/agregar" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded animate__animated animate__fadeIn">Agregar usuario</a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
