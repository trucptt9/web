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
        $Count_product = DB::table('product')->count();
        $statistical = DB:: table('product')
                        ->join('order_detail','product.product_id','=','order_detail.product_id')
                        ->select('product.product_id','product.product_name','product.product_price',DB::raw('count(*) as count'),DB::raw('sum(product.product_price) as total'))
                        ->groupBy('product.product_id','product.product_name','product.product_price')
                        ->get();
        $total=0;
        $total_unpaid=0;
        $total_paid=0;
        $total = DB::table('order')->sum('order_total');
        $total_paid = DB::table('order')
                ->where('order_status','Giao hàng thành công')
                ->sum('order_total');
        $total_unpaid = DB::table('order')
                ->where('order_status','Đang chờ xử lý')
                ->orWhere('order_status','Đã giao cho bên vận chuyển')
                ->sum('order_total');
        return view('admin.revenue_statistic')
                ->with('total',$total)
                ->with('statistical',$statistical)
                ->with('total_paid',$total_paid)
                ->with('total_unpaid',$total_unpaid);
    }

    public function tim_kiem_thong_ke(Request $request){
        $keyword = $request->keyword_sub;

        $Count_product = DB::table('product')->count();
        $statistical = DB:: table('product')
                        ->join('order_detail','product.product_id','=','order_detail.product_id')
                        ->select('product.product_id','product.product_name','product.product_price',DB::raw('count(*) as count'),DB::raw('sum(product.product_price) as total'))
                        ->groupBy('product.product_id','product.product_name','product.product_price')
                        ->where('product.product_name','like','%'.$keyword.'%')
                        ->orWhere('product.product_id','=',$keyword)
                        ->get();
        $total=0;
        $total_unpaid=0;
        $total_paid=0;
        $total = DB::table('order')->sum('order_total');
        $total_paid = DB::table('order')
                ->where('order_status','Giao hàng thành công')
                ->sum('order_total');
        $total_unpaid = DB::table('order')
                ->where('order_status','Đang chờ xử lý')
                ->orWhere('order_status','Đã giao cho bên vận chuyển')
                ->sum('order_total');
        return view('admin.revenue_statistic')
                ->with('total',$total)
                ->with('statistical',$statistical)
                ->with('total_paid',$total_paid)
                ->with('total_unpaid',$total_unpaid);
    }

    //hàm trả về thông tin tên trang dashboard
    public function get_infor(){
       
    }
}
