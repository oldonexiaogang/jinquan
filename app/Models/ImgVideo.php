<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImgVideo extends Model
{
    //
    protected $fillable = ['url','user_id','is_show'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
