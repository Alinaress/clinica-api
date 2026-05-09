<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MntReceta;
use Illuminate\Http\Request;

class MntRecetaController extends Controller
{
    public function index()
    {
        $recetas = MntReceta::with(['cita.paciente', 'doctor', 'medicamento'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['data' => $recetas]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_cita'       => 'required|exists:mnt_cita,id',
            'id_doctor'     => 'required|exists:mnt_doctor,id',
            'id_medicamento'=> 'required|exists:ctl_medicamento,id',
            'dosis'         => 'required|string|max:100',
            'frecuencia'    => 'required|string|max:100',
            'duracion'      => 'nullable|string|max:100',
            'indicaciones'  => 'nullable|string',
        ]);

        $receta = MntReceta::create([
            'id_cita'        => $request->id_cita,
            'id_doctor'      => $request->id_doctor,
            'id_medicamento' => $request->id_medicamento,
            'dosis'          => $request->dosis,
            'frecuencia'     => $request->frecuencia,
            'duracion'       => $request->duracion,
            'indicaciones'   => $request->indicaciones,
        ]);

        return response()->json(['message' => 'Receta creada correctamente', 'data' => $receta->load(['medicamento', 'doctor'])], 201);
    }

    public function show($id)
    {
        $receta = MntReceta::with(['cita.paciente', 'doctor', 'medicamento'])->findOrFail($id);
        return response()->json(['data' => $receta]);
    }

    public function update(Request $request, $id)
    {
        $receta = MntReceta::findOrFail($id);

        $request->validate([
            'id_medicamento' => 'sometimes|exists:ctl_medicamento,id',
            'dosis'          => 'sometimes|string|max:100',
            'frecuencia'     => 'sometimes|string|max:100',
            'duracion'       => 'nullable|string|max:100',
            'indicaciones'   => 'nullable|string',
        ]);

        $receta->update($request->only([
            'id_medicamento', 'dosis', 'frecuencia', 'duracion', 'indicaciones'
        ]));

        return response()->json(['message' => 'Receta actualizada correctamente', 'data' => $receta]);
    }

    public function destroy($id)
    {
        $receta = MntReceta::findOrFail($id);
        $receta->delete();

        return response()->json(['message' => 'Receta eliminada correctamente']);
    }
}
