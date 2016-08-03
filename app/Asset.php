<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = ['name','reference','user_id','size','private'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
