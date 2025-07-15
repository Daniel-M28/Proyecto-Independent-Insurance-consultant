@extends('layouts.app')

@section('content')

<h1 class="mt-12 text-3xl font-semibold text-white">Editar usuario</h1>

<div class="bg-zinc-800 rounded-lg shadow-md p-6">
    <div>   
            <div class="bg-zinc-800 p-6 rounded-lg">
    <p class="text-lg font-semibold text-white mb-2">Nombre:</p>
    <p class="bg-zinc-900 p-3 rounded text-white border border-zinc-700">{{ $user->name }}</p>

    <h2 class="text-lg font-semibold text-white mt-6 mb-2">Listado de roles</h2>

    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('PUT')

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

        <button type="submit"
            class="mt-4 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Asignar rol
        </button>
    </form>
</div>

        </p>
    </div>
</div>

@endsection