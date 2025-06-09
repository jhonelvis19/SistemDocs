<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documento;
use App\Models\Usuario;

class DocumentoController extends Controller
{
    // Mostrar formulario para crear documento
    public function create()
    {
        // Obtener usuarios con rol 'usuario' para asignar documentos
        $usuarios = Usuario::where('rol', 'usuario')->get();
        return view('documentos.create', compact('usuarios'));
    }

    // Guardar documento
    public function store(Request $request)
{
    $request->validate([
        'titulo' => 'required|string|max:200',
        'descripcion' => 'nullable|string',
        'dni_usuario' => 'required|string|exists:Usuarios,dni',
        'archivo' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        'id_tipo_documento' => 'nullable|exists:Tipos_Documento,id_tipo_documento',
        'id_tipo_proceso' => 'nullable|exists:Tipos_Proceso,id_tipo_proceso',
    ]);

    $usuario = Usuario::where('dni', $request->dni_usuario)->first();

    if (!$usuario) {
        return back()->withErrors(['dni_usuario' => 'No se encontró usuario con ese DNI'])->withInput();
    }

    $rutaArchivo = null;
    if ($request->hasFile('archivo')) {
        $archivo = $request->file('archivo');
        $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
        $rutaArchivo = $archivo->storeAs('documentos', $nombreArchivo, 'public');
    }

    Documento::create([
        'titulo' => $request->titulo,
        'descripcion' => $request->descripcion,
        'fecha_creacion' => date('Y-m-d'),
        'id_usuario_creador' => $usuario->id_usuario,
        'id_tipo_documento' => $request->id_tipo_documento,
        'id_tipo_proceso' => $request->id_tipo_proceso,
        'archivo' => $rutaArchivo,  // Guardamos la ruta en la BD
    ]);

    return redirect()->route('admin.panel');
}
public function index()
{
    $documentos = Documento::with(['usuario', 'tipoDocumento', 'tipoProceso'])->get();

    return view('documentos.index', compact('documentos'));
}


}
