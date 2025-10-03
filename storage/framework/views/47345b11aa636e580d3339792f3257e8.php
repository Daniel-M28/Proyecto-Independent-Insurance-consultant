<?php $__env->startSection('content'); ?>
<div class="flex justify-center mt-10">
    <div class="w-full max-w-5xl bg-[#1e1e1e] p-6 rounded-xl shadow-lg">
        <h1 class="text-2xl font-semibold text-white mb-6 text-center">Gestión de Certificados de aseguranza</h1>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('certificados.index')): ?>
        
        <form action="<?php echo e(route('certificados.store')); ?>" method="POST" enctype="multipart/form-data" class="bg-[#2c2f33] p-6 rounded-md shadow mb-6">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <label for="certificado" class="block text-white mb-2">Subir nuevo certificado (PDF):</label>
                <input type="file" name="certificado" id="certificado" class="w-full px-4 py-2 bg-zinc-800 text-white border border-gray-600 rounded" accept="application/pdf" required>
            </div>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded">
                Subir PDF
            </button>
        </form>
        <?php endif; ?>

        
        <h4 class="text-white text-lg font-semibold mb-4">Archivos disponibles:</h4>
        <ul id="pdfList" class="space-y-2 mb-6">
            <?php $__currentLoopData = $pdfUrls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pdf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="flex justify-between items-center bg-zinc-800 text-white p-3 rounded border border-gray-700">
                    <span class="cursor-pointer hover:underline" onclick="loadPdf('<?php echo e($pdf['url']); ?>')">
                         <?php echo e($pdf['name']); ?>

                    </span>
                     <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('certificados.index')): ?>
                    <form action="<?php echo e(route('certificados.destroy')); ?>" method="POST" onsubmit="return confirm('¿Eliminar este PDF?')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <input type="hidden" name="filename" value="<?php echo e($pdf['name']); ?>">
                        <button class="bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded text-sm">
                            Eliminar
                        </button>
                    </form>
                    <?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

        
        <div class="bg-zinc-800 p-4 rounded shadow mb-6 text-center">
            <canvas id="pdf-canvas" style="border:1px solid #555; width:100%; max-width:800px;"></canvas>
        </div>

        
        <div class="bg-[#2c2f33] p-6 rounded-md shadow">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="fecha" class="block text-white mb-2">Fecha:</label>
                    <input type="date" id="fecha" class="w-full px-4 py-2 bg-zinc-800 text-white border border-gray-600 rounded leading-tight">
                </div>
                <div>
                    <label for="empresa" class="block text-white mb-2">Certificate Holder:</label>
                    <textarea 
                      id="empresa"
                      rows="3"
                      maxlength="120"
                      style="line-height: -1.1;"
                      class="w-full px-4 py-2 bg-zinc-800 text-white border border-gray-600 rounded resize-none"
                      placeholder="Nombre de empresa, dirección, ciudad, etc."></textarea>
                    <p id="contador" class="text-sm text-gray-400 mt-1 text-right">0 / 120 caracteres</p>
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
    <label for="correo1" class="block text-white mb-2">Correo destinatario (obligatorio):</label>
    <input type="email" id="correo1" name="correo1"class="w-full px-4 py-2 mb-4 bg-zinc-800 text-white border border-gray-600 rounded" placeholder="ejemplo@correo.com" required>

    <label for="correo2" class="block text-white mb-2">Segundo correo (opcional):</label>
    <input type="email" id="correo2" name="correo2" class="w-full px-4 py-2 mb-4 bg-zinc-800 text-white border border-gray-600 rounded" placeholder="opcional@correo.com">

    <button id="enviarCorreo" class="w-full bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded">
        Enviar PDF por correo
    </button>
</div>


            <button id="editarPdf" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
                Descargar PDF Editado
            </button>
        </div>
    </div>
</div>


<!-- Botón back -->
    <div class="mt-6">
        <a href="<?php echo e(route('dashboard')); ?>" class="text-gray-400 hover:underline">← Back to dashboard</a>
    </div>


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

    <?php if(count($pdfUrls) > 0): ?>
        window.onload = function () {
            loadPdf("<?php echo e($pdfUrls[0]['url']); ?>");
        };
    <?php endif; ?>

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

        fetch("<?php echo e(route('certificados.sendPdf')); ?>", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
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


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\proyecto_iic\resources\views/certificados/index.blade.php ENDPATH**/ ?>