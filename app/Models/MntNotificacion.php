<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MntNotificacion extends Model
{
    protected $table = 'mnt_notificacion';
    protected $fillable = [
        'id_usuario', 'id_cita', 'titulo', 'mensaje',
        'tipo', 'leida', 'enviada_email', 'enviada_at'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function cita()
    {
        return $this->belongsTo(MntCita::class, 'id_cita');
    }
}
