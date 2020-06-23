<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MrOrder extends Model
{
    //
    protected $fillable = [
        'mr_user_id','ms_user_id','ms_publish_id','total_amount','amount','days','staus','review','rating'
    ];
}
