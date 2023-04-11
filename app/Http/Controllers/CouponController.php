<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class CouponController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }
        else{
            return Redirect::to('admin')->send();
        }
}
   public function all_coupon(){
    $all_coupon = DB::table('coupon')->get();
    return view('admin.khuyenmai')->with('all_coupon',$all_coupon);
   }
   //thêm khuyến mãi
   public function add_coupon(){
   
    return view('admin.add_coupon');
   }

   //lưu thông tin km vào csdl
      public function save_coupon(Request $request){
    $this->AuthLogin();
    $request->validate([
        
        'coupon_name'=> 'required',
        'coupon_value' => 'required|numeric',
        'coupon_start'=> 'required',
        'coupon_end'=> 'required',
    ],
    [
      
        "coupon_name.required"=>"Trường này không được bỏ trống",
        "coupon_value.required"=>"Trường này không được bỏ trống",
       
        "coupon_end.required"=>"Trường này không được bỏ trống",
        "coupon_start.required"=>"Trường này không được bỏ trống",
       
    ]);

    $data = [];
    $data['coupon_name'] = $request->coupon_name;
    $data['coupon_desc'] = $request->coupon_desc;
    $data['coupon_value'] = round($request->coupon_value/100,2);
    $data['coupon_start'] = $request->coupon_start;
    $data['coupon_end'] = $request->coupon_end;
    DB::table('coupon')->insert($data);
    return Redirect::to('add-coupon')->with('success',"Thêm khuyển mãi thành công.");
   }

   //hiển thị trang edit km
   public function edit_coupon($coupon_id){
        $this->AuthLogin();
        $coupon = DB::table('coupon')->where('coupon.coupon_id',$coupon_id)->get();

        return view('admin.edit_coupon')->with('coupon',$coupon);
   }
   public function update_coupon(Request $request,$coupon_id){
    $this->AuthLogin();
    $request->validate([
        
        'coupon_name'=> 'required',
        'coupon_value' => 'required|numeric',
        'coupon_start'=> 'required',
        'coupon_end'=> 'required',
    ],
    [
      
        "coupon_name.required"=>"Trường này không được bỏ trống",
        "coupon_value.required"=>"Trường này không được bỏ trống",
       
        "coupon_end.required"=>"Trường này không được bỏ trống",
        "coupon_start.required"=>"Trường này không được bỏ trống",
       
    ]);

    $data = [];
    $data['coupon_name'] = $request->coupon_name;
    $data['coupon_desc'] = $request->coupon_desc;
    $data['coupon_value'] = round($request->coupon_value/100,2);
    $data['coupon_start'] = $request->coupon_start;
    $data['coupon_end'] = $request->coupon_end;
    DB::table('coupon')->where('coupon_id',$coupon_id)->update($data);
    return Redirect::to('all-coupon')->with('success',"Cập nhật khuyến mãi thành công.");
   }

   public function delete_coupon(Request $request){
    $this->AuthLogin();
        DB::table('coupon')->where('coupon_id',$request->product_id)->delete();
        return Redirect::to('all-coupon');
   }
   public function apply_coupon(){
    $this->AuthLogin();
    // $products = DB::table('product')->get();
    $coupons = DB::table('coupon')
                ->get();
    $product_coupon = DB::table('product')
                    ->leftJoin('promotional_products','product.product_id','=','promotional_products.product_id')
                    ->leftJoin('coupon','promotional_products.coupon_id','=','coupon.coupon_id')
                    ->select('product.*','coupon.coupon_name','promotional_products.price_final')
                    ->get();
    return view('admin.apply_coupon')
                    ->with('coupons',$coupons)->with('product_coupon',$product_coupon)
                 ;
   }

   public function save_coupon_product(Request $request){
    $this->AuthLogin();
        $data['product_id'] = $request->id_product;
        
        $data['coupon_id'] = $request->coupon_id;
       
        $price = DB::table('product')->where('product.product_id',$request->id_product)
        ->select('product.product_price')
        ->first();
    
        $coupon_value = DB::table('coupon')->where('coupon.coupon_id',$request->coupon_id)
        ->select('coupon.coupon_value')
        ->first();
        $data['price_final'] =$price->product_price * (1- $coupon_value->coupon_value);
        DB::table('promotional_products')->insert($data);
     

        return Redirect::to('apply-coupon');    
       
   }
}
