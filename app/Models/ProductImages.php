<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    protected $table = 'product_images';
    protected $fillable = ['product_id', 'image'];
    protected $hidden = ['created_at', 'updated_at'];
}
