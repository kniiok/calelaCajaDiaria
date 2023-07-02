@extends('layouts.app')
@section('content')

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight animate__animated animate__fadeIn">
        {{ __('Usuarios') }}
    </h2>
</x-slot>

<head>
    <link href="css/animate.min.css" rel="stylesheet">
    <link href='css/sweetalert2.all.min.css' rel="stylesheet">
</head>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg animate__animated animate__fadeIn">
            <table class="w-full border-solid border bg-white animate__animated animate__fadeIn">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border-b border-gray-200 text-left">Nombre</th>
                        <th class="py-2 px-4 border-b border-gray-200 text-left">E-mail</th>
                        <th class="py-2 px-4 border-b border-gray-200 text-left">Rol</th>
                        <th class="py-2 px-4 border-b border-gray-200 text-center">Eliminar</th>
                        <!-- Otros campos de usuario que deseas mostrar -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200 text-left">{{ $user->name }}</td>
                            <td class="py-2 px-4 border-b border-gray-200 text-left">{{ $user->email }}</td>
                            <td class="py-2 px-4 border-b border-gray-200 text-left">{{ $user->rol->tipoRol }}</td>
                            <td class="py-2 px-4 border-b border-gray-200 text-center">
                                @if ($user->id !== auth()->user()->id)
                                    <form action="{{ route('usuarios.eliminar', $user->id) }}" method="POST" id="eliminarForm{{ $user->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="confirmarEliminacion({{ $user->id }})">X</button>
                                    </form>
                                @endif
                            </td>
                            
                            <!-- Otros campos de usuario que deseas mostrar -->
                        </tr>
                    @endforeach
                    <tr class="bg-gray-200">
                        <td colspan="4" class="py-2 px-4 border-b border-gray-200">
                            <div align="center">
                                <a href="/agregar" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded animate__animated animate__fadeIn">Agregar usuario</a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function confirmarEliminacion(userId) {
            Swal.fire({
                title: '¿Realmente desea eliminar al usuario?',
                text: "Esta acción es irreversible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                document.getElementById('eliminarForm' + userId).submit();

                // Mostrar confirmación de eliminación
                Swal.fire({
                    title: 'Usuario eliminado',
                    text: 'El usuario ha sido eliminado exitosamente.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
    }
</script>
        <script src='js/sweetalert2.all.min.js'></script>

</div>

@endsection
