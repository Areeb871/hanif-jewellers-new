<?php

namespace App\Models;

use App\Models\Concerns\HasUaeDescription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingPolicy extends Model
{
    use HasFactory;
    use HasUaeDescription;

    protected $table = 'shipping_policy';

    protected $fillable = [
        'slug',
        'title',
        'description',
        'uae_description',
    ];
}


