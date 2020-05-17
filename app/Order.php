<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'id','service_id', 'customer_id','notes','price', 'payment_status','payment_via','payment_bank_id','payment_date','status'
    ];
}