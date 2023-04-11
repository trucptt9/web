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

        //$all_product = DB::table('product')->where('product_status','1')->orderBy("product_id","desc")->limit(8)->get();

        $all_product = DB::table('product')
                ->where('product_status','1')
                ->leftJoin('promotional_products','product.product_id','promotional_products.product_id')
                ->leftJoin('coupon','promotional_products.coupon_id','coupon.coupon_id')
                ->select('product.*','promotional_products.price_final','coupon.*')
                ->orderBy("product_id","desc")->limit(8)->get()
                
                ;
        return view('pages.home')->with('category',$category)->with('brand',$brand)->with('all_product',$all_product);
    }

    public function tim_kiem(Request $request){
        $category = DB::table('category')->where('category_status','1')->orderBy("category_id","desc")->get();
        $brand = DB::table('brand')->where('brand_status','1')->orderBy("brand_id","desc")->get();

        $keyword = $request->keyword_sub;
        
        //tìm theo nội dung có trong tên của sp
         $result = DB::table('product')->where('product_name','like','%'.$keyword.'%')->get();

        return view('pages.products.search')->with('category',$category)->with('brand',$brand)
        ->with('result',$result);
    }

    public function show_account($customer_id){
        $category = DB::table('category')->where('category_status','1')->orderBy("category_id","desc")->get();
        $brand = DB::table('brand')->where('brand_status','1')->orderBy("brand_id","desc")->get();


        $profile = DB::table('customer')
                ->where('customer.customer_id',$customer_id)
                ->get();
        $profile_shipping = DB::table('shipping')
                ->where('shipping.customer_id',$customer_id)
                ->select('shipping.*')
                ->get();
        $profile_full = DB::table('customer')
                ->where('customer.customer_id',$customer_id)
                ->join('shipping','customer.customer_id','=','shipping.customer_id')
                ->get();
            return view('pages.profile_user')->with('profile',$profile)
                                            ->with('category',$category)
                                            ->with('brand',$brand)
                                            ->with('profile_shipping',$profile_shipping)
                                            ->with('profile_full',$profile_full);
    }
}
