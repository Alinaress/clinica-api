<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MntDireccion;
use Illuminate\Http\Request;

class MntDireccionController extends Controller
{
    public function index()
    {
        $direcciones = MntDireccion::with('paciente')
            ->where('estado', true)
            ->get();

        return response()->json(['data' => $direcciones]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_paciente'  => 'required|exists:mnt_paciente,id',
            'direccion'    => 'required|string|max:255',
            'departamento' => 'nullable|string|max:100',
            'municipio'    => 'nullable|string|max:100',
            'referencia'   => 'nullable|string|max:255',
        ]);

        $direccion = MntDireccion::create([
            'id_paciente'  => $request->id_paciente,
            'direccion'    => $request->direccion,
            'departamento' => $request->departamento,
            'municipio'    => $request->municipio,
            'referencia'   => $request->referencia,
            'estado'       => true,
        ]);

        return response()->json(['message' => 'Dirección creada correctamente', 'data' => $direccion], 201);
    }

    public function show($id)
    {
        $direccion = MntDireccion::with('paciente')->findOrFail($id);
        return response()->json(['data' => $direccion]);
    }

    public function update(Request $request, $id)
    {
        $direccion = MntDireccion::findOrFail($id);

        $request->validate([
            'direccion'    => 'sometimes|string|max:255',
            'departamento' => 'nullable|string|max:100',
            'municipio'    => 'nullable|string|max:100',
            'referencia'   => 'nullable|string|max:255',
            'estado'       => 'sometimes|boolean',
        ]);

        $direccion->update($request->only([
            'direccion', 'departamento', 'municipio', 'referencia', 'estado'
        ]));

        return response()->json(['message' => 'Dirección actualizada correctamente', 'data' => $direccion]);
    }

    public function destroy($id)
    {
        $direccion = MntDireccion::findOrFail($id);
        $direccion->update(['estado' => false]);

        return response()->json(['message' => 'Dirección desactivada correctamente']);
    }
}
