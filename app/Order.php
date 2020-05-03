<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'service_id', 'customer_id','price', 'payment_status','payment_via','payment_bank_id','payment_date','status'
    ];
}