<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CtlTipoTratamiento;
use Illuminate\Http\Request;

class CtlTipoTratamientoController extends Controller
{
    public function index()
    {
        $data = CtlTipoTratamiento::where('estado', true)->orderBy('nombre')->get();
        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'      => 'required|string|max:100|unique:ctl_tipo_tratamiento,nombre',
            'descripcion' => 'nullable|string',
        ]);

        $tipoTratamiento = CtlTipoTratamiento::create([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion,
            'estado'      => true,
        ]);

        return response()->json(['message' => 'Creado correctamente', 'data' => $tipoTratamiento], 201);
    }

    public function show($id)
    {
        $tipoTratamiento = CtlTipoTratamiento::findOrFail($id);
        return response()->json(['data' => $tipoTratamiento]);
    }

    public function update(Request $request, $id)
    {
        $tipoTratamiento = CtlTipoTratamiento::findOrFail($id);

        $request->validate([
            'nombre'      => 'sometimes|string|max:100|unique:ctl_tipo_tratamiento,nombre,' . $id,
            'descripcion' => 'nullable|string',
            'estado'      => 'sometimes|boolean',
        ]);

        $tipoTratamiento->update($request->only(['nombre', 'descripcion', 'estado']));

        return response()->json(['message' => 'Actualizado correctamente', 'data' => $tipoTratamiento]);
    }

    public function destroy($id)
    {
        $tipoTratamiento = CtlTipoTratamiento::findOrFail($id);
        $tipoTratamiento->update(['estado' => false]);

        return response()->json(['message' => 'Desactivado correctamente']);
    }
}
