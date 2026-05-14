<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubcatImages extends Model
{
    protected $table = 'subcat_images';
    protected $fillable = ['sub_category_id', 'image'];
    protected $hidden = ['created_at', 'updated_at'];
}
