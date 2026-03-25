<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CtlEstadoCita extends Model
{
    protected $table = 'ctl_estado_cita';
    protected $fillable = ['nombre', 'color', 'estado'];

    public function citas()
    {
        return $this->hasMany(MntCita::class, 'id_estado_cita');
    }
}
