<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class AdminController extends Controller
{
    public function index(){
        return view('admin_login');
    }
    public function showDashboard(){
        $customers = DB::table('customer')->get();
        $sl = count($customers);

        $products = count(DB::table('product')->get());
        $orders = count(DB::table('order')->get());
        $products_hethang = count(DB::table('product')->where('product.product_SLtrongkho','=',0)->get());
        $products_hethang = count(DB::table('product')->where('product.product_SLtrongkho','<=',5)->get());
        // echo $sl;
        return view('admin.dashboard')->with('number_customer',$sl)
        ->with('number_product',$products)
        ->with('number_order',$orders)
        ->with('number_hethang',$products_hethang)
        ->with('number_hethang',$products_hethang);
    }
    public function login(Request $request){
        $credentials = $request->validate([
            'admin_email' => ['required', 'email'],
            'admin_password' => ['required'],
        ]);
 
        $admin = AdminModel::where('admin_email', $credentials['admin_email'])->first();
        if ($admin && \Hash::check($credentials['admin_password'], $admin->admin_password)) {
            Auth::login($admin);
            $request->session()->regenerate();
          
            return to_route('admin.index');
        }       
        return back()->withErrors([
           
            'error' => 'Mật khẩu hoặc tài khoản không đúng',
        ])->onlyInput('email');
       
    }

    public function logout(){
        Auth::logout();
        return to_route('login');
    }

    //thống kê doanh thu
    public function thong_ke_doanh_thu(Request $request){
        $search = $request->search ?? '';
       
        $statistical = DB:: table('order_detail')
                        ->join('product','order_detail.product_id','product.product_id')
                        ->select('order_detail.product_id','product.product_name',
                        
                        DB::raw('sum(order_detail.product_qty) as count'),DB::raw('sum(order_detail.price * order_detail.product_qty) as total'))
                        ->where('order_detail.product_name','like',"%$search%")
                        ->orWhere('order_detail.product_id','like',"%$search%")
                        ->groupBy('order_detail.product_id','product.product_name')
                        
                        ->get();
// dd($statistical);

        $order_total = DB::table('order')->count();         
        $total=0;
        $total_unpaid=0;
        $total_paid=0;
      
       
        $total = DB::table('order')->sum('order_total');
        $total_paid = DB::table('order')->join('payment','order.payment_id','payment.payment_id')
                ->where('order.order_status','Giao hàng thành công')
                ->orWhere('payment.payment_status','Đã thanh toán')
                ->sum('order.order_total');

                
        $total_unpaid = DB::table('order')
                ->where('order_status','Đang chờ xử lý')
                ->orWhere('order_status','Đã giao cho bên vận chuyển')
                ->sum('order_total');

    
        return view('admin.revenue_statistic')
                ->with('total',$total)
                ->with('statistical',$statistical)
                ->with('total_paid',$total_paid)
                ->with('total_unpaid',$total_unpaid)->with('order_total',$order_total)
                ;
    }
public function thong_ke_khach_hang(Request $request){
    $search = $request->search ?? '';
    $customer = DB::table('order')->join('customer','order.customer_id','customer.customer_id')
    ->select('order.customer_id','customer.customer_name',
    DB::raw('sum(order.order_total) as sum'), DB::raw('count(order.customer_id) as count') )
    ->where('customer.customer_name','like',"%$search%")
    ->groupBy('order.customer_id','customer.customer_name')
    ->paginate(10);
    // dd($customer);
    return view('admin.user_statistic')->with('customer',$customer);
}
public function thong_ke_don_hang(Request $request){
    $search = $request->search ?? '';

    $orders = DB::table('order')
    ->select('order.order_status', DB::raw('count(order.order_status) as count'), DB::raw('sum(order.order_total) as sum'))
    ->where('order.order_status','like',"%$search%")
    ->groupBy('order.order_status')
    ->paginate(5);

    return view('admin.order_statistic')->with('orders',$orders);
}

public function bieudo_thongke(){
    // $days = Input::get('days', 7);

    
    $data = DB::table('order')->select('order.order_ngaydathang as date',
     DB::raw('sum(order.order_total) as value')
    )->groupBy('order.order_ngaydathang')->orderBy('order.order_ngaydathang', 'ASC')
   ->get();

    
    $data2 = DB::table('order')->select('order.thang',
     DB::raw('sum(order.order_total) as value')
    )->groupBy('order.thang')
   ->get();

          
    return view('admin.chart_statistic')->with('data',$data)->with('data2',$data2);
}

    
    public function get_infor(){
       
    }


}
