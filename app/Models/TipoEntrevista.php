<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoEntrevista extends Model
{
    use SoftDeletes;

    protected $table = 'tipos_entrevista';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function entrevistas()
    {
        return $this->hasMany(
            Entrevista::class,
            'tipo_entrevista_id'
        );
    }
}
