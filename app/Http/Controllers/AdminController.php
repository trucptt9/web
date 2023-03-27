<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class AdminController extends Controller
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
    public function index(){
        return view('admin_login');
    }
    public function showDashboard(){
        $this->AuthLogin();
        $customers = DB::table('customer')->get();
        $sl = count($customers);

        $products = count(DB::table('product')->get());
        $orders = count(DB::table('order')->get());
        $products_hethang = count(DB::table('product')->where('product.product_SLtrongkho','=',0)->get());
        // echo $sl;
        return view('admin.dashboard')->with('number_customer',$sl)
        ->with('number_product',$products)
        ->with('number_order',$orders)
        ->with('number_hethang',$products_hethang);
    }
    public function dashboard(Request $request){
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);

        $result = DB::table('admin')
        ->where('admin_email', $admin_email)
        ->where('admin_password',$admin_password)
        ->first();  //lấy 1 user
        if($result){
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id',$result->admin_id);
            return Redirect::to('/dashboard');
        }
        else{
            Session::put('message','Mật khẩu hoặc tài khoản không đúng. Vui lòng nhập lại!');          
            return Redirect::to('/admin');
        }
       
    }
    public function logout(){
        $this->AuthLogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }

    //thống kê doanh thu
    public function thong_ke_doanh_thu(){

        return view('admin.revenue_statistic');
    }

    //hàm trả về thông tin tên trang dashboard
    public function get_infor(){
       
    }
}
