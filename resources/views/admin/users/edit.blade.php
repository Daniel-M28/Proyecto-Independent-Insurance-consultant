@extends('layouts.app')

@section('content')
<h1 class="mt-12 text-3xl font-semibold text-white">Editar usuario</h1>

<div class="bg-zinc-800 rounded-lg shadow-md p-6">
    <div class="bg-zinc-800 p-6 rounded-lg">

        <!-- Formulario de edición -->
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')

            <!-- Nombre -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-white">Nombre</label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name', $user->name) }}"
                    class="mt-1 block w-full bg-zinc-900 border border-zinc-700 text-white rounded-md shadow-sm focus:ring-indigo-500"
                >
                @error('name')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Apellido (opcional si lo manejas en tu modelo) -->
            <div class="mb-4">
                <label for="lastname" class="block text-sm font-medium text-white">Apellido</label>
                <input
                    id="lastname"
                    name="lastname"
                    type="text"
                    value="{{ old('lastname', $user->lastname) }}"
                    class="mt-1 block w-full bg-zinc-900 border border-zinc-700 text-white rounded-md shadow-sm focus:ring-indigo-500"
                >
                @error('lastname')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Listado de roles -->
            <h2 class="text-lg font-semibold text-white mt-6 mb-2">Listado de roles</h2>
            <div class="grid gap-2">
                @foreach ($roles as $role)
                    <label class="inline-flex items-center text-white">
                        <input
                            type="checkbox"
                            name="roles[]"
                            value="{{ $role->id }}"
                            class="mr-2 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            {{ $user->roles->contains($role->id) ? 'checked' : '' }}
                        >
                        {{ $role->name }}
                    </label>
                @endforeach
            </div>

            <!-- Botón -->
            <button type="submit"
                class="mt-6 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Guardar cambios
            </button>
        </form>
    </div>
</div>
@endsection
