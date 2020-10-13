<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    protected $guarded = [''];
    public function comments()
    {
        return $this->hasMany(comments::class);
    }
}
