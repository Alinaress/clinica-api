<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    protected $fillable = ['nombre', 'modulo', 'descripcion', 'estado'];

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'role_has_permissions', 'id_permission', 'id_rol');
    }
}
