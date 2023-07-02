@extends('layouts.app')

@section('content')

<head>
    <link href="css/animate.min.css" rel="stylesheet">
    <link href='css/sweetalert2.all.min.css' rel="stylesheet">
</head>

<div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm animate__animated animate__fadeIn">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900 animate__animated animate__fadeIn">Nuevo Usuario</h2>
    </div>
    <form action="{{ route('usuarios.store') }}" method="get" class="animate__animated animate__fadeIn" id="user-form">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nombre:</label>
            <div class="mt-2">
                <input id="text" name="name" type="name" autocomplete="name" required
                    class="block w-full rounded-md border-0 p-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 animate__animated animate__fadeIn">
            </div>
        </div>
        <div>
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email:</label>
            <div class="mt-2">
                <input id="email" name="email" type="email" autocomplete="email" required
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 animate__animated animate__fadeIn">
            </div>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Contraseña:</label>
            <div class="mt-2">
                <input id="password" name="password" type="password" autocomplete="current-password" required
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 animate__animated animate__fadeIn">
            </div>
        </div>
        <div>
            <label for="rolUsuario" class="block text-sm font-medium leading-6 text-gray-900">Rol de usuario:</label>
            <div class="m-auto inline-flex">
                <input type="radio" id="rolUsuario" name="rolUsuario" value="1"
                    class="form-radio h-4 w-4 text-indigo-600 m-auto p-2 animate__animated animate__fadeIn">
                <label for="administrador"
                    class="m-auto p-2  text-sm font-medium leading-6 text-gray-900 animate__animated animate__fadeIn">Administrador</label><br>
                <input type="radio" id="rolUsuario" name="rolUsuario" value="2"
                    class="form-radio h-4 w-4 text-indigo-600 m-auto p-2 animate__animated animate__fadeIn">
                <label for="vendedor" class="m-auto p-2  text-sm font-medium leading-6 text-gray-900 animate__animated animate__fadeIn">Vendedor</label>
            </div>
        </div>
        <br>
        <div>
            <button type="submit"
                class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 animate__animated animate__fadeIn">Agregar
                Usuario</button>
        </div>
    </form>
</div>
<script src='js/sweetalert2.all.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const userForm = document.getElementById('user-form');

        userForm.addEventListener('submit', function (event) {
            event.preventDefault();
            // Mostrar el mensaje de confirmación
            Swal.fire({
                title: 'Usuario agregado correctamente',
                text: 'Se redirigirá a Usuarios.',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            }).then((result) => {
                userForm.submit();
            });
        });
    });
</script>
@endsection
