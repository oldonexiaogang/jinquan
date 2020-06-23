<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsPublish extends Model
{
    //
    protected $fillable = [
        'price','is_show','is_abutment'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
