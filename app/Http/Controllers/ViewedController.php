<?php

namespace App\Http\Controllers;

use App\Jobs;
use Illuminate\Support\Facades\Auth;

class ViewedController extends Controller
{
    public function store(Jobs $jobs)
    {
        return auth()->user()->viewedjobs()->toggle($jobs);
    }
}
