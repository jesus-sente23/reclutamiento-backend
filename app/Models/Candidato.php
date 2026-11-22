<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    protected $table = 'candidatos';

    protected $fillable = [
        'nombre_completo',
        'correo_electronico',
        'telefono',
        'fecha_nacimiento',
        'expectativa_salarial',
    ];

    protected function casts(): array
    {
        return [
            'fecha_nacimiento' => 'date:Y-m-d',
            'expectativa_salarial' => 'decimal:2',
        ];
    }

    public function postulaciones()
    {
        return $this->hasMany(Postulacion::class, 'candidato_id');
    }
}
