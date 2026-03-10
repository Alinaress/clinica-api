<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MntReceta extends Model
{
    protected $table = 'mnt_receta';
    protected $fillable = [
        'id_cita', 'id_doctor', 'id_medicamento',
        'dosis', 'frecuencia', 'duracion', 'indicaciones'
    ];

    public function cita()
    {
        return $this->belongsTo(MntCita::class, 'id_cita');
    }

    public function doctor()
    {
        return $this->belongsTo(MntDoctor::class, 'id_doctor');
    }

    public function medicamento()
    {
        return $this->belongsTo(CtlMedicamento::class, 'id_medicamento');
    }
}
