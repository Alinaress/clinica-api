<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CtlEspecialidad extends Model
{
    protected $table = 'ctl_especialidad';
    protected $fillable = ['nombre', 'estado'];

    public function doctores()
    {
        return $this->hasMany(MntDoctor::class, 'id_especialidad');
    }
}
