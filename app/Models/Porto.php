<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Porto extends Model
{
    use HasFactory;

    protected $table = 'portos';
    protected $fillable = [
        'title',
        'short_desc',
        'description',
        'photo',
        'link',
        'user_id',
    ];
}
