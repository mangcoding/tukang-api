<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    protected $fillable = [
        'order_id', 'status','description'
    ];

    public static function statusMessage($id) {
    	$status = ["New Order", "Order Accepted", "Barang di Pickup", "Sedang di Process", "Barang diantar ke customer", "Order selesai", "Order Cancel", "Order Refund"];
    	return $status[$id];
    }
}