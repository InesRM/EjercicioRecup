<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtributesUsers extends Model
{
    use HasFactory;
    protected $table = 'atributes_users'; //Por defecto tomaría la tabla 'personas'.
    protected $primaryKey = ['atributeID', 'userID'];  //Por defecto el campo clave es 'id', entero y autonumérico.
    public $incrementing = false; //Para indicarle que la clave no es autoincremental.
    protected $keyType = ['unsignedBigInteger', 'unsignedBigInteger'];   //Indicamos que la clave no es entera.
    public $timestamps = true;

    protected $fillable = [
        'atributeID',
        'userID',
        'value',
    ];

    public function atributos2(){
            return $this->hasMany(Atributes::class, 'ID','atributeID');

    }
}
