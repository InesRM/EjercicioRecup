<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuariosAsignados extends Model
{
    use HasFactory;

    protected $table = 'usuarios_asignados';
    protected $primaryKey = ['idprueba','idusuario'];
    public $incrementing = false;
    protected $keyType = 'bigint';
    public $timestamps = false;

    protected $fillable = [
        'idprueba',
        'idusuario'
    ];
}
