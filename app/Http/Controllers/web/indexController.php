<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;

class indexController extends Controller
{
    public function index(){
        return view("index" );
    }
    public function unauthorized(){
        return view("unauthorized" );
    }
}