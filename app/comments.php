<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    protected $guarded = [''];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function jobs()
    {
        return $this->belongsTo(Jobs::class);
    }
}
