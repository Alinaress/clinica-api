<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MntCita extends Model
{
    protected $table = 'mnt_cita';
    protected $fillable = [
        'id_paciente', 'id_doctor', 'id_estado_cita',
        'fecha_hora', 'duracion_min', 'motivo',
        'notas', 'id_usuario_creacion'
    ];

    public function paciente()
    {
        return $this->belongsTo(MntPaciente::class, 'id_paciente');
    }

    public function doctor()
    {
        return $this->belongsTo(MntDoctor::class, 'id_doctor');
    }

    public function estadoCita()
    {
        return $this->belongsTo(CtlEstadoCita::class, 'id_estado_cita');
    }

    public function usuarioCreacion()
    {
        return $this->belongsTo(User::class, 'id_usuario_creacion');
    }

    public function notificaciones()
    {
        return $this->hasMany(MntNotificacion::class, 'id_cita');
    }

    public function recetas()
    {
        return $this->hasMany(MntReceta::class, 'id_cita');
    }

    public function diagnosticos()
    {
        return $this->hasMany(MntDiagnostico::class, 'id_cita');
    }
}
