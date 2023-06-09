@extends('layouts.app')
@section('content')
<head>
    <link href="css/animate.min.css" rel="stylesheet">
    <link href='css/sweetalert2.all.min.css' rel="stylesheet">
</head>
<div class="mt-10 sm:mx-auto sm:w-1/2 sm:max-w-md animate__animated animate__fadeIn">
    <form action="{{ route('ideas.store') }}" method="POST">
        @csrf

        <div class="text-center">
            <h2 class="mt-10 text-2xl font-bold leading-9 tracking-tight text-gray-900 animate__animated animate__fadeIn">Nueva Idea</h2>
        </div>

        <div class="mt-4">
            <label for="descripcion" class="block text-sm font-medium leading-6 text-gray-900">¿Cuál es tu idea?</label>
            <div class="mt-2">
                <textarea name="descripcion" id="descripcion" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 animate__animated animate__fadeIn" rows="3" required></textarea>
            </div>
        </div>

        <div class="mt-6 text-center">
            <button type="submit" class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 animate__animated animate__fadeIn">Guardar</button>
        </div>
    </form>
</div>


<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg animate__animated animate__fadeIn">
            <table class="w-full border-solid border bg-white animate__animated animate__fadeIn">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="py-2 px-4 border-b border-gray-200 text-left">Idea</th>
                        <th class="py-2 px-4 border-b border-gray-200 text-right">Fecha</th>
                        <th class="py-2 px-4 border-b border-gray-200 text-right">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!$ideas->isEmpty())
                    @foreach ($ideas as $idea)
        <tr>
            <td class="py-2 px-4 border-b border-gray-200 text-left">{{ $idea->descripcion }}</td>
            <td class="py-2 px-4 border-b border-gray-200 text-right">{{ date('d/m/Y', strtotime($idea->fecha)) }}</td>
            <td class="py-2 px-4 border-b border-gray-200 text-right">
                <form action="{{ route('ideas.destroy', $idea->id) }}" method="post" class="delete-idea-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded delete-idea-btn">
                        X
                    </button>
                </form>                
            </td>
        </tr>
        @endforeach
                    @else
                    <tr>
                        <td colspan="2" class="py-2 px-4 border-b border-gray-200 text-left">No hay ideas</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

{{ $ideas->links() }}

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteForms = document.querySelectorAll('.delete-idea-form');

        deleteForms.forEach(function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                Swal.fire({
                    title: '¿Realmente deseas eliminar esta idea?',
                    text: 'Esta acción es irreversible.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.target.submit();
                        // Mostrar confirmación de eliminación
                Swal.fire({
                    title: 'Idea eliminada',
                    text: 'La idea ha sido eliminada exitosamente.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                });
                    }
                });
            });
        });
    });
</script>
<script src='js/sweetalert2.all.min.js'></script>
@endsection