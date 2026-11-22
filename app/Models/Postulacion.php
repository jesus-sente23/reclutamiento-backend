<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    protected $table = 'postulaciones';

    protected $fillable = [
        'candidato_id',
        'vacante_id',
        'estado_postulacion_id',
        'fuente_reclutamiento_id',
        'user_crea_id',
        'fecha_postulacion',
    ];

    protected function casts(): array
    {
        return [
            'fecha_postulacion' => 'date:Y-m-d',
        ];
    }

    public function candidato()
    {
        return $this->belongsTo(Candidato::class);
    }

    public function vacante()
    {
        return $this->belongsTo(Vacante::class);
    }

    public function estadoPostulacion()
    {
        return $this->belongsTo(EstadoPostulacion::class);
    }

    public function fuenteReclutamiento()
    {
        return $this->belongsTo(FuenteReclutamiento::class);
    }

    public function usuarioCreador()
    {
        return $this->belongsTo(User::class, 'user_crea_id');
    }
}
