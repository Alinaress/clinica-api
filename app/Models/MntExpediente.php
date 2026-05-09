<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MntExpediente extends Model
{
    protected $table = 'mnt_expediente';
    protected $fillable = [
        'id_paciente', 'numero_expediente',
        'fecha_apertura', 'antecedentes', 'observaciones', 'estado'
    ];

    public function paciente()
    {
        return $this->belongsTo(MntPaciente::class, 'id_paciente');
    }

    public function diagnosticos()
    {
        return $this->hasMany(MntDiagnostico::class, 'id_expediente');
    }
}
