<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MntCita;
use App\Mail\CitaAgendada;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

        // Validar que el doctor no tenga otra cita en ese horario
        $duracion = $request->duracion_min ?? 30;
        $fechaInicio = Carbon::parse($request->fecha_hora);
        $fechaFin = $fechaInicio->copy()->addMinutes($duracion);

        $citaExistente = MntCita::where('id_doctor', $request->id_doctor)
            ->whereNotIn('id_estado_cita', [5]) // excluir canceladas
            ->where(function ($query) use ($fechaInicio, $fechaFin) {
                $query->whereBetween('fecha_hora', [$fechaInicio, $fechaFin])
                      ->orWhereRaw("fecha_hora + (duracion_min || ' minutes')::interval > ?", [$fechaInicio]);
            })
            ->exists();

        if ($citaExistente) {
            return response()->json([
                'message' => 'El doctor ya tiene una cita agendada en ese horario.',
                'errors'  => [
                    'fecha_hora' => ['El doctor no está disponible en ese horario.']
                ]
            ], 422);
        }

        $cita = MntCita::create([
            'id_paciente'         => $request->id_paciente,
            'id_doctor'           => $request->id_doctor,
            'id_estado_cita'      => $request->id_estado_cita ?? 1,
            'fecha_hora'          => $request->fecha_hora,
            'duracion_min'        => $duracion,
            'motivo'              => $request->motivo,
            'notas'               => $request->notas,
            'id_usuario_creacion' => request()->user()->id,
        ]);

        $cita->load(['paciente', 'doctor', 'estadoCita']);

        $email = $cita->paciente->usuario->email;
        Mail::to($email)->send(new CitaAgendada($cita));

        $cita->load(['paciente', 'doctor', 'estadoCita']);

        $email = $cita->paciente->usuario->email;
        Mail::to($email)->send(new CitaAgendada($cita));

        return response()->json([
            'message' => 'Cita creada correctamente',
            'data'    => $cita
        ], 201);
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
