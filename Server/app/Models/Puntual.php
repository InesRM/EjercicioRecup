<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puntual extends Prueba
{
    use HasFactory;

    protected $table = 'puntual';
    protected $primaryKey = 'idprueba';
    public $incrementing = false;
    protected $keyType = 'bigint';
    public $timestamps = false;

    protected $fillable = [
        'idprueba',
        'descripcion',
        'habilidad',
        'porcentaje',
    ];

    public function prueba(){
        return $this->belongsTo('App\Models\Prueba', 'idprueba', 'id');
    }
}
