<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;

class indexController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view("index" );
    }
}
