<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslateableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MPorto extends Model implements TranslateableContract
{
    use HasFactory, Translatable;

    protected $table = 'm_portos';
    protected $translationModel = Porto::class;
    protected $fillable = [
        'user_id'
    ];

    public $translatedAttributes = [
        'title',
        'short_desc',
        'description',
    ];
}
