@extends('layouts.app')

@section('content')
<div class="mt-24 flex justify-center mt-10">
    <div class="w-full max-w-5xl bg-[#1e1e1e] p-6 rounded-xl shadow-lg">
        <h1 class="text-2xl font-semibold text-white mb-6 text-center">Management of Insurance Certificates</h1>

         @if(session('success'))
            <div class="bg-green-600 text-white p-3 rounded mb-4 text-center">{{ session('success') }}</div>
        @endif
            @if(session('error'))
                <div class="bg-red-600 text-white p-3 rounded mb-4 text-center">{{ session('error') }}</div>    
            @endif   


     {{-- Admin y Asesor --}}
@if(auth()->user()->hasRole('administrador') || auth()->user()->hasRole('asesor'))
    {{-- Buscador --}}
    <form method="GET" action="{{ route('certificados.index') }}" class="flex justify-center flex-1 mb-6">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search user by name or email"
            class="w-1/2 px-4 py-2 bg-zinc-700 border border-zinc-700 text-white rounded-l-md focus:outline-none placeholder-gray-400" />
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-r-md hover:bg-blue-700">Search</button>
    </form>

  @if(!empty($results))
    <div class="bg-zinc-900 p-4 rounded-lg mb-6">
        <h2 class="text-white text-lg mb-3">Results:</h2>

        @if(count($results) > 0)
            <ul class="space-y-2">
                @foreach($results as $r)
                    <li class="flex justify-between items-center bg-zinc-800 p-3 rounded-lg">
                        <div>
                            <p class="text-white font-semibold">{{ $r->name }}</p>
                            <p class="text-gray-400 text-sm">{{ $r->email }}</p>
                        </div>
                        <a href="{{ route('certificados.index', ['user_id' => $r->id]) }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                            See Certificate
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-400 text-center mt-2">User not found.</p>
        @endif
    </div>
@endif


    {{-- Subir PDF --}}
    @if($user)
        <form method="POST" action="{{ route('certificados.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <label class="text-white block mb-2">Upload certificate for {{ $user->name }} {{$user->lastname}} </label>
            <input type="file" name="file" accept="application/pdf" required
                class="block w-full text-white bg-zinc-800 border border-zinc-700 rounded-lg p-2">
            <button type="submit"
                class="mt-3 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">Upload Certificate</button>
        </form>
    @endif
@endif

<!-- Modal centralizado de envío -->
<div id="sendingModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-blue-600 text-white px-8 py-6 rounded-lg shadow-lg flex items-center space-x-4 w-96">
        <!-- Spinner -->
        <svg class="animate-spin h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
        </svg>
        <span class="font-semibold">Sending certificate...</span>
    </div>
</div>


<!-- Toast notification envio completado -->
<div id="toast" class="hidden fixed inset-0 flex items-center justify-center z-50 pointer-events-none">
    <div class="bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg flex items-center space-x-2">
        <span id="toastMessage">Correo enviado correctamente</span>
    </div>
</div>



@if ($certificado && Storage::disk('public')->exists($certificado->file_path))

        {{-- Canvas de visualización --}}
        <div class="bg-zinc-800 p-4 rounded shadow mb-6 text-center">
            <canvas id="pdf-canvas" style="border:1px solid #555; width:100%; max-width:800px;"></canvas>
        </div>

        
        {{-- Inputs para editar datos --}}
<div class="bg-[#2c2f33] p-6 rounded-md shadow">
    <form id="formPdf" onsubmit="return false;">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <!-- Campo de fecha -->
<div>
  <label for="fecha" class="block text-white mb-2">Date:</label>
  <input 
    type="text" 
    id="fecha" 
    name="fecha"
    placeholder="MM/DD/YYYY"
    class="w-full px-4 py-2 bg-zinc-800 text-white border border-gray-600 rounded leading-tight focus:outline-none focus:border-gray-400"
    required>
</div>

<!-- Flatpickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Inicialización -->
<script>
  flatpickr("#fecha", {
    dateFormat: "m/d/Y", // Formato USA
    altInput: true,
    altFormat: "m/d/Y",
    allowInput: true
  });
</script>


            <div>
                <label for="empresa" class="block text-white mb-2">Certificate Holder:</label>
                <textarea 
                    id="empresa"
                    name="empresa"
                    rows="3"
                    maxlength="120"
                    style="line-height: -1.1;"
                    class="w-full px-4 py-2 bg-zinc-800 text-white border border-gray-600 rounded resize-none"
                    placeholder="Company name&#10;Address, City&#10;State, Zip code"
                    required></textarea>
                <p id="contador" class="text-sm text-gray-400 mt-1 text-right">0 / 120 characters</p>
            </div> 
            <!--Scripts para el textarea Placeholder-->
                  <script>
                    const textarea = document.getElementById('empresa');
                    const contador = document.getElementById('contador');
                  
                    textarea.addEventListener('input', () => {
                      let lines = textarea.value.split('\n');
                      // Limita a 3 líneas
                      if (lines.length > 3) {
                        lines = lines.slice(0, 3);
                      }
                  
                      // Limita cada línea a 40 caracteres
                      lines = lines.map(line => line.slice(0, 40));
                  
                      // Texto final limitado a 120 caracteres
                      const finalText = lines.join('\n').slice(0, 120);
                  
                      // Asigna el texto final
                      textarea.value = finalText;
                  
                      // Actualiza contador
                      contador.textContent = `${finalText.length} / 120 caracteres`;
                    });
                  </script>

        </div>

        <div class="col-span-1 md:col-span-2">
            <label for="correo1" class="block text-white mb-2">Recipient email (required):</label>
            <input 
                type="email" 
                id="correo1" 
                name="correo1"
                class="w-full px-4 py-2 mb-4 bg-zinc-800 text-white border border-gray-600 rounded"
                placeholder="required@email.com" 
                required>

            <label for="correo2" class="block text-white mb-2">Second email (optional):</label>
            <input 
                type="email" 
                id="correo2" 
                name="correo2"
                class="w-full px-4 py-2 mb-4 bg-zinc-800 text-white border border-gray-600 rounded"
                placeholder="optional@email.com">

            <button 
                id="enviarCorreo"
                type="button"
                class="w-full bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded">
                Send PDF by email
            </button>
        </div>

        <button 
            id="editarPdf"
            type="button"
            class="w-full mt-4 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
            Download Edited PDF
        </button>
    </form>
</div>

{{-- Contenedor principal del certificado --}}
<div id="certificadoContainer" class="mt-10">

    @if($certificado && Storage::disk('public')->exists($certificado->file_path))
        {{-- Canvas de visualización --}}
        

       
    @else
        <p class="text-gray-400 text-center mt-10">There is no certificate assigned yet.</p>
    @endif

    {{-- Contenedor flex para botones --}}
    <div class="flex justify-between items-center mt-6">
        {{-- Botón Back to Dashboard siempre visible --}}
        <a href="{{ route('dashboard') }}" class="text-gray-400 hover:underline">← Back to dashboard</a>

        {{-- Botón Eliminar solo si hay certificado y usuario es admin --}}
        @if($certificado)
            @can('certificados.index')
                <form method="POST" action="{{ route('certificados.destroy', $certificado->id) }}"
                      onsubmit="return confirm('¿Estás seguro de eliminar este certificado?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                        Eliminar Certificado
                    </button>
                </form>
            @endcan
        @endif
    </div>

</div>



@else
    {{-- Si NO hay certificado --}}
    <p class="text-gray-400 text-center mt-10">There is no policy assigned yet.</p>
@endif






   

{{-- Scripts --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.13.216/pdf.min.js"></script>
<script src="https://unpkg.com/pdf-lib/dist/pdf-lib.min.js"></script>

<script>
    let pdfDoc = null;
    let currentPdfUrl = null;

    function loadPdf(url) {
        currentPdfUrl = url;
        const canvas = document.getElementById('pdf-canvas');
        const ctx = canvas.getContext('2d');

        pdfjsLib.getDocument(url).promise.then(function(pdf) {
            pdfDoc = pdf;
            pdf.getPage(1).then(function(page) {
                const viewport = page.getViewport({ scale: 1.5 });
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                const renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };
                page.render(renderContext);
            });
        });
    }

  @if ($certificado && Storage::disk('public')->exists($certificado->file_path))
       window.onload = function () {
           const pdfUrl = "{{ asset('storage/' . $certificado->file_path) }}";
           console.log("Cargando PDF:", pdfUrl);
           loadPdf(pdfUrl);
       };
   @endif

</script>

<script>
    document.getElementById('editarPdf').addEventListener('click', async () => {
        
        if (!currentPdfUrl) return alert('Primero selecciona un PDF.');

        const existingPdfBytes = await fetch(currentPdfUrl).then(res => res.arrayBuffer());
        const pdfDoc = await PDFLib.PDFDocument.load(existingPdfBytes);
        const pages = pdfDoc.getPages();
        const firstPage = pages[0];

        const empresa = document.getElementById('empresa').value || 'Empresa Ejemplo S.A.';
        const fecha = document.getElementById('fecha').value || new Date().toLocaleDateString();

        const { width, height } = firstPage.getSize();
        const font = await pdfDoc.embedFont(PDFLib.StandardFonts.Helvetica);

    
// Rectángulo para el nombre de la empresa
firstPage.drawRectangle({
    x: 45,
    y: 98, // más arriba
    width: 200,
    height: 30,
    color: PDFLib.rgb(1, 1, 1),
    
});

// Texto para el nombre de la empresa
const lineHeight = 10; // interlineado
const startX = 45; // interlineado
let startY = 98; // interlineado

const lines = empresa.split('\n');
// interlineado
lines.forEach((line) => {
    firstPage.drawText(line, {
        x: startX,
        y: startY,
        size: 10,
        font: font,
        color: PDFLib.rgb(0, 0, 0),
    });
    startY -= lineHeight; // mover hacia abajo en cada línea
});
// Rectángulo para la fecha
firstPage.drawRectangle({
     x: 530,
    y: 745, 
    width: 50,
    height: 10,
    color: PDFLib.rgb(1, 1, 1),
});

// Texto para la fecha
firstPage.drawText(fecha, {
     x: 530,
    y: 745,
    size: 8,
    font: font,
    color: PDFLib.rgb(0, 0, 0),
});

        const pdfBytes = await pdfDoc.save();

        const blob = new Blob([pdfBytes], { type: 'application/pdf' });
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.download = 'certificado_editado.pdf';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const enviarBtn = document.getElementById('enviarCorreo');
    const modal = document.getElementById('sendingModal');
    const textarea = document.getElementById('empresa');
    const contador = document.getElementById('contador');

    if (!enviarBtn || !modal) return;

    enviarBtn.addEventListener('click', async () => {
        const form = document.getElementById('formPdf');
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        const correo1 = document.getElementById('correo1').value.trim();
        const correo2 = document.getElementById('correo2').value.trim();
        if (!correo1 || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo1)) return showToast('Ingresa un correo válido.', 4000);
        if (correo2 && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo2)) return showToast('El segundo correo no es válido.', 4000);
        if (!currentPdfUrl) return showToast('Primero selecciona un PDF.', 4000);

        // Mostrar modal centralizado
        modal.classList.remove('hidden');

        try {
            const existingPdfBytes = await fetch(currentPdfUrl).then(res => res.arrayBuffer());
            const pdfDoc = await PDFLib.PDFDocument.load(existingPdfBytes);
            const firstPage = pdfDoc.getPages()[0];

            const empresa = textarea.value || 'Empresa Ejemplo S.A.';
            const fecha = document.getElementById('fecha').value || new Date().toLocaleDateString();
            const font = await pdfDoc.embedFont(PDFLib.StandardFonts.Helvetica);

            // Dibuja empresa
            firstPage.drawRectangle({ x: 45, y: 98, width: 200, height: 30, color: PDFLib.rgb(1,1,1) });
            let startY = 98;
            empresa.split('\n').forEach(line => {
                firstPage.drawText(line, { x: 45, y: startY, size: 10, font, color: PDFLib.rgb(0,0,0) });
                startY -= 10;
            });

            // Dibuja fecha
            firstPage.drawRectangle({ x: 530, y: 745, width: 50, height: 10, color: PDFLib.rgb(1,1,1) });
            firstPage.drawText(fecha, { x: 530, y: 745, size: 8, font, color: PDFLib.rgb(0,0,0) });

            // Guarda PDF en blob
            const pdfBytes = await pdfDoc.save();
            const blob = new Blob([pdfBytes], { type: 'application/pdf' });

            // Preparar FormData para enviar
            const formData = new FormData();
            formData.append('pdf', blob, 'certificado_editado.pdf');
            formData.append('correo1', correo1);
            if (correo2) formData.append('correo2', correo2);

            // Enviar al backend
            const response = await fetch("{{ route('certificados.sendPdf') }}", {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: formData
            });

            const data = await response.json();

            // Ocultar modal y mostrar mensaje final
            modal.classList.add('hidden');
            showToast(data.message || 'Correo(s) enviado(s) correctamente.');

            // --- Limpiar inputs ---
            document.getElementById('correo1').value = '';
            document.getElementById('correo2').value = '';
            textarea.value = '';
            document.getElementById('fecha').value = '';
            if (contador) contador.textContent = '0 / 120 caracteres';

        } catch (error) {
            modal.classList.add('hidden');
            console.error('Error:', error);
            showToast('Error al enviar el correo.', 6000);
        }
    });
});
</script>


<!-- Script para mostrar toast notification de enviado-->
<script>
function showToast(message, duration = 3000) {
    const toast = document.getElementById('toast');
    const toastMessage = document.getElementById('toastMessage');
    toastMessage.textContent = message;
    
    toast.classList.remove('hidden');
    
    // Fade in
    toast.style.opacity = 0;
    toast.style.transition = 'opacity 0.3s';
    requestAnimationFrame(() => {
        toast.style.opacity = 1;
    });

    // Ocultar después de 'duration'
    setTimeout(() => {
        toast.style.opacity = 0;
        toast.addEventListener('transitionend', () => {
            toast.classList.add('hidden');
        }, { once: true });
    }, duration);
}
</script>

    


@endsection
