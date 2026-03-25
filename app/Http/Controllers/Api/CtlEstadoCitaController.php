<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CtlEstadoCita;
use Illuminate\Http\Request;

class CtlEstadoCitaController extends Controller
{
    public function index()
    {
        $data = CtlEstadoCita::where('estado', true)->orderBy('nombre')->get();
        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:ctl_estado_cita,nombre',
            'color'  => 'nullable|string|max:20',
        ]);

        $estadoCita = CtlEstadoCita::create([
            'nombre' => $request->nombre,
            'color'  => $request->color,
            'estado' => true,
        ]);

        return response()->json(['message' => 'Creado correctamente', 'data' => $estadoCita], 201);
    }

    public function show($id)
    {
        $estadoCita = CtlEstadoCita::findOrFail($id);
        return response()->json(['data' => $estadoCita]);
    }

    public function update(Request $request, $id)
    {
        $estadoCita = CtlEstadoCita::findOrFail($id);

        $request->validate([
            'nombre' => 'sometimes|string|max:100|unique:ctl_estado_cita,nombre,' . $id,
            'color'  => 'nullable|string|max:20',
            'estado' => 'sometimes|boolean',
        ]);

        $estadoCita->update($request->only(['nombre', 'color', 'estado']));

        return response()->json(['message' => 'Actualizado correctamente', 'data' => $estadoCita]);
    }

    public function destroy($id)
    {
        $estadoCita = CtlEstadoCita::findOrFail($id);
        $estadoCita->update(['estado' => false]);

        return response()->json(['message' => 'Desactivado correctamente']);
    }
}
