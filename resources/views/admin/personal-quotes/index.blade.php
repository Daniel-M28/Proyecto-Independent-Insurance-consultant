@extends('layouts.app')

@section('content')
<div class="mt-24 max-w-7xl mx-auto p-6 bg-zinc-900 text-gray-100 rounded-lg shadow">

    <h1 class="text-3xl font-bold mb-6 text-center">Personal Requests</h1>

    @if(session('success'))
        <div class="bg-green-600 text-white p-3 rounded mb-4 text-center">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-3 bg-red-600 text-white rounded shadow">{{ session('error') }}</div>
    @endif

    <div class="overflow-x-auto rounded-lg shadow-inner">
        <table class="min-w-full border border-zinc-700 bg-zinc-800 text-center">
            <thead class="bg-zinc-700 text-sm uppercase text-gray-300">
                <tr class="divide-x divide-zinc-600">
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Phone</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Coverage</th>
                    <th class="px-6 py-3">Date</th>
                    <th class="px-6 py-3">Advisor</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-700 text-sm">
                @forelse($quotes as $quote)
                    <tr class="hover:bg-zinc-700 divide-x divide-zinc-600">
                        <td class="px-6 py-4">{{ $quote->id }}</td>
                        <td class="px-6 py-4">{{ $quote->name }} {{ $quote->lastname }}</td>
                        <td class="px-6 py-4">{{ $quote->phone }}</td>
                        <td class="px-6 py-4">{{ $quote->email }}</td>
                        <td class="px-6 py-4">{{ $quote->coverage }}</td>
                        <td class="px-6 py-4">{{ $quote->created_at->timezone('America/Bogota')->format('Y-m-d H:i') }}</td>
                        <td class="px-6 py-4">
                            @if($quote->users->isNotEmpty())
                                {{ $quote->users->first()->name }}
                            @else
                                <span class="text-gray-400">Not assigned</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.personal-quotes.show', $quote->id) }}" class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white rounded-md">View</a>

                               

                                @if(auth()->user()->hasRole('administrador'))
                                    <button onclick="openModal({{ $quote->id }})" class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white rounded-md">Asiggn</button>
                                @endif

                                 @if(auth()->user()->hasRole('administrador'))
                                    <form action="{{ route('admin.personal-quotes.destroy', $quote->id) }}" method="POST"
                                          onsubmit="return confirm('¿Seguro que deseas eliminar esta solicitud?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md">Delete</button>
                                    </form>
                                @endif
                            </div>

                            
                        </td>


                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-400">No requests yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-center">{{ $quotes->links() }}</div>
    <div class="mt-6"><a href="{{ route('dashboard') }}" class="text-gray-400 hover:underline">← Back to dashboard</a></div>
</div>

{{-- Modal asignar asesor --}}
<div id="assignModal" class="fixed inset-0 bg-black bg-opacity-60 hidden items-center justify-center z-50">
    <div class="bg-zinc-800 rounded-lg shadow-lg p-6 w-full max-w-md text-white">
        <h2 class="text-xl font-semibold mb-4">Asiggn advisor</h2>
        <form id="assignForm" method="POST">
            @csrf
            <div class="mb-4">
                <label for="asesor_ids" class="block mb-1 text-sm text-gray-300">Select advisor:</label>
                <select name="asesor_ids[]" id="asesor_ids" class="w-full bg-zinc-700 border border-zinc-600 rounded-md p-2 text-white">
                    <option value="">— Not assigned—</option>
                    @foreach($asesores as $asesor)
                        <option value="{{ $asesor->id }}">{{ $asesor->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded-md text-sm">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-md text-sm">Guardar</button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal(id) {
    const modal = document.getElementById('assignModal');
    const form = document.getElementById('assignForm');
    form.action = "{{ url('admin/personal-quotes') }}/"+id+"/assign";
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}
function closeModal() {
    const modal = document.getElementById('assignModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
@endsection
