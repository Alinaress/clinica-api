<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CtlMedicamento;
use Illuminate\Http\Request;

class CtlMedicamentoController extends Controller
{
    public function index()
    {
        $data = CtlMedicamento::where('estado', true)->orderBy('nombre')->get();
        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'       => 'required|string|max:150|unique:ctl_medicamento,nombre',
            'descripcion'  => 'nullable|string',
            'presentacion' => 'nullable|string|max:100',
        ]);

        $medicamento = CtlMedicamento::create([
            'nombre'       => $request->nombre,
            'descripcion'  => $request->descripcion,
            'presentacion' => $request->presentacion,
            'estado'       => true,
        ]);

        return response()->json(['message' => 'Creado correctamente', 'data' => $medicamento], 201);
    }

    public function show($id)
    {
        $medicamento = CtlMedicamento::findOrFail($id);
        return response()->json(['data' => $medicamento]);
    }

    public function update(Request $request, $id)
    {
        $medicamento = CtlMedicamento::findOrFail($id);

        $request->validate([
            'nombre'       => 'sometimes|string|max:150|unique:ctl_medicamento,nombre,' . $id,
            'descripcion'  => 'nullable|string',
            'presentacion' => 'nullable|string|max:100',
            'estado'       => 'sometimes|boolean',
        ]);

        $medicamento->update($request->only(['nombre', 'descripcion', 'presentacion', 'estado']));

        return response()->json(['message' => 'Actualizado correctamente', 'data' => $medicamento]);
    }

    public function destroy($id)
    {
        $medicamento = CtlMedicamento::findOrFail($id);
        $medicamento->update(['estado' => false]);

        return response()->json(['message' => 'Desactivado correctamente']);
    }
}
