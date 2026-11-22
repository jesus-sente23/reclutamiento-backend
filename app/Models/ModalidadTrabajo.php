<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModalidadTrabajo extends Model
{
    use SoftDeletes;

    protected $table = 'modalidades_trabajo';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function vacantes()
    {
        return $this->hasMany(Vacante::class, 'modalidad_trabajo_id');
    }
}
