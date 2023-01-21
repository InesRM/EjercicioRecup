<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valoracion extends Prueba
{
    use HasFactory;

    protected $table = 'valoracion';
    protected $primaryKey = 'idprueba';
    public $incrementing = false;
    protected $keyType = 'bigint';
    public $timestamps = false;

    protected $fillable = [
        'idprueba',
        'pregunta',
        'habilidad',
    ];

    public function prueba(){
        return $this->belongsTo('App\Models\Prueba', 'idprueba', 'id');
    }
}
