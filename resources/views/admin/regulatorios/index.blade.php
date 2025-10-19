@extends('layouts.app')

@section('content')

<div class="mt-24 max-w-7xl mx-auto p-6 bg-zinc-900 text-gray-100 rounded-lg shadow">
    <h1 class="text-3xl font-bold mb-6 text-center">Regulatory Requests</h1>


    @if(session('success'))
            <div class="bg-green-600 text-white p-3 rounded mb-4 text-center">{{ session('success') }}</div>
        @endif

        
    {{-- Mensaje de error --}}


    @if(session('error'))
        <div class="mb-4 p-3 bg-red-600 text-white rounded shadow">
            {{ session('error') }}
        </div>
    @endif

    {{-- Tabla siempre visible --}}
    <div class="overflow-x-auto rounded-lg shadow-inner">
        <table class="min-w-full border border-zinc-700 bg-zinc-800 text-center">
            <thead class="bg-zinc-700 text-sm uppercase text-gray-300">
                <tr class="divide-x divide-zinc-600">
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Lastname</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Phone</th>
                    <th class="px-6 py-3">Observations</th>
                    <th class="px-6 py-3">Date</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-700 text-sm">
                @forelse($regulatorios as $item)
                    <tr class="hover:bg-zinc-700 divide-x divide-zinc-600">
                        <td class="px-6 py-4">{{ $item->id }}</td>
                        <td class="px-6 py-4">{{ $item->name }}</td>
                        <td class="px-6 py-4">{{ $item->last_name }}</td>
                        <td class="px-6 py-4">{{ $item->email }}</td>
                        <td class="px-6 py-4">{{ $item->phone_number }}</td>
                        <td class="px-6 py-4 max-w-xs truncate" title="{{ $item->observations }}">
                            {{ $item->observations ?? '—' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($item->created_at)->timezone('America/Bogota')->format('d/m/Y H:i') }}
                        </td>

                        <td class="px-6 py-4 flex justify-center">
                            {{-- Botón Eliminar solo visible para administrador --}}
                            @if(auth()->user()->hasRole('administrador'))
                                <form action="{{ route('regulatorios.destroy', $item->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this request?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    {{-- Fila vacía cuando no hay registros --}}
                    <tr>
                        <td colspan="8" class="px-6 py-6 text-gray-400 ">
                            No request found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-6 flex justify-center">
        {{ $regulatorios->links() }}
    </div>
</div>

{{-- Botón back --}}
<div class="mt-6">
    <a href="{{ route('dashboard') }}" class="text-gray-400 hover:underline">← Back to Dashboard</a>
</div>

@endsection
