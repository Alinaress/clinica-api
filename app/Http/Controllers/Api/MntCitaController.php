<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MntCita;
use Illuminate\Http\Request;

class MntCitaController extends Controller
{
    public function index()
    {
        $citas = MntCita::with(['paciente', 'doctor', 'estadoCita'])
            ->orderBy('fecha_hora', 'desc')
            ->get();

        return response()->json(['data' => $citas]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_paciente'    => 'required|exists:mnt_paciente,id',
            'id_doctor'      => 'required|exists:mnt_doctor,id',
            'id_estado_cita' => 'nullable|exists:ctl_estado_cita,id',
            'fecha_hora'     => 'required|date|after:now',
            'duracion_min'   => 'nullable|integer|min:10|max:180',
            'motivo'         => 'nullable|string',
            'notas'          => 'nullable|string',
        ]);

        $cita = MntCita::create([
            'id_paciente'        => $request->id_paciente,
            'id_doctor'          => $request->id_doctor,
            'id_estado_cita'     => $request->id_estado_cita ?? 1,
            'fecha_hora'         => $request->fecha_hora,
            'duracion_min'       => $request->duracion_min ?? 30,
            'motivo'             => $request->motivo,
            'notas'              => $request->notas,
            'id_usuario_creacion' => request()->user()->id,
        ]);

        return response()->json(['message' => 'Cita creada correctamente', 'data' => $cita->load(['paciente', 'doctor', 'estadoCita'])], 201);
    }

    public function show($id)
    {
        $cita = MntCita::with([
            'paciente',
            'doctor.especialidad',
            'estadoCita',
            'recetas.medicamento',
            'diagnosticos.tipoTratamiento'
        ])->findOrFail($id);

        return response()->json(['data' => $cita]);
    }

    public function update(Request $request, $id)
    {
        $cita = MntCita::findOrFail($id);

        $request->validate([
            'id_estado_cita' => 'nullable|exists:ctl_estado_cita,id',
            'fecha_hora'     => 'sometimes|date',
            'duracion_min'   => 'nullable|integer|min:10|max:180',
            'motivo'         => 'nullable|string',
            'notas'          => 'nullable|string',
        ]);

        $cita->update($request->only([
            'id_estado_cita', 'fecha_hora', 'duracion_min', 'motivo', 'notas'
        ]));

        return response()->json(['message' => 'Cita actualizada correctamente', 'data' => $cita]);
    }

    public function destroy($id)
    {
        $cita = MntCita::findOrFail($id);
        $cita->update(['id_estado_cita' => 5]); // 5 = cancelada

        return response()->json(['message' => 'Cita cancelada correctamente']);
    }
}
