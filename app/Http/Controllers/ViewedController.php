<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


use App\Jobs;
use Illuminate\Http\Request;

class ViewedController extends Controller
{
    public function store(Jobs $jobs){
          return  auth()->user()->viewedjobs()->toggle($jobs);
    }
}
