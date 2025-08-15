<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;


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
        $file->storeAs('certificados', $fileName, );
;

        return redirect()->route('certificados.index')->with('success', 'PDF subido correctamente.');
    }

public function sendPdf(Request $request)
{
    if ($request->hasFile('pdf')) {
        $pdfFile = $request->file('pdf');
        $fileName = 'certificado_editado_' . time() . '.pdf';
        $path = $pdfFile->storeAs('temp_pdfs', $fileName,);

        $emails = array_filter([
        $request->input('correo1'), // Obligatorio
        $request->input('correo2')  // Opcional
        ]);

        foreach ($emails as $email) {
            Mail::to($email)->send(new \App\Mail\CertificadoPdfMail($fileName));
        }

        // Limpieza opcional del archivo temporal después de enviar
        Storage::delete($path);

        return response()->json(['message' => 'PDF enviado correctamente']);
    }

    return response()->json(['message' => 'No se encontró el archivo'], 400);
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
