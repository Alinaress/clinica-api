<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CtlTipoTratamiento extends Model
{
    protected $table = 'ctl_tipo_tratamiento';
    protected $fillable = ['nombre', 'descripcion', 'estado'];

    public function diagnosticos()
    {
        return $this->hasMany(MntDiagnostico::class, 'id_tipo_tratamiento');
    }
}
