<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;
class CheckoutController extends Controller
{
    public function login_checkout(){
        $category = DB::table('category')->where('category_status','1')->orderBy("category_id","desc")->get();
        $brand = DB::table('brand')->where('brand_status','1')->orderBy("brand_id","desc")->get();
        return view('pages.checkout.login_checkout')
        ->with('category',$category)->with('brand',$brand);
    }
    public function add_customer(Request $request){
        $data = array();
        $data['customer_name'] = $request->name;
        $data['customer_email'] = $request->email;
        $data['customer_phone'] = $request->phone;
        $data['customer_password'] = md5($request->password);

        $customer_id = DB::table('customer')->insertGetId($data);
        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request->name);
        return Redirect::to('/checkout');
    }
    public function checkout(){
        $category = DB::table('category')->where('category_status','1')->orderBy("category_id","desc")->get();
        $brand = DB::table('brand')->where('brand_status','1')->orderBy("brand_id","desc")->get();
        return view('pages.checkout.show_checkout')
        ->with('category',$category)->with('brand',$brand);
    }
    public function save_checkout_customer(Request $request){
        $data = array();
        $data['shipping_name'] = $request->name;
        $data['shipping_phone'] = $request->phone;
        $data['shipping_note'] = $request->note;
        $data['shipping_address'] = $request->address;

        $shipping_id = DB::table('shipping')->insertGetId($data);
        Session::put('shipping_id',$shipping_id);
       

        return Redirect::to('/payment');    //quay lại trang thanh toán
    }
    //trả về trang thanh toán
    public function payment(){
        $category = DB::table('category')->where('category_status','1')->orderBy("category_id","desc")->get();
        $brand = DB::table('brand')->where('brand_status','1')->orderBy("brand_id","desc")->get();
        return view('pages.checkout.payment')
        ->with('category',$category)->with('brand',$brand);
    }

    public function logout_checkout(){
        Session::flush();
        return Redirect('/login-checkout');
    }

    public function login_customer(Request $request){
       
        $email = $request->email_account;
        $password = md5($request->password_account);

        $result = DB::table('customer')->where('customer_email',$email)->where('customer_password',$password)
                                    ->first();

         Session::put('customer_id',$result->customer_id); 
        if($result){
            return Redirect('/checkout');
        }
        else{
            return Redirect('/login-checkout');
        }

         
                         
         
    }

    public function manage_order(){
        return view('admin.manage_order');
    }

    //insert dữ liệu vào bảng payment
    public function phuongthucthanhtoan(Request $request){
        //insert payment_method
        $data = array();
        $data['payment_method'] = $request->payment_op;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('payment')->insertGetId($data);

        //insert vào bảng order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');  //khi đăng nhập sẽ có customer_id
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lý';

        $order_id = DB::table('order')->insertGetId($order_data);

        //insert vào bảng order detail;
        

        $content= Cart::content();
        //$content được lấy ra nhở vapf Cart có lưu thông tin các sp thêm vào giỏ hàng
        foreach($content as $value){
            $orderDetail_data['order_id'] =  $order_id;  //khi đăng nhập sẽ có customer_id
            $orderDetail_data['product_id'] = $value->id;
            $orderDetail_data['product_name'] = $value->name;
            $orderDetail_data['product_price'] = $value->price;
            $orderDetail_data['product_qty'] = $value->qty;
           
            DB::table('order_detail')->insert($orderDetail_data);
            
        }
        //
        if($data['payment_method'] == 0){   //bằng 0 là thanh toán bằng khi nhận hàng
            Cart::destroy(); //xóa các sp trong giỏ hàng sau khi thanh toán xong
            $category = DB::table('category')->where('category_status','1')->orderBy("category_id","desc")->get();
             $brand = DB::table('brand')->where('brand_status','1')->orderBy("brand_id","desc")->get();
            return view('pages.checkout.handcash')->with('category',$category)->with('brand',$brand);
        }elseif($data['payment_method'] == 1){
            echo'Thanh toán online';
        }
       

    }
}
