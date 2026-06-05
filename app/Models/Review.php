<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'main_title',
        'title',
        'description',
        'image',
        'images',
        'status',
    ];

    protected $casts = [
        'images' => 'array',
        'status' => 'boolean',
    ];
}
