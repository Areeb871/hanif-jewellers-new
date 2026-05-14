<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $table = 'tags';
    protected $fillable = ['name', 'slug'];
    protected $hidden = ['created_at', 'updated_at'];
    public function products()
{
    return $this->belongsToMany(Products::class, 'product_tags', 'tag_id', 'product_id');
}
}
