@extends('layouts.app')
@section('content')

<header class="ml-4 pl-4">
    <h1 class="m-auto p-auto text-xl text-center">Auditorias lista de usuarios registrados</h1>
    <p><strong>Rol:</strong> {{$user->rol->tipoRol}}<br>
        <strong>Email:</strong> {{$user->email}} <br>
        <strong>Estado:</strong>@if ($user->estadoUsuario == 1)
            <span class="text-green-700 ">Activo</span>
        @else
        <span class="text-red-600">Inactivo</span>
        @endif
        <br>
    </p>
</header>
<div class="py-12" >
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class=" bg-white overflow-hidden shadow-xl sm:rounded-lg ">
            <table class="m-auto p-auto w-full border-solid border bg-white text-center ">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border-b border-gray-200">Rol</th>
                        <th class="py-2 px-4 border-b border-gray-200">Nombre usuario</th>
                        <th class="py-2 px-4 border-b border-gray-200">Email</th>
                        <th class="py-2 px-4 border-b border-gray-200">Fecha Alta</th>
                        <th class="py-2 px-4 border-b border-gray-200">Estado</th>
                        <th class="py-2 px-4 border-b border-gray-200"></th>

                        <!-- Otros campos de usuario que deseas mostrar -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $user->rol->tipoRol }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $user->name}}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $user->email}}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $user->created_at->format('d/m/Y H:i:s')}}</td>
                            <td class="py-2 px-4 border-b border-gray-200">@if ($user->estadoUsuario == 1)
                                <span class="text-green-700 ">Activo</span>
                            @else
                            <span class="text-red-600">Inactivo</span>
                            @endif</td>
                            
                            <td class="py-2 px-4 border-b border-gray-200"> <a class="text-blue-500" href="{{route('audit.show', $user->id)}}">
                            Más -></a></td>
                            <!-- Otros campos de usuario que deseas mostrar -->
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection