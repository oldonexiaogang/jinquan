<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    //
    protected $fillable = [
        'mr_order_id','mr_user_id','total_amount','amount','is_pay','ms_user_id'
    ];
}
