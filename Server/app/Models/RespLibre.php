<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespLibre extends Prueba
{
    use HasFactory;

    protected $table = 'resplibre';
    protected $primaryKey = 'idprueba';
    public $incrementing = false;
    protected $keyType = 'bigint';
    public $timestamps = false;

    protected $fillable = [
        'idprueba',
        'pregunta',
        'palabrasclaves',
        'porcentaje',
    ];

    public function prueba(){
        return $this->belongsTo('App\Models\Prueba', 'idprueba', 'id');
    }
}
