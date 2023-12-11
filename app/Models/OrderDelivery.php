<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDelivery extends Model
{
    use HasFactory;

    protected $table = 'delivery_order';

    protected $fillable = [
        'delivery_id','cart_id','order_id','seen_time','order_status',
        'current_location',
        'order_location','order_delivery_time'    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }
}