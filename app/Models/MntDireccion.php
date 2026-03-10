<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MntDireccion extends Model
{
    protected $table = 'mnt_direccion';
    protected $fillable = [
        'id_paciente', 'direccion', 'departamento',
        'municipio', 'referencia', 'estado'
    ];

    public function paciente()
    {
        return $this->belongsTo(MntPaciente::class, 'id_paciente');
    }
}
