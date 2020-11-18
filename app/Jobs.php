<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    protected $guarded = [''];

    public function viewedbyusers()
    {
        return $this->belongsToMany(User::class);
    }
    public function savedbyusers()
    {
        return $this->belongsToMany(Jobs::class, 'saved_jobs');
    }
}
