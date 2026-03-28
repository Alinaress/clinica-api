<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MntPaciente;
use Illuminate\Http\Request;

class MntPacienteController extends Controller
{
    public function registro(Request $request)
    {
        $request->validate([

        'nombre'            => 'required|string|max:100',
        'apellido'          => 'required|string|max:100',
        'dui'               => 'nullable|string|max:10|unique:mnt_paciente,dui',
        'id_genero'         => 'nullable|exists:ctl_genero,id',
        'id_grupo_sanguineo'=> 'nullable|exists:ctl_grupo_sanguineo,id',
        'fecha_nacimiento'  => 'nullable|date',
        'alergias'          => 'nullable|string',
        'email'             => 'required|email|unique:users,email',
        'password'          => 'required|string|min:6|confirmed',
        'nickname'          => 'required|string|max:50|unique:users,nickname',

        ]);

        //usuario

        $usuario = \App\Models\User::create([
        'nickname' => $request->nickname,
        'email'    => $request->email,
        'password' => $request->password,
        'id_rol'   => 4, // paciente
        ]);

        //paciente vinculado al usuario
        $paciente = MntPaciente::create([
        'nombre'             => $request->nombre,
        'apellido'           => $request->apellido,
        'dui'                => $request->dui,
        'id_genero'          => $request->id_genero,
        'id_grupo_sanguineo' => $request->id_grupo_sanguineo,
        'fecha_nacimiento'   => $request->fecha_nacimiento,
        'alergias'           => $request->alergias,
        'estado'             => true,
        'id_usuario'         => $usuario->id,
        ]);

        $token = $usuario->createToken('auth_token')->plainTextToken;

        return response()->json([
        'message'  => 'Registro exitoso',
        'token'    => $token,
        'usuario'  => $usuario,
        'paciente' => $paciente,
        ], 201);
    }
    public function index()
    {
        $pacientes = MntPaciente::with(['genero', 'grupoSanguineo', 'contactos', 'direcciones'])
            ->where('estado', true)
            ->orderBy('apellido')
            ->get();

        return response()->json(['data' => $pacientes]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'            => 'required|string|max:100',
            'apellido'          => 'required|string|max:100',
            'dui'               => 'nullable|string|max:10|unique:mnt_paciente,dui',
            'id_genero'         => 'nullable|exists:ctl_genero,id',
            'id_grupo_sanguineo'=> 'nullable|exists:ctl_grupo_sanguineo,id',
            'fecha_nacimiento'  => 'nullable|date',
            'alergias'          => 'nullable|string',
        ]);

        $paciente = MntPaciente::create([
            'nombre'             => $request->nombre,
            'apellido'           => $request->apellido,
            'dui'                => $request->dui,
            'id_genero'          => $request->id_genero,
            'id_grupo_sanguineo' => $request->id_grupo_sanguineo,
            'fecha_nacimiento'   => $request->fecha_nacimiento,
            'alergias'           => $request->alergias,
            'estado'             => true,
            'id_usuario' => request()->user()->id,
        ]);

        return response()->json(['message' => 'Paciente creado correctamente', 'data' => $paciente], 201);
    }

    public function show($id)
    {
        $paciente = MntPaciente::with([
            'genero',
            'grupoSanguineo',
            'contactos.tipoContacto',
            'direcciones',
            'expediente',
            'citas.estadoCita',
            'citas.doctor'
        ])->findOrFail($id);

        return response()->json(['data' => $paciente]);
    }

    public function update(Request $request, $id)
    {
        $paciente = MntPaciente::findOrFail($id);

        $request->validate([
            'nombre'             => 'sometimes|string|max:100',
            'apellido'           => 'sometimes|string|max:100',
            'dui'                => 'nullable|string|max:10|unique:mnt_paciente,dui,' . $id,
            'id_genero'          => 'nullable|exists:ctl_genero,id',
            'id_grupo_sanguineo' => 'nullable|exists:ctl_grupo_sanguineo,id',
            'fecha_nacimiento'   => 'nullable|date',
            'alergias'           => 'nullable|string',
            'estado'             => 'sometimes|boolean',
        ]);

        $paciente->update($request->only([
            'nombre', 'apellido', 'dui', 'id_genero',
            'id_grupo_sanguineo', 'fecha_nacimiento', 'alergias', 'estado'
        ]));

        return response()->json(['message' => 'Paciente actualizado correctamente', 'data' => $paciente]);
    }

    public function destroy($id)
    {
        $paciente = MntPaciente::findOrFail($id);
        $paciente->update(['estado' => false]);

        return response()->json(['message' => 'Paciente desactivado correctamente']);
    }
}
