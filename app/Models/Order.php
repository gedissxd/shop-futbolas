<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'terminal',
        'pickup_method',
        'payment',
        'status',
        'payment_intent_id'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
