<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MntDoctor extends Model
{
    protected $table = 'mnt_doctor';
    protected $fillable = [
        'nombre', 'apellido', 'id_especialidad',
        'num_registro', 'foto', 'estado', 'id_usuario'
    ];

    public function especialidad()
    {
        return $this->belongsTo(CtlEspecialidad::class, 'id_especialidad');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function citas()
    {
        return $this->hasMany(MntCita::class, 'id_doctor');
    }

    public function recetas()
    {
        return $this->hasMany(MntReceta::class, 'id_doctor');
    }
}
