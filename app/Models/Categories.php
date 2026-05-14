<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name', 'slug', 'description', 'image', 'status', 'meta_title', 'meta_description', 'meta_keywords', 'banner_type', 'banner_url'];
    protected $hidden = ['created_at', 'updated_at'];
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class, 'category_id');
    }

}

