<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacante extends Model
{
    use SoftDeletes;

    protected $table = 'vacantes';

    protected $fillable = [
        'titulo_puesto',
        'descripcion_puesto',
        'salario_minimo',
        'salario_maximo',
        'ubicacion',
        'unidad_id',
        'modalidad_trabajo_id',
        'user_crea_id',
        'estado_vacante_id',
    ];

    public function unidad()
    {
        return $this->belongsTo(Unidad::class);
    }

    public function modalidadTrabajo()
    {
        return $this->belongsTo(ModalidadTrabajo::class);
    }

    public function estadoVacante()
    {
        return $this->belongsTo(EstadoVacante::class);
    }

    public function usuarioCreador()
    {
        return $this->belongsTo(User::class, 'user_crea_id');
    }

    public function postulaciones()
    {
        return $this->hasMany(Postulacion::class, 'vacante_id');
    }
}
