<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CtlGrupoSanguineo extends Model
{
    protected $table = 'ctl_grupo_sanguineo';
    protected $fillable = ['nombre', 'estado'];

    public function pacientes()
    {
        return $this->hasMany(MntPaciente::class, 'id_grupo_sanguineo');
    }
}
