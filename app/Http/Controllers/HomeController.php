<?php

namespace App\Http\Controllers;
@include('sweetalert::alert');
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;
class HomeController extends Controller
{
    public function index(Request $request){
        $category = DB::table('category')->where('category_status','1')->orderBy("category_id","desc")->get();
        $brand = DB::table('brand')->where('brand_status','1')->orderBy("brand_id","desc")->get();

      
        $search = $request->keyword_sub ?? '';
        $all_product = DB::table('product')
                ->where('product_status','1')
                ->leftJoin('promotional_products','product.product_id','promotional_products.product_id')
                ->leftJoin('coupon','promotional_products.coupon_id','coupon.coupon_id')
                ->where('product.product_name','like',"%$search%")
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
       $all_order = DB::table('order')->join('customer','order.customer_id', '=','customer.customer_id')
              
              ->where('customer.customer_id',$customer_id)
              
              ->select('order.*','customer.customer_name')
              ->orderBy('order.order_id','desc')
            ->get();
            return view('pages.user.profile_user')->with('profile',$profile)
                                            ->with('category',$category)
                                            ->with('brand',$brand)
                                            ->with('profile_shipping',$profile_shipping)
                                            ->with('all_order',$all_order);
    }

        //lịch dử đơn đặt hàng
        public function show_order_account($customer_id){
        $category = DB::table('category')->where('category_status','1')->orderBy("category_id","desc")->get();
        $brand = DB::table('brand')->where('brand_status','1')->orderBy("brand_id","desc")->get();

        $order_id = DB::table('order')->where('order.customer_id',$customer_id)->select('order.order_id')->get();
        // $new = $order_id->order_id;
        $order_id = $order_id->map(function ($item){
            return get_object_vars($item);
        });
        // echo $order_id;
        // $order_id = array_unique($order_id);
        $product_of_order = [];
        foreach($order_id as $id){
            $product = DB::table('order_detail')->where('order_detail.order_id',$id)
            ->join('product','order_detail.product_id','product.product_id')
            ->select('product.product_image','order_detail.price','order_detail.product_name',
            'order_detail.product_qty','order_detail.product_id','order_detail.order_id')->get();
          
            $product_of_order[] =  $product;
        };
        $all_order = DB::table('order')->join('customer','order.customer_id', '=','customer.customer_id')
              
              ->where('customer.customer_id',$customer_id)
             
              ->select('order.*')
              
              ->orderBy('order.order_id')
            ->get();
        
        return view('pages.user.order_history')->with('category',$category)->with('brand',$brand)->with('product_of_order',$product_of_order)
        ->with('order_id',$order_id)
        ->with('all_order',$all_order);
    }
}