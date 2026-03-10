<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id_rol');
    }
}
