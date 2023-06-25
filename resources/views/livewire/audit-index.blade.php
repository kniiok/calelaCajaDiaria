   <div>
    <header>
        <h1 class="m-4 text-xl">Auditorias lista de usuarios registrados</h1>
    </header>
    <div class="mt-2">
        <input wire:model="search" id="search" name="search" type="text" placeholder=" Ingrese un dato: Nombre, rol, mail o fecha a buscar"
            class="ml-10 mb-4 block w-full rounded-md border-0 p-3 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
    </div>
    @if ($users->count())
    <div class="flex justify-center">
        
        <table class="ml-20  min-w-full border border-gray-300">
          <thead>
                <tr class=" bg-blue-200">
                    <th class="py-2 px-4 border-b border-gray-200">Rol</th>
                    <th class="py-2 px-4 border-b border-gray-200">Nombre usuario</th>
                    <th class="py-2 px-4 border-b border-gray-200">Email</th>
                    <th class="py-2 px-4 border-b border-gray-200">Fecha Alta</th>
                    <th class="py-2 px-4 border-b border-gray-200">Estado</th>
                    <th class="py-2 px-4 border-b border-gray-200"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $user->rol->tipoRol }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->nombre}}</td>
                    <td class="py-2 px-4 border-b">{{ $user->email}}</td>
                    <td class="py-2 px-4 border-b">{{ $user->created_at->format('d/m/Y H:i:s')}}</td>
                    <td class="py-2 px-4 border-b">@if ($user->estadoUsuario == 1)
                        <span class="text-green-700 ">Activo</span>
                    @else
                    <span class="text-red-600">Inactivo</span>
                    @endif</td>
                    
                    <td width='10px'> <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="{{route('audit.show', $user->id)}}">
                    Auditar</a></td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    @else
    <div class="text-center">
        <strong>No hay registros</strong>
    </div> 
    @endif
</div>

