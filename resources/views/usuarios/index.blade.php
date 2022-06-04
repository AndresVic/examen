<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('create.usuario') }}" class="btn btn-success btn-sm">Agregar Nuevo Usuario</a>
                    <table class="table mt-4">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">RFC</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Direccion</th>
                                <th scope="col" colspan="2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($usuarios as $usuario)
                            <tr>
                                <th scope="row">{{ $usuario->id }}</th>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->rfc }}</td>
                                <td>{{ $usuario->telefono }}</td>
                                <td>{{ $usuario->direccion }}</td>
                                <td><a href="{{ route('edit.usuario', ['id' => $usuario->id]) }}" type="button" class="btn btn-outline-warning btn-sm mr-1 d-block mb-2 btn-block">Editar</a></td>
                                <td>
                                    <form action="{{ route('destroy.usuario', $usuario->id) }}" method ="POST" >
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <input class="btn btn-outline-danger btn-sm mr-1 d-block mb-2 btn-block" type="submit" value="Eliminar" onclick="return EliminarRegistro('Eliminar Profesor')">
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <div class="col-12">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-lg justify-content-center bg-white mb-0" style="padding: 30px;">
                                        <p class="mt-4 font-weight-bold">
                                            ¡Aún no hay publicaciones! <i class="far fa-sad-tear"></i>
                                        </p>
                                    </ul>
                                </nav>
                            </div>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
