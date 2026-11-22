<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResultadoEntrevista extends Model
{
    use SoftDeletes;

    protected $table = 'resultados_entrevista';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function entrevistas()
    {
        return $this->hasMany(
            Entrevista::class,
            'resultado_entrevista_id'
        );
    }
}
