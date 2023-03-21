<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        // trong laravel khong sdung / ma su dung .
        return view('pages.home');
    }
}
