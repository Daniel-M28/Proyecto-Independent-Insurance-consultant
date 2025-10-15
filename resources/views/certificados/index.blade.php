@extends('layouts.app')

@section('content')
<div class="flex justify-center mt-10">
    <div class="w-full max-w-5xl bg-[#1e1e1e] p-6 rounded-xl shadow-lg">
        <h1 class="text-2xl font-semibold text-white mb-6 text-center">Gestión de Certificados de aseguranza</h1>

        @can('certificados.index')
        {{-- Formulario para subir PDF --}}
        <form action="{{ route('certificados.store') }}" method="POST" enctype="multipart/form-data" class="bg-[#2c2f33] p-6 rounded-md shadow mb-6">
            @csrf
            <div class="mb-4">
                <label for="certificado" class="block text-white mb-2">Upload new certificate(PDF):</label>
                <input type="file" name="certificado" id="certificado" class="w-full px-4 py-2 bg-zinc-800 text-white border border-gray-600 rounded" accept="application/pdf" required>
            </div>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded">
                Upload PDF
            </button>
        </form>
        @endcan

        {{-- Lista de archivos --}}
        <h4 class="text-white text-lg font-semibold mb-4">Available files:</h4>
        <ul id="pdfList" class="space-y-2 mb-6">
            @foreach ($pdfUrls as $pdf)
                <li class="flex justify-between items-center bg-zinc-800 text-white p-3 rounded border border-gray-700">
                    <span class="cursor-pointer hover:underline" onclick="loadPdf('{{ $pdf['url'] }}')">
                         {{ $pdf['name'] }}
                    </span>
                     @can('certificados.index')
                    <form action="{{ route('certificados.destroy') }}" method="POST" onsubmit="return confirm('¿Eliminar este PDF?')">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="filename" value="{{ $pdf['name'] }}">
                        <button class="bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded text-sm">
                            Eliminate
                        </button>
                    </form>
                    @endcan
                </li>
            @endforeach
        </ul>

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



<!-- Botón back -->
    <div class="mt-6">
        <a href="{{ route('dashboard') }}" class="text-gray-400 hover:underline">← Back to dashboard</a>
    </div>

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

    @if (count($pdfUrls) > 0)
        window.onload = function () {
            loadPdf("{{ $pdfUrls[0]['url'] }}");
        };
    @endif

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
    // Función específica para enviar el PDF editado por correo
    document.getElementById('enviarCorreo').addEventListener('click', async () => {
    const form = document.getElementById('formPdf');
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

        const correo1 = document.getElementById('correo1').value.trim();
        const correo2 = document.getElementById('correo2').value.trim();

        if (!correo1 || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo1)) {
            return alert('Ingresa un correo válido (obligatorio).');
        }

        if (correo2 && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo2)) {
            return alert('El segundo correo no es válido.');
        }

        if (!currentPdfUrl) {
            return alert('Primero selecciona un PDF.');
        }

        // Reutiliza tu lógica de edición del PDF (debes tener esta función ya en tu código)
        const existingPdfBytes = await fetch(currentPdfUrl).then(res => res.arrayBuffer());
        const pdfDoc = await PDFLib.PDFDocument.load(existingPdfBytes);
        const firstPage = pdfDoc.getPages()[0];

        const empresa = document.getElementById('empresa').value || 'Empresa Ejemplo S.A.';
        const fecha = document.getElementById('fecha').value || new Date().toLocaleDateString();
        const font = await pdfDoc.embedFont(PDFLib.StandardFonts.Helvetica);

        // Dibuja empresa
        firstPage.drawRectangle({ x: 45, y: 98, width: 200, height: 30, color: PDFLib.rgb(1, 1, 1) });
        const lines = empresa.split('\n');
        let startY = 98;
        lines.forEach((line) => {
            firstPage.drawText(line, {
                x: 45,
                y: startY,
                size: 10,
                font: font,
                color: PDFLib.rgb(0, 0, 0),
            });
            startY -= 10;
        });

        // Dibuja fecha
        firstPage.drawRectangle({ x: 530, y: 745, width: 50, height: 10, color: PDFLib.rgb(1, 1, 1) });
        firstPage.drawText(fecha, { x: 530, y: 745, size: 8, font: font, color: PDFLib.rgb(0, 0, 0) });

        // Guarda PDF en blob
        const pdfBytes = await pdfDoc.save();
        const blob = new Blob([pdfBytes], { type: 'application/pdf' });

        // Enviar al servidor
        const formData = new FormData();
        formData.append('pdf', blob, 'certificado_editado.pdf');
        formData.append('correo1', correo1);
        if (correo2) formData.append('correo2', correo2);

        fetch("{{ route('certificados.sendPdf') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message || 'Correo(s) enviado(s) correctamente.');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al enviar el correo.');
        });
    });
</script>


@endsection
