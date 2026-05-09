<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MntExpediente;
use Illuminate\Http\Request;

class MntExpedienteController extends Controller
{
    public function index()
    {
        $expedientes = MntExpediente::with('paciente')
            ->where('estado', true)
            ->get();

        return response()->json(['data' => $expedientes]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_paciente'       => 'required|exists:mnt_paciente,id|unique:mnt_expediente,id_paciente',
            'antecedentes'      => 'nullable|string',
            'observaciones'     => 'nullable|string',
        ]);

        $expediente = MntExpediente::create([
            'id_paciente'        => $request->id_paciente,
            'numero_expediente'  => 'EXP-' . str_pad(MntExpediente::count() + 1, 5, '0', STR_PAD_LEFT),
            'fecha_apertura'     => now(),
            'antecedentes'       => $request->antecedentes,
            'observaciones'      => $request->observaciones,
            'estado'             => true,
        ]);

        return response()->json(['message' => 'Expediente creado correctamente', 'data' => $expediente], 201);
    }

    public function show($id)
    {
        $expediente = MntExpediente::with([
            'paciente',
            'diagnosticos.tipoTratamiento',
            'diagnosticos.cita.doctor'
        ])->findOrFail($id);

        return response()->json(['data' => $expediente]);
    }

    public function update(Request $request, $id)
    {
        $expediente = MntExpediente::findOrFail($id);

        $request->validate([
            'antecedentes'  => 'nullable|string',
            'observaciones' => 'nullable|string',
            'estado'        => 'sometimes|boolean',
        ]);

        $expediente->update($request->only(['antecedentes', 'observaciones', 'estado']));

        return response()->json(['message' => 'Expediente actualizado correctamente', 'data' => $expediente]);
    }

    public function destroy($id)
    {
        $expediente = MntExpediente::findOrFail($id);
        $expediente->update(['estado' => false]);

        return response()->json(['message' => 'Expediente desactivado correctamente']);
    }
}
