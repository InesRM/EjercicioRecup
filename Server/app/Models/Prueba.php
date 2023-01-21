<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    use HasFactory;

    protected $table = 'prueba';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'destino',
        'iddios',
        'pregunta',
        'tipo'
    ];

    public function pruebaEleccion(){
        return $this->belongsTo('App\Models\Eleccion','id','idprueba');
    }

    public function pruebaValoracion(){
        return $this->belongsTo('App\Models\Valoracion','id','idprueba');
    }

    public function pruebaRespLibre(){
        return $this->belongsTo('App\Models\RespLibre','id','idprueba');
    }

    public function pruebaPuntual(){
        return $this->belongsTo('App\Models\Puntual','id','idprueba');
    }


}
