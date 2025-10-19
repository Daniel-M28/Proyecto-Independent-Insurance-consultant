@extends('layouts.app')

@section('content')
<div class="container mt-24 mx-auto px-4 py-8">

    <h1 class="text-3xl font-bold mb-6 text-center text-white">Factoring Requests</h1>

 @if(session('success'))
            <div class="bg-green-600 text-white p-3 rounded mb-4 text-center">{{ session('success') }}</div>
        @endif



   @if(session('error'))
    <div class="mb-4 p-3 bg-red-600 text-white rounded shadow">
        {{ session('error') }}
    </div>
@endif
    <!-- Tabla -->
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
                @forelse ($requests as $request)
                    <tr class="hover:bg-zinc-700 divide-x divide-zinc-600">
                        <td class="px-6 py-4">{{ $request->id }}</td>
                        <td class="px-6 py-4">{{ $request->name }}</td>
                        <td class="px-6 py-4">{{ $request->last_name }}</td>
                        <td class="px-6 py-4">{{ $request->email }}</td>
                        <td class="px-6 py-4">{{ $request->phone_number }}</td>

                        <td class="px-6 py-4 max-w-xs truncate" title="{{ $request->observations }}">
                            {{ \Illuminate\Support\Str::limit($request->observations, 20, '...') }}
                        </td>

                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($request->created_at)->format('Y-m-d H:i') }}</td>

                        <td class="px-6 py-4 flex justify-center">
    @can('admin')
        {{-- Botón de eliminar --}}
        <form action="{{ route('factorings.destroy', $request->id) }}" method="POST" 
              onsubmit="return confirm('¿Seguro que quieres eliminar esta solicitud?');">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md">
                Eliminar
            </button>
        </form>
    @endcan
</td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-400">
                            No requests found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="mt-6 flex justify-center">
            {{ $requests->links() }}
        </div>
    </div>

    <!-- Botón back -->
    <div class="mt-6">
        <a href="{{ route('dashboard') }}" class="text-gray-400 hover:underline">← Back to dashboard</a>
    </div>
</div>
@endsection
