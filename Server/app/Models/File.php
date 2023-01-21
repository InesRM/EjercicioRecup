<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
class File extends Model
{
    protected $table = 'files';
    protected $primaryKey = 'id';
    protected $foreignKey = 'userID';

    use HasFactory;
    protected $fillable = [
        'userID',
        'name',
        'url',
    ];

    public function getUrlPathAttribute()
    {
        return Storage::url($this->url);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
