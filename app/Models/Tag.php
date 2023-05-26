<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $fillable = [
        'name',
        'jumlah_porto'
    ];

    public function portos(){
        return $this->belongsToMany(Porto::class, 'tags_porto', 'tag_id', 'porto_id');
    }
}
