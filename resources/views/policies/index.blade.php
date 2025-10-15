@extends('layouts.app')

@section('content')
<div class="mt-24 flex justify-center mt-10">
    <div class="w-full max-w-5xl bg-zinc-800 p-6 rounded-xl shadow-lg">
        <h1 class="text-2xl font-semibold text-white mb-6 text-center">Policy Management</h1>

        @if(session('success'))
            <div class="bg-green-600 text-white p-3 rounded mb-4 text-center">{{ session('success') }}</div>
        @endif

        {{-- Admin --}}
        @can('admin')
            {{-- Buscador --}}
            <form method="GET" action="{{ route('policies.index') }}" class="flex justify-center flex-1 mb-6">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search user by name or email"
                    class="w-1/2 px-4 py-2 bg-zinc-700 border border-zinc-700 text-white rounded-l-md focus:outline-none placeholder-gray-400" />
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-r-md hover:bg-blue-700">Search</button>
            </form>

            @if(!empty($results))
                <div class="bg-zinc-900 p-4 rounded-lg mb-6">
                    <h2 class="text-white text-lg mb-3">Results:</h2>
                    <ul class="space-y-2">
                        @foreach($results as $r)
                            <li class="flex justify-between items-center bg-zinc-800 p-3 rounded-lg">
                                <div>
                                    <p class="text-white font-semibold">{{ $r->name }}</p>
                                    <p class="text-gray-400 text-sm">{{ $r->email }}</p>
                                </div>
                                <a href="{{ route('policies.index',['user_id'=>$r->id]) }}"
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">See policy</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Subir PDF --}}
            @if($user)
                <form method="POST" action="{{ route('policies.store') }}" enctype="multipart/form-data" onsubmit="return confirmarReemplazo()">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <label class="text-white block mb-2">Upload policy {{ $user->name }} {{$user->lastname}}</label>
                    <input type="file" name="file" accept="application/pdf" required class="block w-full text-white bg-zinc-800 border border-zinc-700 rounded-lg p-2">
                    <button type="submit" class="mt-3 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">Upload policy</button>
                </form>
            @endif
        @endcan

        {{-- Contenedor PDF --}}
        <div id="pdfContainer" class="mt-10">
            @if($policy)
               <iframe src="{{ asset('storage/' . $policy->file_path) }}" class="w-full h-[700px] rounded-lg"></iframe>




                @can('admin')
                    <form method="POST" action="{{ route('policies.destroy',$policy->id) }}" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg"
                                onclick="return confirm('¿Deseas eliminar esta póliza?')">
                            Eliminar Póliza
                        </button>
                    </form>
                @endcan
            @else
                <p class="text-gray-400 text-center mt-10">There is no policy assigned yet.</p>
            @endif
        </div>
    </div>
</div>

<script>
function confirmarReemplazo(){
    @if($policy)
        return confirm('Este usuario ya tiene una póliza. ¿Deseas reemplazarla?');
    @endif
    return true;
}
</script>
@endsection
