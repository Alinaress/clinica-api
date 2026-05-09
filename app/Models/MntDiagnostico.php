<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MntDiagnostico extends Model
{
    protected $table = 'mnt_diagnostico';
    protected $fillable = [
        'id_cita', 'id_expediente', 'id_tipo_tratamiento',
        'sintomas', 'descripcion', 'observaciones'
    ];

    public function cita()
    {
        return $this->belongsTo(MntCita::class, 'id_cita');
    }

    public function expediente()
    {
        return $this->belongsTo(MntExpediente::class, 'id_expediente');
    }

    public function tipoTratamiento()
    {
        return $this->belongsTo(CtlTipoTratamiento::class, 'id_tipo_tratamiento');
    }
}
