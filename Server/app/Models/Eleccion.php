<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleccion extends Prueba
{

    protected $table = 'eleccion';
    protected $primaryKey = 'idprueba';
    public $incrementing = false;
    protected $keyType = 'bigint';
    public $timestamps = false;

    protected $fillable = [
        'idprueba',
        'pregunta',
        'correcta',
        'incorrecta',
        'habilidad',
    ];

    public function prueba(){
        return $this->belongsTo('App\Models\Prueba', 'idprueba', 'id');
    }

}
