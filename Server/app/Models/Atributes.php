<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atributes extends Model
{
    use HasFactory;

    protected $table = 'atributes';
    protected $primaryKey = 'ID';
    public $incrementing = true;
    protected $keyType = 'integer';  

    protected $fillable = [
        'name',
    ];
}
