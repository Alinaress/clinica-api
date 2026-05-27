<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MntDoctor;
use Illuminate\Http\Request;

class MntDoctorController extends Controller
{
    public function index()
    {
        $doctores = MntDoctor::with(['especialidad'])
            ->where('estado', true)
            ->orderBy('apellido')
            ->get();

        return response()->json(['data' => $doctores]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'          => 'required|string|max:100',
            'apellido'        => 'required|string|max:100',
            'id_especialidad' => 'nullable|exists:ctl_especialidad,id',
            'num_registro'    => 'nullable|string|max:50|unique:mnt_doctor,num_registro',
            'foto'            => 'nullable|string|max:255',
            'id_usuario'      => 'nullable|exists:users,id',
        ]);

        $doctor = MntDoctor::create([
            'nombre'          => $request->nombre,
            'apellido'        => $request->apellido,
            'id_especialidad' => $request->id_especialidad,
            'num_registro'    => $request->num_registro,
            'foto'            => $request->foto,
            'estado'          => true,
            'id_usuario'      => $request->id_usuario,
        ]);

        return response()->json(['message' => 'Doctor creado correctamente', 'data' => $doctor], 201);
    }

    public function show($id)
    {
        $doctor = MntDoctor::with(['especialidad', 'usuario', 'citas'])
            ->findOrFail($id);

        return response()->json(['data' => $doctor]);
    }

    public function update(Request $request, $id)
    {
        $doctor = MntDoctor::findOrFail($id);

        $request->validate([
            'nombre'          => 'sometimes|string|max:100',
            'apellido'        => 'sometimes|string|max:100',
            'id_especialidad' => 'nullable|exists:ctl_especialidad,id',
            'num_registro'    => 'nullable|string|max:50|unique:mnt_doctor,num_registro,' . $id,
            'foto'            => 'nullable|string|max:255',
            'id_usuario'      => 'nullable|exists:users,id',
            'estado'          => 'sometimes|boolean',
        ]);

        $doctor->update($request->only([
            'nombre', 'apellido', 'id_especialidad',
            'num_registro', 'foto', 'id_usuario', 'estado'
        ]));

        return response()->json(['message' => 'Doctor actualizado correctamente', 'data' => $doctor]);
    }

    public function destroy($id)
    {
        $doctor = MntDoctor::findOrFail($id);
        $doctor->update(['estado' => false]);

        return response()->json(['message' => 'Doctor desactivado correctamente']);
    }
}
