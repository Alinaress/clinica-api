<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CtlGenero extends Model
{
    protected $table = 'ctl_genero';
    protected $fillable = ['nombre', 'estado'];

    public function pacientes()
    {
        return $this->hasMany(MntPaciente::class, 'id_genero');
    }
}
