<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MntContacto extends Model
{
    protected $table = 'mnt_contacto';
    protected $fillable = ['valor', 'id_tipo_contacto', 'id_paciente', 'estado'];

    public function tipoContacto()
    {
        return $this->belongsTo(CtlTipoContacto::class, 'id_tipo_contacto');
    }

    public function paciente()
    {
        return $this->belongsTo(MntPaciente::class, 'id_paciente');
    }
}
