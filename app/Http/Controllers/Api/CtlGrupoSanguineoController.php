<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CtlGrupoSanguineo;
use Illuminate\Http\Request;

class CtlGrupoSanguineoController extends Controller
{
    public function index()
    {
        $data = CtlGrupoSanguineo::where('estado', true)->orderBy('nombre')->get();
        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:ctl_grupo_sanguineo,nombre',
        ]);

        $grupoSanguineo = CtlGrupoSanguineo::create([
            'nombre' => $request->nombre,
            'estado' => true,
        ]);

        return response()->json(['message' => 'Creado correctamente', 'data' => $grupoSanguineo], 201);
    }

    public function show($id)
    {
        $grupoSanguineo = CtlGrupoSanguineo::findOrFail($id);
        return response()->json(['data' => $grupoSanguineo]);
    }

    public function update(Request $request, $id)
    {
        $grupoSanguineo = CtlGrupoSanguineo::findOrFail($id);

        $request->validate([
            'nombre' => 'sometimes|string|max:100|unique:ctl_grupo_sanguineo,nombre,' . $id,
            'estado' => 'sometimes|boolean',
        ]);

        $grupoSanguineo->update($request->only(['nombre', 'estado']));

        return response()->json(['message' => 'Actualizado correctamente', 'data' => $grupoSanguineo]);
    }

    public function destroy($id)
    {
        $grupoSanguineo = CtlGrupoSanguineo::findOrFail($id);
        $grupoSanguineo->update(['estado' => false]);

        return response()->json(['message' => 'Desactivado correctamente']);
    }
}
