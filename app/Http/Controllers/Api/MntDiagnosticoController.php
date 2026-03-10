<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MntDiagnostico;
use Illuminate\Http\Request;

class MntDiagnosticoController extends Controller
{
    public function index()
    {
        $diagnosticos = MntDiagnostico::with(['cita.paciente', 'expediente', 'tipoTratamiento'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['data' => $diagnosticos]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_cita'             => 'required|exists:mnt_cita,id',
            'id_expediente'       => 'required|exists:mnt_expediente,id',
            'id_tipo_tratamiento' => 'nullable|exists:ctl_tipo_tratamiento,id',
            'sintomas'            => 'nullable|string',
            'descripcion'         => 'required|string',
            'observaciones'       => 'nullable|string',
        ]);

        $diagnostico = MntDiagnostico::create([
            'id_cita'             => $request->id_cita,
            'id_expediente'       => $request->id_expediente,
            'id_tipo_tratamiento' => $request->id_tipo_tratamiento,
            'sintomas'            => $request->sintomas,
            'descripcion'         => $request->descripcion,
            'observaciones'       => $request->observaciones,
        ]);

        return response()->json(['message' => 'Diagnóstico creado correctamente', 'data' => $diagnostico->load(['tipoTratamiento', 'expediente'])], 201);
    }

    public function show($id)
    {
        $diagnostico = MntDiagnostico::with([
            'cita.paciente',
            'cita.doctor',
            'expediente',
            'tipoTratamiento'
        ])->findOrFail($id);

        return response()->json(['data' => $diagnostico]);
    }

    public function update(Request $request, $id)
    {
        $diagnostico = MntDiagnostico::findOrFail($id);

        $request->validate([
            'id_tipo_tratamiento' => 'nullable|exists:ctl_tipo_tratamiento,id',
            'sintomas'            => 'nullable|string',
            'descripcion'         => 'sometimes|string',
            'observaciones'       => 'nullable|string',
        ]);

        $diagnostico->update($request->only([
            'id_tipo_tratamiento', 'sintomas', 'descripcion', 'observaciones'
        ]));

        return response()->json(['message' => 'Diagnóstico actualizado correctamente', 'data' => $diagnostico]);
    }

    public function destroy($id)
    {
        $diagnostico = MntDiagnostico::findOrFail($id);
        $diagnostico->delete();

        return response()->json(['message' => 'Diagnóstico eliminado correctamente']);
    }
}
