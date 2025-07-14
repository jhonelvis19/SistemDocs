<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Documento;
use App\Models\Usuario;
use App\Models\TipoDocumento;
use App\Models\TipoProceso;
use App\Models\Ubicacion;
use App\Models\UbicacionDocumento;
use App\Models\FlujoProceso;
use App\Models\EstadoDocumento;
use App\Models\HistorialEstado;
use Illuminate\Support\Facades\Auth;
use App\Models\AsignacionDocumento;


class DocumentoController extends Controller
{
    public function create()
    {
        $usuarios = Usuario::where('rol', 'usuario')->get();
        $tiposDocumento = TipoDocumento::all();
        $tiposProceso = TipoProceso::all();

        return view('documentos.create', compact('usuarios', 'tiposDocumento', 'tiposProceso'));
    }

public function store(Request $request)
{
    $request->validate([
        'titulo' => 'required|string|max:200',
        'descripcion' => 'nullable|string',
        'dni_usuario' => 'required|string|exists:usuarios,dni',
        'archivo' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        'id_tipo_documento' => 'required|exists:tipos_documento,id_tipo_documento',
        'id_tipo_proceso' => 'required|exists:tipos_proceso,id_tipo_proceso',
    ]);

    $usuarioAsignado = Usuario::where('dni', $request->dni_usuario)->first();
    $admin = Auth::user(); // este es el admin que está logueado

    $rutaArchivo = null;
    if ($request->hasFile('archivo')) {
        $archivo = $request->file('archivo');
        $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
        $rutaArchivo = $archivo->storeAs('documentos', $nombreArchivo, 'public');
    }

    DB::beginTransaction();
    try {
        $documento = Documento::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_creacion' => now(),
            'id_usuario_creador' => $admin->id_usuario, // El admin es el creador
            'id_tipo_documento' => $request->id_tipo_documento,
            'id_tipo_proceso' => $request->id_tipo_proceso,
            'archivo' => $rutaArchivo,
        ]);

        // Registrar la asignación al usuario por DNI
        AsignacionDocumento::create([
            'id_documento' => $documento->id_documento,
            'id_usuario' => $usuarioAsignado->id_usuario,
        ]);

        // Ubicación inicial
        $mesa = Ubicacion::where('nombre_ubicacion', 'Mesa de Partes')->first();
        if ($mesa) {
            UbicacionDocumento::create([
                'id_documento' => $documento->id_documento,
                'id_ubicacion' => $mesa->id_ubicacion,
                'fecha_registro' => now(),
            ]);
        }

        // Estado inicial: Enviado
        $estadoInicial = EstadoDocumento::where('nombre_estado', 'Enviado')->first();
        if ($estadoInicial) {
            HistorialEstado::create([
                'id_documento' => $documento->id_documento,
                'id_estado' => $estadoInicial->id_estado,
                'fecha_cambio' => now(),
                'observaciones' => 'Documento creado y enviado desde Mesa de Partes',
            ]);
        }

        DB::commit();
        return redirect()->route('documentos.index')->with('success', 'Documento creado correctamente.');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Error al registrar el documento: ' . $e->getMessage());
    }
}


    public function index()
    {
        $documentos = Documento::with([
        'usuarioAsignado', 
        'tipoDocumento',
        'tipoProceso',
        'ubicacionActual.ubicacion',
        'estadoActual.estado'
        ])->get();

        return view('documentos.index', compact('documentos'));
    }

    public function avanzar($id)
    {
        $documento = Documento::findOrFail($id);

        $estadoActual = $documento->estadoActual;
        if ($estadoActual && $estadoActual->estado->nombre_estado === 'Rechazado') {
        return back()->with('error', 'No se puede avanzar un documento que ha sido rechazado.');
        }
        DB::beginTransaction();

        try {
            $documento = Documento::findOrFail($id);

            $ubicacionActual = UbicacionDocumento::where('id_documento', $documento->id_documento)
                ->latest('fecha_registro')->first();

            if (!$ubicacionActual) {
                return back()->with('error', 'El documento no tiene una ubicación asignada.');
            }

            $pasoActual = FlujoProceso::where('id_tipo_proceso', $documento->id_tipo_proceso)
                ->where('id_ubicacion', $ubicacionActual->id_ubicacion)
                ->first();

            if (!$pasoActual) {
                return back()->with('error', 'No se encontró el flujo para esta ubicación.');
            }

            $siguientePaso = FlujoProceso::where('id_tipo_proceso', $documento->id_tipo_proceso)
                ->where('orden', '>', $pasoActual->orden)
                ->orderBy('orden', 'asc')->first();

            if (!$siguientePaso) {
                return back()->with('info', 'Este documento ya está en la última ubicación.');
            }

            UbicacionDocumento::create([
                'id_documento' => $documento->id_documento,
                'id_ubicacion' => $siguientePaso->id_ubicacion,
                'fecha_registro' => now(),
            ]);

            $nuevaUbicacion = Ubicacion::find($siguientePaso->id_ubicacion);

            $estadoMap = [
                'Mesa de Partes' => 'Enviado',
                'Alcaldía' => 'Finalizado'
            ];

            $nuevoEstadoNombre = $estadoMap[$nuevaUbicacion->nombre_ubicacion] ?? 'En Proceso';

            $estado = EstadoDocumento::where('nombre_estado', $nuevoEstadoNombre)->first();
            if ($estado) {
                HistorialEstado::create([
                    'id_documento' => $documento->id_documento,
                    'id_estado' => $estado->id_estado,
                    'fecha_cambio' => now(),
                    'observaciones' => 'Cambio automático por avance de ubicación.',
                ]);
            }

            DB::commit();
            return back()->with('success', 'Documento avanzado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

public function rechazar(Request $request, $id)
{
    $request->validate([
        'observaciones' => 'required|string|max:500',
    ]);

    $documento = Documento::findOrFail($id);
    $estadoRechazado = EstadoDocumento::where('nombre_estado', 'Rechazado')->first();

    if ($estadoRechazado) {
        HistorialEstado::create([
            'id_documento' => $documento->id_documento,
            'id_estado' => $estadoRechazado->id_estado,
            'fecha_cambio' => now(),
            'observaciones' => $request->observaciones,
        ]);
    }

    return back()->with('success', 'El documento ha sido rechazado.');
}


    // Mostrar formulario de edición
public function edit($id)
{
    $documento = Documento::with('estadoActual.estado')->findOrFail($id);

    if ($documento->estadoActual && $documento->estadoActual->estado->nombre_estado === 'Rechazado') {
    return redirect()->route('documentos.index')->with('error', 'No se puede editar un documento rechazado.');
    }

    $documento = Documento::findOrFail($id);
    $usuarios = Usuario::where('rol', 'usuario')->get();
    $tiposDocumento = TipoDocumento::all();
    $tiposProceso = TipoProceso::all();

    return view('documentos.edit', compact('documento', 'usuarios', 'tiposDocumento', 'tiposProceso'));
}

// Actualizar documento
public function update(Request $request, $id)
{
    $documento = Documento::with('estadoActual.estado')->findOrFail($id);

    if ($documento->estadoActual && $documento->estadoActual->estado->nombre_estado === 'Rechazado') {
    return redirect()->route('documentos.index')->with('error', 'No se puede actualizar un documento rechazado.');
    }
    $request->validate([
        'titulo' => 'required|string|max:200',
        'descripcion' => 'nullable|string',
        'id_tipo_documento' => 'required|exists:tipos_documento,id_tipo_documento',
        'id_tipo_proceso' => 'required|exists:tipos_proceso,id_tipo_proceso',
    ]);

    $documento = Documento::findOrFail($id);
    $documento->update([
        'titulo' => $request->titulo,
        'descripcion' => $request->descripcion,
        'id_tipo_documento' => $request->id_tipo_documento,
        'id_tipo_proceso' => $request->id_tipo_proceso,
    ]);

    return redirect()->route('documentos.index')->with('success', 'Documento actualizado correctamente.');
}
//eliminar los documentos
public function destroy($id)
{
    DB::beginTransaction();

    try {
        $documento = Documento::findOrFail($id);

        // Eliminar registros relacionados
        $documento->historialEstado()->delete();
        $documento->ubicaciones()->delete();

        // ❗ Eliminar asignaciones nuevas
        $documento->asignaciones()->delete();

        // Eliminar el archivo (opcional)
        if ($documento->archivo && \Storage::disk('public')->exists($documento->archivo)) {
            \Storage::disk('public')->delete($documento->archivo);
        }

        $documento->delete();

        DB::commit();
        return redirect()->route('documentos.index')->with('success', 'Documento y registros relacionados eliminados correctamente.');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Error al eliminar: ' . $e->getMessage());
    }
}


public function misDocumentos()
{
    $usuario = Auth::user();

    $documentos = Documento::whereHas('asignaciones', function ($query) use ($usuario) {
        $query->where('id_usuario', $usuario->id_usuario);
    })->with([
        'tipoDocumento',
        'tipoProceso',
        'ubicacionActual.ubicacion',
        'estadoActual.estado'
    ])->get();

    return view('documentos.mis_documentos', compact('documentos'));
}

}
