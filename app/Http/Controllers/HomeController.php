<?php

namespace App\Http\Controllers;
@include('sweetalert::alert');
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;
class HomeController extends Controller
{
    public function index(){
        $category = DB::table('category')->where('category_status','1')->orderBy("category_id","desc")->get();
        $brand = DB::table('brand')->where('brand_status','1')->orderBy("brand_id","desc")->get();

       /*  $all_product = DB::table('product')->join('category','product.category_id', '=','category.category_id')
        ->join('brand','product.brand_id', '=','brand.brand_id')  
        ->select('product.*','category.category_name','brand.brand_name')
        ->get(); */

        $all_product = DB::table('product')->where('product_status','1')->orderBy("product_id","desc")->limit(4)->get();

        return view('pages.home')->with('category',$category)->with('brand',$brand)->with('all_product',$all_product);
    }
}
