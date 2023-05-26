@extends('layouts.app')
@section('content')
<div align="center">
<form action="{{ route('usuarios.store') }}" method="get">
    @csrf
    <br><br>
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" required><br><br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required><br><br>

    <label for="password">Contraseña:</label>
    <input type="password" name="password" id="password" required><br><br>

    <label for="rolUsuario">Rol de usuario:</label><br>
    {{-- <div class="flex items-center"> --}}
        <input type="radio" id="rolUsuario" name="rolUsuario" value="1" class="form-radio h-4 w-4 text-indigo-600">
        <label for="administrador" class="ml-2">Administrador</label><br>
      {{-- </div> --}}
      {{-- <div class="flex items-center"> --}}
        <input type="radio" id="rolUsuario" name="rolUsuario" value="2" class="form-radio h-4 w-4 text-indigo-600">
        <label for="vendedor" class="ml-2">Vendedor</label>
      {{-- </div> --}}
      

    <label for="password">Estado del usuario:</label><br><br>
    {{-- <div class="flex items-center"> --}}
        <input type="radio" id="estadoUsuario" name="estadoUsuario" value="1" class="form-radio h-4 w-4 text-indigo-600">
        <label for="activo" class="ml-2">Activo</label><br>
      {{-- </div> --}}
      {{-- <div class="flex items-center"> --}}
        <input type="radio" id="estadoUsuario" name="estadoUsuario" value="2" class="form-radio h-4 w-4 text-indigo-600">
        <label for="inactivo" class="ml-2">Inactivo</label><br><br>
      {{-- </div> --}}
      
    <button type="submit">Agregar Usuario</button>
</form>
</div>
@endsection