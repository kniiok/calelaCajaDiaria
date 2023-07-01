<head>
    <link href="css/animate.min.css" rel="stylesheet">
</head>

<div class="animate__animated animate__fadeIn">
    {{-- datos del usuario a auditar --}}
    <header class="ml-4 pl-4">
        <h1 class="m-auto p-auto text-xl text-center">Auditorias de usuario {{ $user->nombre }}</h1>
        <p><strong>Rol:</strong> {{ $rol }}<br>
            <strong>Email:</strong> {{ $user->email }} <br>
            <br>
        </p>
    </header>
    <div class="mt-2">
        <input wire:model="search" id="search" name="search" type="text" placeholder="Filtrar por: operación o fecha" class="ml-10 mb-4 block w-full rounded-md border-0 p-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
    </div>
    @if ($auditoriasDelUsuario->count())
        <div class="flex justify-center">
            <table class="ml-20 min-w-full border border-gray-300">
                <thead>
                    <tr class="bg-blue-200">
                        <th class="py-2 px-4 border-b border-gray-200">Fecha Realizada</th>
                        <th class="py-2 px-4 border-b border-gray-200">Operación</th>
                        <!-- Otros campos de auditoría que deseas mostrar -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($auditoriasDelUsuario as $auditoria)
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200" style="text-align: center;">{{ date('d/m/Y', strtotime($auditoria->fecha)) }}</td>
                            <td class="py-2 px-4 border-b border-gray-200" style="text-align: center;">{{ $auditoria->operacion }}</td>
                            <!-- Otros campos de auditoría que deseas mostrar -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- paginación --}}
        <div class="flex items-center justify-center mt-4">
            <div class="flex">
                {{ $auditoriasDelUsuario->links('pagination::tailwind') }}
            </div>
        </div>
    @else
        <div class="text-center">
            <strong>No hay registros</strong>
        </div>
    @endif
</div>
