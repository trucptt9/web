<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
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
    public function login_checkout(){
        $category = DB::table('category')->where('category_status','1')->orderBy("category_id","desc")->get();
        $brand = DB::table('brand')->where('brand_status','1')->orderBy("brand_id","desc")->get();
        return view('pages.checkout.login_checkout')
        ->with('category',$category)->with('brand',$brand);
    }
    public function add_customer(Request $request){
        $request->validate([
            'customer_name' => 'required',
            'customer_email'=> 'required|email|unique:customer,customer_email',
            'customer_phone'=> ['required',
                               'regex:/^(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))(\d)(\s|\.)?(\d{3})(\s|\.)?(\d{3})$/',
                               'unique:customer,customer_phone'],
             'customer_password' => 'required|confirmed',
        ],
        [
            "customer_name.required"=>"Vui lòng nhập họ tên",
            "customer_email.required"=>"Vui lòng nhập email",
            "customer_email.unique"=>"Email đã tồn tại",
            "customer_email.email"=>"Email có định dạng là `name@gmail.com`",
            "customer_phone.required"=>"Vui lòng nhập số điện thoại",
            "customer_phone.unique"=>"Số điện thoại đã tồn tại",
            "customer_phone.regex"=>"Số điện thoại không đúng định dạng",
            "customer_password.required"=>"Vui lòng nhập mật khẩu",
            "customer_password.confirmed"=>"Xác nhận mật khẩu sai",
        ]);
       
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_password'] = md5($request->customer_password);

        $customer_id = DB::table('customer')->insertGetId($data);
        Session::put('customer_id',$customer_id);
        Session::put('customer_name',$request->name);
        return Redirect::to('/trangchu');
    }
    public function checkout($customer_id){
        $category = DB::table('category')->where('category_status','1')->orderBy("category_id","desc")->get();
        $brand = DB::table('brand')->where('brand_status','1')->orderBy("brand_id","desc")->get();
        return view('pages.checkout.show_checkout')
        ->with('category',$category)->with('brand',$brand)
        ->with('customer_id',$customer_id);
    }
    public function save_checkout_customer(Request $request){
        // echo 'hello';
        $data = array();
        $data['customer_id'] = $request->customer_id;
        $data['shipping_name'] = $request->name;
        $data['shipping_phone'] = $request->phone;
        $data['shipping_note'] = $request->note;
        $data['shipping_address'] = $request->address;

        DB::table('shipping')->insert($data);
        
        $infor_shipping = DB::table('shipping')->where('shipping.customer_id',$request->customer_id)->first();
        $category = DB::table('category')->where('category_status','1')->orderBy("category_id","desc")->get();
        $brand = DB::table('brand')->where('brand_status','1')->orderBy("brand_id","desc")->get();
        return Redirect::to('/trangchu');
            
         //quay lại trang thanh toán
    }
    //trả về trang thanh toán
    public function payment($customer_id){
        $category = DB::table('category')->where('category_status','1')->orderBy("category_id","desc")->get();
        $brand = DB::table('brand')->where('brand_status','1')->orderBy("brand_id","desc")->get();
        $infor_shipping = DB::table('shipping')->where('shipping.customer_id',$customer_id)->first();
        if($infor_shipping){
            Session::put('shipping_id',$infor_shipping->shipping_id);
            return view('pages.checkout.payment') ->with('customer_id',$customer_id)
            ->with('category',$category)->with('brand',$brand)
            ->with('infor_shipping',$infor_shipping);
        }
        else{
            return view('pages.checkout.payment') ->with('customer_id',$customer_id)
            ->with('category',$category)->with('brand',$brand)
            ->with('infor_shipping',$infor_shipping);
        }
       
      
    }

    public function logout_checkout(){
        Session::flush();
        return Redirect('/login-checkout');
    }

    public function login_customer(Request $request){
        $request->validate([
            
            'email'=> 'required|email',
            'password' => 'required',
        ],
        [
          
            "email.required"=>"Vui lòng nhập email",
            "email.email"=>"Email có định dạng là `name@gmail.com`",
            "password.required"=>"Vui lòng nhập mật khẩu",
           
        ]);
       
        $email = $request->email;
        $password = md5($request->password);

        
        $result = DB::table('customer')->where('customer_email',$email)->where('customer_password',$password)
                                    ->first();
       
        
        if($result){
            Session::put('customer_id',$result->customer_id); 
            return Redirect('/trangchu');
        }
        else{

            return Redirect('/login-checkout')->with('error','Tên đăng nhập hoặc mật khẩu không đúng. Vui lòng nhập lại');
        }

         
                         
         
    }

    //insert dữ liệu vào bảng payment
    public function phuongthucthanhtoan(Request $request){
        $content= Cart::content();
        //insert payment_method
        $customer_id = Session::get('customer_id'); //khi đăng nhập sẽ có customer_id
        if(!Session::get('shipping_id') || $request->payment_op == null){
            $alert = "Vui lòng nhập thông tin nhận hàng ở phía trên!";
           
            return Redirect::to('/payment/'.$customer_id)->with('alert',$alert)->with('error',"Vui lòng chọn phương thức thanh toán.");
        }
        elseif(Cart::subtotal() == 0){
            return Redirect::to('/payment/'.$customer_id)->with('error',"Không có sản phẩm nào được chọn để thanh toán.");
        }
        else{
        $data = array();
        $data['payment_method'] = $request->payment_op;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('payment')->insertGetId($data);
        
       
        //insert vào bảng order
        $order_data = array();
        $order_data['customer_id'] = $customer_id;
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::subtotal(0,'','');
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_data['order_ngaydathang'] = Carbon::now();
        $order_id = DB::table('order')->insertGetId($order_data);

        //insert vào bảng order detail;
        

        //$content= Cart::content();
        //$content được lấy ra nhở vapf Cart có lưu thông tin các sp thêm vào giỏ hàng
        foreach($content as $value){
            $orderDetail_data['order_id'] =  $order_id;  //khi đăng nhập sẽ có customer_id
            $orderDetail_data['product_id'] = $value->id;
            $orderDetail_data['product_name'] = $value->name;
            $orderDetail_data['product_price'] = $value->price;
            $orderDetail_data['product_qty'] = $value->qty;
            DB::table('order_detail')->insert($orderDetail_data);
            
            $product = DB::table('product')->where('product.product_id',$value->id)->first();
            $sl = $product->product_SLtrongkho - $value->qty;
            DB::table('product')->where('product.product_id',$value->id)->update(['product.product_SLtrongkho'=>$sl]);
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

    public function manage_order(){
        $this->AuthLogin();
        $all_order = DB::table('order')->join('customer','order.customer_id', '=','customer.customer_id')
              ->select('order.*','customer.customer_name')
              ->orderBy('order.order_id','desc')
            ->get();
       
        return view('admin.manage_order')->with('all_order',$all_order);
    }   

    public function view_order($orderId){
        $this->AuthLogin();

        $order_byid = DB::table('order')
            ->join('customer','order.customer_id', '=','customer.customer_id')
            ->join('shipping','order.shipping_id', '=','shipping.shipping_id')
            ->where('order.order_id','=',$orderId)
            ->select('order.*','customer.*','shipping.*')
            ->first();
        
            $order_detail = DB::table(('order'))
            ->join('order_detail','order.order_id', '=','order_detail.order_id')
            ->where('order.order_id','=',$orderId)
            ->select('order.*','order_detail.*')
            ->get();
         
       
        return view('admin.view_order')->with('order_byid',$order_byid)->with('order_detail',$order_detail);
    }

    //cập nhật tình trạng đơn hàng
    public function capnhat($orderId, Request $request){
        echo 'helo';
        $tinhtrang = $request->tinhtrangdonhang;

        DB::table('order')->where('order.order_id',$orderId)
                        ->update(['order_status'=> $tinhtrang]);
        
         return Redirect::to('manage-order') ;
    }

    public function update_address($customer_id,Request $request){
        if($request->name != null && $request->phone != null && $request->address != null){
            $data = array();

            $data['shipping_name'] = $request->name;
            $data['shipping_phone'] = $request->phone;
            $data['shipping_note'] = $request->note;
            $data['shipping_address'] = $request->address;
    
            DB::table('shipping')->where('shipping.customer_id',$customer_id)->update($data);
            $infor_shipping = DB::table('shipping')->where('shipping.customer_id',$customer_id)->first();
            $category = DB::table('category')->where('category_status','1')->orderBy("category_id","desc")->get();
            $brand = DB::table('brand')->where('brand_status','1')->orderBy("brand_id","desc")->get();
            return view('pages.checkout.payment')->with('infor_shipping',$infor_shipping)
            ->with('category',$category)
            ->with('brand',$brand); 
        }
        else{
            return Redirect::to('/payment/'.$customer_id);
        }
       
        
    }
    public function tim_kiem_order(Request $request_search){
        $this->AuthLogin();
        $keyword = $request_search->keyword;
        $all_order = DB::table('customer')->join('order','order.customer_id', '=','customer.customer_id')
              ->select('order.*','customer.customer_name')
              ->where('customer.customer_name','like','%'.$keyword.'%')
              ->orderBy('order.order_id','desc')
            ->get();
       
        return view('admin.view_search_order')->with('all_order',$all_order);
    }   

    public function delete_order($order_id){
        $this->AuthLogin();
 
        DB::table('order')->where('order_id',$order_id)->delete();
        Session::put('message','Xóa danh mục thành công');
        return Redirect::to('manage-order');
    }

    //Quản lý tài khoản
    public function edit_profile($customer_id){

        $category = DB::table('category')->where('category_status','1')->orderBy("category_id","desc")->get();
        $brand = DB::table('brand')->where('brand_status','1')->orderBy("brand_id","desc")->get();


        
        
            return view('pages.checkout.edit_profile_user')
                                            ->with('category',$category)
                                            ->with('brand',$brand);
                                            

       
    } 

    public function update_profile_user($customer_id, Request $request){
        $request->validate([
            'customer_name' => 'required',
            'customer_phone'=> ['required',
                               'regex:/^(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))(\d)(\s|\.)?(\d{3})(\s|\.)?(\d{3})$/',
                               'unique:customer,customer_phone',],
        ],
        [
            "customer_name.required"=>"Vui lòng nhập họ tên",
            
            "customer_phone.required"=>"Vui lòng nhập số điện thoại",
            "customer_phone.unique"=>"Số điện thoại đã tồn tại",
            "customer_phone.regex"=>"Số điện thoại không đúng định dạng",
        ]);
      
       $data = array();
       $data['customer_name'] = $request->customer_name;
       $data['customer_phone'] = $request->customer_phone;

       DB::table('customer')->where('customer_id',$customer_id)->update($data);
       Session::put('message','Cập nhật thành công');
       return Redirect::to('/account/'.$customer_id);
     }
     //shipping

     public function edit_shipping($customer_id){

        $category = DB::table('category')->where('category_status','1')->orderBy("category_id","desc")->get();
        $brand = DB::table('brand')->where('brand_status','1')->orderBy("brand_id","desc")->get();


        
        
            return view('pages.checkout.edit_shipping_user')
                                            ->with('category',$category)
                                            ->with('brand',$brand);
                                            

       
    } 

     public function update_shipping_user($customer_id, Request $request){
        $request->validate([
            'shipping_name' => 'required',
            'shipping_address' => 'required',
            'shipping_phone'=> ['required',
                               'regex:/^(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))(\d)(\s|\.)?(\d{3})(\s|\.)?(\d{3})$/',],
             'shipping_note' => 'required',
        ],
        [
            "shipping_name.required"=>"Vui lòng nhập họ tên người nhận hàng",
            "shipping_address.required"=>"Vui lòng nhập địa chỉ nhận hàng",
            
            "shipping_phone.required"=>"Vui lòng nhập số điện thoại",
            "shipping_phone.unique"=>"Số điện thoại đã tồn tại",
            "shipping_phone.regex"=>"Số điện thoại không đúng định dạng",
            "shipping_note.required"=>"Vui lòng nhập ghi chú",
            
        ]);
        
       $data = array();
       $data['shipping_name'] = $request->shipping_name;
       $data['shipping_phone'] = $request->shipping_phone;
       $data['shipping_address'] = $request->shipping_address;
       $data['shipping_note'] = $request->shipping_note;
        $check=DB::table('shipping')->where('customer_id',$customer_id);
        if ($check->count()>0){
       DB::table('shipping')->where('customer_id',$customer_id)->update($data);
    }else{
        $data['customer_id'] = $customer_id;
        DB::table('shipping')->insert($data);
    }
       Session::put('message','Cập nhật thành công');
       return Redirect::to('/account/'.$customer_id);
     }
}
