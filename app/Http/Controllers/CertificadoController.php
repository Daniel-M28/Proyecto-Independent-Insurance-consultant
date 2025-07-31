<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificadoController extends Controller
{
    public function index()
    {
        // Obtener todos los PDFs guardados en /public/certificados
        $files = Storage::disk('public')->files('certificados');

        // Filtrar solo los archivos PDF
        $pdfs = array_filter($files, function ($file) {
            return pathinfo($file, PATHINFO_EXTENSION) === 'pdf';
        });

        // Obtener las URLs para visualizar los archivos
        $pdfUrls = array_map(function ($file) {
            return [
                'name' => basename($file),
                'url' => asset('storage/' . $file),
            ];
        }, $pdfs);

        return view('certificados.index', compact('pdfUrls'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'certificado' => 'required|mimes:pdf|max:20480',
        ]);

        $file = $request->file('certificado');

        // Usar el nombre original del archivo para guardarlo 
        $fileName = $file->getClientOriginalName();
        $file->storeAs('certificados', $fileName, 'public');
;

        return redirect()->route('certificados.index')->with('success', 'PDF subido correctamente.');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'filename' => 'required|string',
        ]);

        $path = 'certificados/' . $request->input('filename');

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
            return redirect()->route('certificados.index')->with('success', 'PDF eliminado.');
        }

        return redirect()->route('certificados.index')->with('error', 'No se encontró el PDF.');
    }
} 
