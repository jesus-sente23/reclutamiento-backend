<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entrevista extends Model
{
    use SoftDeletes;

    protected $table = 'entrevistas';

    protected $fillable = [
        'fecha_hora',
        'postulacion_id',
        'user_crea_id',
        'entrevistador_id',
        'tipo_entrevista_id',
        'resultado_entrevista_id',
        'observaciones',
    ];

    protected function casts(): array
    {
        return [
            'fecha_hora' => 'datetime:Y-m-d H:i:s',
        ];
    }

    public function postulacion()
    {
        return $this->belongsTo(Postulacion::class);
    }

    public function usuarioCreador()
    {
        return $this->belongsTo(User::class, 'user_crea_id');
    }

    public function entrevistador()
    {
        return $this->belongsTo(User::class, 'entrevistador_id');
    }

    public function tipoEntrevista()
    {
        return $this->belongsTo(
            TipoEntrevista::class,
            'tipo_entrevista_id'
        );
    }

    public function resultadoEntrevista()
    {
        return $this->belongsTo(
            ResultadoEntrevista::class,
            'resultado_entrevista_id'
        );
    }
}
