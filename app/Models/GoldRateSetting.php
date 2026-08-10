<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoldRateSetting extends Model
{
    protected $table = 'gold_rate_settings';

    protected $fillable = [
        'karat',
        'gold_rate_per_gram',
        'vat_percent',
        'is_active',
    ];
}
