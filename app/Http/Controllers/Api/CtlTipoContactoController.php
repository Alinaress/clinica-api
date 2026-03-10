<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CtlTipoContacto;
use Illuminate\Http\Request;

class CtlTipoContactoController extends Controller
{
    public function index()
    {
        $data = CtlTipoContacto::where('estado', true)->orderBy('nombre')->get();
        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:ctl_tipo_contacto,nombre',
        ]);

        $tipoContacto = CtlTipoContacto::create([
            'nombre' => $request->nombre,
            'estado' => true,
        ]);

        return response()->json(['message' => 'Creado correctamente', 'data' => $tipoContacto], 201);
    }

    public function show($id)
    {
        $tipoContacto = CtlTipoContacto::findOrFail($id);
        return response()->json(['data' => $tipoContacto]);
    }

    public function update(Request $request, $id)
    {
        $tipoContacto = CtlTipoContacto::findOrFail($id);

        $request->validate([
            'nombre' => 'sometimes|string|max:100|unique:ctl_tipo_contacto,nombre,' . $id,
            'estado' => 'sometimes|boolean',
        ]);

        $tipoContacto->update($request->only(['nombre', 'estado']));

        return response()->json(['message' => 'Actualizado correctamente', 'data' => $tipoContacto]);
    }

    public function destroy($id)
    {
        $tipoContacto = CtlTipoContacto::findOrFail($id);
        $tipoContacto->update(['estado' => false]);

        return response()->json(['message' => 'Desactivado correctamente']);
    }
}
