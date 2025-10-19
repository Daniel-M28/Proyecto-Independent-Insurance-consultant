import { PDFDocument, StandardFonts, rgb } from 'pdf-lib';
import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css'; // para los estilos


let pdfDoc = null;
let currentPdfUrl = null;

// Inicialización de Flatpickr
document.addEventListener('DOMContentLoaded', () => {
    flatpickr("#fecha", { dateFormat: "m/d/Y", altInput: true, altFormat: "m/d/Y", allowInput: true });
});

// Cargar PDF en canvas
window.loadPdf = function(url) {
    currentPdfUrl = url;
    const canvas = document.getElementById('pdf-canvas');
    const ctx = canvas.getContext('2d');

    pdfjsLib.getDocument(url).promise.then(pdf => {
        pdfDoc = pdf;
        pdf.getPage(1).then(page => {
            const viewport = page.getViewport({ scale: 1.5 });
            canvas.height = viewport.height;
            canvas.width = viewport.width;
            page.render({ canvasContext: ctx, viewport });
        });
    });
};

// Si hay PDF cargado inicialmente
window.addEventListener('load', () => {
    const pdfCanvas = document.getElementById('pdf-canvas');
    if (pdfCanvas && window.pdfUrl) {
        loadPdf(window.pdfUrl);
    }
});

// Descargar PDF editado
document.getElementById('editarPdf')?.addEventListener('click', async () => {
    if (!currentPdfUrl) return alert('Primero selecciona un PDF.');

    const existingPdfBytes = await fetch(currentPdfUrl).then(r => r.arrayBuffer());
    const pdfDoc = await PDFDocument.load(existingPdfBytes);
    const firstPage = pdfDoc.getPages()[0];
    const empresa = document.getElementById('empresa').value || 'Empresa Ejemplo S.A.';
    const fecha = document.getElementById('fecha').value || new Date().toLocaleDateString();
    const font = await pdfDoc.embedFont(StandardFonts.Helvetica);

    firstPage.drawText(empresa, { x: 45, y: 98, size: 10, font, color: rgb(0,0,0) });
    firstPage.drawText(fecha, { x: 530, y: 745, size: 8, font, color: rgb(0,0,0) });

    const pdfBytes = await pdfDoc.save();
    const blob = new Blob([pdfBytes], { type: 'application/pdf' });
    const link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = 'certificado_editado.pdf';
    link.click();
});

// Enviar PDF por email
document.getElementById('enviarCorreo')?.addEventListener('click', async () => {
    const modal = document.getElementById('sendingModal');
    const form = document.getElementById('formPdf');
    if (!form.checkValidity()) { form.reportValidity(); return; }

    modal.classList.remove('hidden');
    try {
        const existingPdfBytes = await fetch(currentPdfUrl).then(r => r.arrayBuffer());
        const pdfDoc = await PDFDocument.load(existingPdfBytes);
        const firstPage = pdfDoc.getPages()[0];
        const empresa = document.getElementById('empresa').value || 'Empresa Ejemplo S.A.';
        const fecha = document.getElementById('fecha').value || new Date().toLocaleDateString();
        const font = await pdfDoc.embedFont(StandardFonts.Helvetica);

        firstPage.drawText(empresa, { x: 45, y: 98, size: 10, font, color: rgb(0,0,0) });
        firstPage.drawText(fecha, { x: 530, y: 745, size: 8, font, color: rgb(0,0,0) });

        const pdfBytes = await pdfDoc.save();
        const blob = new Blob([pdfBytes], { type: 'application/pdf' });

        const formData = new FormData();
        formData.append('pdf', blob, 'certificado_editado.pdf');
        formData.append('correo1', document.getElementById('correo1').value);
        formData.append('correo2', document.getElementById('correo2').value);

        const response = await fetch("/certificados/sendPdf", {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
            body: formData
        });

        const data = await response.json();
        modal.classList.add('hidden');
        showToast(data.message || 'Correo enviado correctamente.');
    } catch (err) {
        modal.classList.add('hidden');
        console.error(err);
        showToast('Error al enviar el correo.', 6000);
    }
});

// Toast
window.showToast = function(message, duration = 3000) {
    const toast = document.getElementById('toast');
    const toastMessage = document.getElementById('toastMessage');
    toastMessage.textContent = message;
    toast.classList.remove('hidden');
    toast.style.opacity = 0;
    toast.style.transition = 'opacity 0.3s';
    requestAnimationFrame(() => { toast.style.opacity = 1; });
    setTimeout(() => { 
        toast.style.opacity = 0; 
        toast.addEventListener('transitionend', () => toast.classList.add('hidden'), { once: true }); 
    }, duration);
};
