<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CtlEspecialidad;
use Illuminate\Http\Request;

class CtlEspecialidadController extends Controller
{
    public function index()
    {
        $data = CtlEspecialidad::where('estado', true)->orderBy('nombre')->get();
        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:ctl_especialidad,nombre',
        ]);

        $especialidad = CtlEspecialidad::create([
            'nombre' => $request->nombre,
            'estado' => true,
        ]);

        return response()->json(['message' => 'Creado correctamente', 'data' => $especialidad], 201);
    }

    public function show($id)
    {
        $especialidad = CtlEspecialidad::findOrFail($id);
        return response()->json(['data' => $especialidad]);
    }

    public function update(Request $request, $id)
    {
        $especialidad = CtlEspecialidad::findOrFail($id);

        $request->validate([
            'nombre' => 'sometimes|string|max:100|unique:ctl_especialidad,nombre,' . $id,
            'estado' => 'sometimes|boolean',
        ]);

        $especialidad->update($request->only(['nombre', 'estado']));

        return response()->json(['message' => 'Actualizado correctamente', 'data' => $especialidad]);
    }

    public function destroy($id)
    {
        $especialidad = CtlEspecialidad::findOrFail($id);
        $especialidad->update(['estado' => false]);

        return response()->json(['message' => 'Desactivado correctamente']);
    }
}
