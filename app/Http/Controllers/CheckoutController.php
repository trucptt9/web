<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;
class CheckoutController extends Controller
{
    public function manage_order(){
        return view('admin.manage_order');
    }
}
