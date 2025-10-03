@extends('layouts.app')

@section('content')
<div class="p-6 max-w-7xl mx-auto mt-24 text-white space-y-6">
    <h1 class="text-3xl font-bold mb-6">Company Request #{{ $company->id }}</h1>

    <!-- Contenedor flex para listas lado a lado -->
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Lista 1: Datos del propietario -->
        <div class="bg-zinc-800 p-6 rounded-lg shadow flex-1">
            <h2 class="text-xl font-semibold mb-4">Owner Information</h2>
            <ul class="space-y-1">
                <li><strong>Name:</strong> {{ $company->owner_first_name }} {{ $company->owner_last_name }}</li>
                <li><strong>SSN:</strong> {{ $company->ssn }}</li>
                <li><strong>Phone:</strong> {{ $company->phone }}</li>
                <li><strong>Email:</strong> {{ $company->email }}</li>
                <li><strong>Date of Birth:</strong> {{ $company->dob }}</li>
            </ul>
        </div>

        <!-- Lista 2: Detalles de la empresa / solicitud -->
        <div class="bg-zinc-800 p-6 rounded-lg shadow flex-1">
            <h2 class="text-xl font-semibold mb-4">Company / Request Details</h2>
            <ul class="space-y-1">
                <li><strong>Company Names:</strong> {{ $company->company_name_1 }}, {{ $company->company_name_2 }}, {{ $company->company_name_3 }}</li>
                <li><strong>Business Address:</strong> {{ $company->business_address }}</li>
                <li><strong>Cargo Type:</strong> {{ $company->cargo_type }}</li>
                <li><strong>Operation Type:</strong> {{ $company->operation_type }}</li>
                <li><strong>Vehicle Type:</strong> {{ $company->vehicle_type }}</li>
                <li><strong>Observations:</strong> {{ $company->observations ?? 'N/A' }}</li>
            </ul>
        </div>
    </div>

    <!-- Licencias / Documentos -->
    <div class="bg-zinc-800 p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-4">Licenses / Documents</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @if(!empty($company->licenses) && count($company->licenses) > 0)
                @foreach($company->licenses as $file)
                    @if(Str::endsWith($file, ['jpg','jpeg','png']))
                        <img 
                            src="{{ asset('storage/' . $file) }}" 
                            class="w-full h-48 object-cover rounded shadow cursor-pointer" 
                            onclick="openModal('{{ asset('storage/' . $file) }}')"
                        >
                    @else
                        <a href="{{ asset('storage/' . $file) }}" target="_blank" class="text-blue-400 underline break-all">
                            {{ basename($file) }}
                        </a>
                    @endif
                @endforeach
            @else
                <p>No files uploaded.</p>
            @endif
        </div>
    </div>

    <!-- Botón back -->
    <div class="mt-6">
        <a href="{{ route('admin.new-company.index') }}" class="text-gray-400 hover:underline">← Back to list</a>
    </div>
</div>

<!-- Modal para imágenes -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center hidden z-50">
    <span class="absolute top-4 right-6 text-white text-3xl cursor-pointer" onclick="closeModal()">&times;</span>
    <img id="modalImage" src="" class="max-h-[90vh] max-w-[90vw] rounded shadow-lg">
</div>

<script>
    function openModal(src) {
        const modal = document.getElementById('imageModal');
        const modalImg = document.getElementById('modalImage');
        modalImg.src = src;
        modal.classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }

    // Cerrar modal al hacer clic fuera de la imagen
    document.getElementById('imageModal').addEventListener('click', function(e) {
        if(e.target.id === 'imageModal') closeModal();
    });
</script>
@endsection
