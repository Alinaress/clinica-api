<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CtlGenero;
use Illuminate\Http\Request;

class CtlGeneroController extends Controller
{
    // GET /api/catalogos/generos
    public function index()
    {
        $data = CtlGenero::where('estado', true)->orderBy('nombre')->get();
        return response()->json(['data' => $data]);
    }

    // POST /api/catalogos/generos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:ctl_genero,nombre',
        ]);

        $genero = CtlGenero::create([
            'nombre' => $request->nombre,
            'estado' => true,
        ]);

        return response()->json(['message' => 'Creado correctamente', 'data' => $genero], 201);
    }

    // GET /api/catalogos/generos/{id}
    public function show($id)
    {
        $genero = CtlGenero::findOrFail($id);
        return response()->json(['data' => $genero]);
    }

    // PUT /api/catalogos/generos/{id}
    public function update(Request $request, $id)
    {
        $genero = CtlGenero::findOrFail($id);

        $request->validate([
            'nombre' => 'sometimes|string|max:100|unique:ctl_genero,nombre,' . $id,
            'estado' => 'sometimes|boolean',
        ]);

        $genero->update($request->only(['nombre', 'estado']));

        return response()->json(['message' => 'Actualizado correctamente', 'data' => $genero]);
    }

    // DELETE /api/catalogos/generos/{id}
    public function destroy($id)
    {
        $genero = CtlGenero::findOrFail($id);
        $genero->update(['estado' => false]);

        return response()->json(['message' => 'Desactivado correctamente']);
    }
}
