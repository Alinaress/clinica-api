<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MntContacto;
use Illuminate\Http\Request;

class MntContactoController extends Controller
{
    public function index()
    {
        $contactos = MntContacto::with(['paciente', 'tipoContacto'])
            ->where('estado', true)
            ->get();

        return response()->json(['data' => $contactos]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'valor'            => 'required|string|max:150',
            'id_tipo_contacto' => 'required|exists:ctl_tipo_contacto,id',
            'id_paciente'      => 'required|exists:mnt_paciente,id',
        ]);

        $contacto = MntContacto::create([
            'valor'            => $request->valor,
            'id_tipo_contacto' => $request->id_tipo_contacto,
            'id_paciente'      => $request->id_paciente,
            'estado'           => true,
        ]);

        return response()->json(['message' => 'Contacto creado correctamente', 'data' => $contacto], 201);
    }

    public function show($id)
    {
        $contacto = MntContacto::with(['paciente', 'tipoContacto'])->findOrFail($id);
        return response()->json(['data' => $contacto]);
    }

    public function update(Request $request, $id)
    {
        $contacto = MntContacto::findOrFail($id);

        $request->validate([
            'valor'            => 'sometimes|string|max:150',
            'id_tipo_contacto' => 'sometimes|exists:ctl_tipo_contacto,id',
            'estado'           => 'sometimes|boolean',
        ]);

        $contacto->update($request->only(['valor', 'id_tipo_contacto', 'estado']));

        return response()->json(['message' => 'Contacto actualizado correctamente', 'data' => $contacto]);
    }

    public function destroy($id)
    {
        $contacto = MntContacto::findOrFail($id);
        $contacto->update(['estado' => false]);

        return response()->json(['message' => 'Contacto desactivado correctamente']);
    }
}
