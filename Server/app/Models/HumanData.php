<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HumanData extends Model
{
    use HasFactory;

    protected $fillable = [
        'ID',
        'destino',
        'protection',
    ];

    public function usuario(){
        return $this->hasMany('App\Models\User', 'ID', 'id');
    }
}
