<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagPorto extends Model
{
    use HasFactory;
    protected $table = 'tags_porto';
    protected $fillable = [
        'tag_id',
        'porto_id'
    ];
}

