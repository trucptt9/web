<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session;
class CartController extends Controller
{
    public function save_cart(Request $request){
        // $category = DB::table('category')->where('category_status','1')->orderBy("category_id","desc")->get();
        // $brand = DB::table('brand')->where('brand_status','1')->orderBy("brand_id","desc")->get();
        $productId = $request->productid_hidden;
        $quantity = $request->qty;
       
        $product_info = DB::table('product')->where('product.product_id',$productId)
                        ->leftJoin('promotional_products','product.product_id','promotional_products.product_id')
                        ->select('product.*','promotional_products.*')
                        ->first();
      
       $data['id'] = $productId;
       $data['idcode'] = $product_info->product_idcode;
       $data['qty'] = $quantity;
       $data['name'] = $product_info->product_name;
       $data['price'] = $request->price;
       $data['weight'] = '1';
       $data['options']['image'] = $product_info->product_image;
       
       Cart::add($data)
    ;
       return redirect()->route('home');
      
    }
    public function sell_cart(Request $request){
        // $category = DB::table('category')->where('category_status','1')->orderBy("category_id","desc")->get();
        // $brand = DB::table('brand')->where('brand_status','1')->orderBy("brand_id","desc")->get();
        $productId = $request->productid_hidden;
        $quantity = $request->qty;

        $product_info = DB::table('product')
             ->where('product.product_id',$productId)
            ->leftJoin('promotional_products','product.product_id','promotional_products.product_id')
           
            ->select('product.*','promotional_products.price_final')->first();
           
            // if($product_info->price_final == null){
            //     $data['price'] = $product_info->product_price;
            // }else{
            //     $data['price'] = $product_info->price_final;
            // }
        $data['id'] = $productId;
       $data['code'] = $product_info->product_idcode;
       $data['qty'] = $quantity;
       $data['name'] = $product_info->product_name;
       $data['price'] = $request->price_final;
       $data['weight'] = '1';
       $data['options']['image'] = $product_info->product_image;
       
    
       Cart::add($data);
       return to_route('show_cart');
      
    }
    public function show_cart(){
        $category = DB::table('category')->where('category_status','1')->orderBy("category_id","desc")->get();
        $brand = DB::table('brand')->where('brand_status','1')->orderBy("brand_id","desc")->get();

        return view('pages.cart.show_cart')
        ->with('category',$category)->with('brand',$brand)
        ;
    }
    public function delete_cart($rowId){
        Cart::update($rowId,0);     //nghĩa là xóa cái dòng đó đi dựa vào rowID hàm uodate đc bumbumment cung cấp
        return to_route('show_cart');
    }
  
}