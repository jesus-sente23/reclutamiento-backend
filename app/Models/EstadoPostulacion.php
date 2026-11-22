<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoPostulacion extends Model
{
    protected $table = 'estados_postulacion';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function postulaciones()
    {
        return $this->hasMany(Postulacion::class);
    }
}
