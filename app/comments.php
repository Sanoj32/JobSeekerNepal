<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    protected $guarded = [''];
    public function user()
    {
        $this->belongsTo(User::class);
    }
    public function jobs()
    {
        $this->belongsTo(Jobs::class);
    }
}
