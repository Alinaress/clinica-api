<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MntPaciente extends Model
{
    protected $table = 'mnt_paciente';
    protected $fillable = [
        'nombre', 'apellido', 'dui', 'id_genero',
        'id_grupo_sanguineo', 'fecha_nacimiento',
        'alergias','medicamentos_permanentes', 'estado', 'id_usuario'
    ];

    public function genero()
    {
        return $this->belongsTo(CtlGenero::class, 'id_genero');
    }

    public function grupoSanguineo()
    {
        return $this->belongsTo(CtlGrupoSanguineo::class, 'id_grupo_sanguineo');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function direcciones()
    {
        return $this->hasMany(MntDireccion::class, 'id_paciente');
    }

    public function contactos()
    {
        return $this->hasMany(MntContacto::class, 'id_paciente');
    }

    public function expediente()
    {
        return $this->hasOne(MntExpediente::class, 'id_paciente');
    }

    public function citas()
    {
        return $this->hasMany(MntCita::class, 'id_paciente');
    }
}
