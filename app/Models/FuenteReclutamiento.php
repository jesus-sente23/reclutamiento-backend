<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuenteReclutamiento extends Model
{
    protected $table = 'fuentes_reclutamiento';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function postulaciones()
    {
        return $this->hasMany(Postulacion::class);
    }
}
