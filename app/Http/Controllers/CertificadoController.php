<?php

namespace App\Http\Controllers;

use App\Models\Certificado;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CertificadoController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
       $search = $request->input('search');
$results = [];      // nunca null
$user = null;
$certificado = null;
$pdfUrls = [];      // nunca null


        // Buscar usuarios por nombre o email
        if ($search) {
            $results = User::where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->get();
        }

        // Seleccionar usuario específico (admin) o el propio (usuario)
        if ($request->has('user_id')) {
            $user = User::find($request->user_id);
            $certificado = Certificado::where('user_id', $user->id)->first();
        } elseif (auth()->user()->hasRole('usuario')) {
            $user = auth()->user();
            $certificado = Certificado::where('user_id', $user->id)->first();
        }

        return view('certificados.index', compact('results', 'user', 'certificado', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:20480',
            'user_id' => 'required|exists:users,id'
        ]);

        $user = User::find($request->user_id);

        // Si ya existe un PDF para este usuario, eliminarlo
        $existing = Certificado::where('user_id', $user->id)->first();
        if ($existing) {
            if (Storage::disk('public')->exists($existing->file_path)) {
                Storage::disk('public')->delete($existing->file_path);
            }
            $existing->delete();
        }

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();

        // Guardar en storage/app/public/certificados
        $file->storeAs('certificados', $fileName, 'public');

        // Crear registro en DB
        Certificado::create([
            'user_id' => $user->id,
            'file_name' => $file->getClientOriginalName(),
            'file_path' => 'certificados/' . $fileName,
            'uploaded_by' => auth()->id(),
        ]);

        return back()->with('success', 'Certificate uploaded successfully.');
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

        return response()->json(['message' => 'Certificate sent successfully']);
    }

    return response()->json(['message' => 'No se encontró el archivo'], 400);
}






    public function destroy(Certificado $certificado)
{
    try {
        // Solo si tiene ruta válida
        if (!empty($certificado->file_path) && Storage::disk('public')->exists($certificado->file_path)) {
            Storage::disk('public')->delete($certificado->file_path);
        }

        // Eliminar el registro de la BD
        $certificado->delete();

        // Si fue una petición AJAX, devolver JSON
        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Certificate successfully deleted.']);
        }

        return back()->with('success', 'Certificate successfully deleted..');

    } catch (\Exception $e) {
        \Log::error('Error al eliminar certificado: '.$e->getMessage());

        if (request()->ajax()) {
            return response()->json(['success' => false, 'message' => 'Error deleting certificate.']);
        }

        return back()->with('error', 'Error deleting certificate.');
    }
}


}
