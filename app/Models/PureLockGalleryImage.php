<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PureLockGalleryImage extends Model
{
    protected $table = 'pure_lock_gallery_images';
    protected $fillable = ['image', 'display_order', 'is_active'];
    protected $hidden = ['created_at', 'updated_at'];
}

