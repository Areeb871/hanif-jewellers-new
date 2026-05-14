<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckoutLead extends Model
{
    
    protected $fillable = [
        'user_id','session_id','order_id',
        'title','first_name','last_name','email','phone',
        'address1','address2','city','state','zip_code',
        'delivery_option','checkout_step',
        'is_converted','last_activity_at','last_reason'
    ];

    protected $casts = [
        'is_converted' => 'boolean',
        'last_activity_at' => 'datetime',
    ];
     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function items()
    {
        return $this->hasMany(CheckoutLeadItem::class, 'checkout_lead_id');
    }
}
