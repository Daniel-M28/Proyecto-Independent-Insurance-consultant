@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 mt-12 text-gray-100 bg-zinc-900 rounded-lg py-6 shadow-lg">
    <h2 class="mb-6 text-3xl font-semibold text-center">Lista de Usuarios</h2>

    {{-- Buscador --}}
    <form method="GET" action="{{ route('admin.users.index') }}" class="mb-6 flex justify-center">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Buscar por nombre o apellido"
            class="w-1/2 px-4 py-2 bg-zinc-800 border border-zinc-700 text-white rounded-l-md focus:outline-none  focus:ring-blue-500 placeholder-gray-400"
        />
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-r-md hover:bg-blue-700">
            Buscar
        </button>
    </form>

    {{-- Tabla --}}
    <div class="overflow-x-auto rounded-lg shadow-inner">
        <table class="min-w-full border border-zinc-700 bg-zinc-800 text-center">
            <thead class="bg-zinc-700 text-sm uppercase text-gray-300">
                <tr class="divide-x divide-zinc-600">
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Nombre</th>
                    <th class="px-6 py-3">Apellido</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Fecha de registro</th>
                    <th class="px-6 py-3">Rol</th>
                    <th class="px-6 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-700 text-sm">
                @forelse($users as $user)
                    <tr class="hover:bg-zinc-700 divide-x divide-zinc-600">
                        <td class="px-6 py-4">{{ $user->id }}</td>
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->lastname }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">{{ $user->created_at->format('d-m-Y') }}</td>
                        <td class="px-6 py-4">{{ $user->roles->first()?->name ?? 'Sin rol' }}</td>
                        <td class="px-6 py-4 flex justify-center gap-2">
                            {{-- Botón Editar --}}
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                               class="inline-block px-4 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 h-10 flex items-center justify-center">
                                Editar
                            </a>

                            {{-- Botón Eliminar --}}
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                  onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-4 py-1 bg-red-600 text-white rounded hover:bg-red-700 h-10 flex items-center justify-center">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-400">No hay usuarios registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-6 flex justify-center pagination">
        {{ $users->links() }}
    </div>

</div>

<!-- Botón back -->
<div class="mt-6">
    <a href="{{ route('dashboard') }}" class="text-gray-400 hover:underline">← Back to list</a>
</div>
@endsection
