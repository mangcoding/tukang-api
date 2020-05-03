<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogUser extends Model
{

	protected $table="log_user";
    protected $fillable = [
        'user_id', 'ip_address','macid','login_at','logout_at'
    ];

    public $timestamps = false;
}