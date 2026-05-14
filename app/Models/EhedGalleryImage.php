<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EhedGalleryImage extends Model
{
    protected $table = 'ehed_gallery_images';
    protected $fillable = ['image', 'display_order', 'is_active'];
    protected $hidden = ['created_at', 'updated_at'];
}
