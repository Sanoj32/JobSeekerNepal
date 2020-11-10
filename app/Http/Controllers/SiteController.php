<?php

namespace App\Http\Controllers;

class SiteController extends Controller
{
    public function faqs()
    {
        return view('faqs');
    }
    public function test()
    {
        return view('test');
    }
    public function references()
    {
        return view('references');
    }

}
