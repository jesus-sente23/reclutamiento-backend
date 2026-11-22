<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unidad extends Model
{
    use SoftDeletes;

    protected $table = 'unidades';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function vacantes()
    {
        return $this->hasMany(Vacante::class, 'unidad_id');
    }
}
