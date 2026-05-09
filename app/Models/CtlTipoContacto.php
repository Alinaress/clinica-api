<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CtlTipoContacto extends Model
{
    protected $table = 'ctl_tipo_contacto';
    protected $fillable = ['nombre', 'estado'];

    public function contactos()
    {
        return $this->hasMany(MntContacto::class, 'id_tipo_contacto');
    }
}
