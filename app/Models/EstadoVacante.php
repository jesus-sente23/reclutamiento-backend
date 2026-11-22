<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstadoVacante extends Model
{
    use SoftDeletes;

    protected $table = 'estados_vacante';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function vacantes()
    {
        return $this->hasMany(Vacante::class, 'estado_vacante_id');
    }
}
