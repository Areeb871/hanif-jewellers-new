<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
     protected $table = 'sub_categories';
    protected $fillable = ['name', 'category_id','slug', 'description', 'image', 'status', 'meta_title', 'meta_description', 'meta_keywords', 'banner_type', 'banner_url'];
    protected $hidden = ['created_at', 'updated_at'];
    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
    public function products()
    {
        return $this->hasMany(Products::class);
    }
    public function images() {
        return $this->hasMany(SubcatImages::class, 'sub_category_id');
    }


}
