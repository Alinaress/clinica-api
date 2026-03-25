<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CtlMedicamento extends Model
{
    protected $table = 'ctl_medicamento';
    protected $fillable = ['nombre', 'descripcion', 'presentacion', 'estado'];

    public function recetas()
    {
        return $this->hasMany(MntReceta::class, 'id_medicamento');
    }
}
