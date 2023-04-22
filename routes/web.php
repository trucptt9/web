<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\TypeaheadController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//BACKEND ->admin

Route::get('/login',[AdminController::class,'index'])->name('login');
Route::post('/submit-login',[AdminController::class,'login'])->name('admin.submit_login');

Route::middleware(['auth'])->prefix('admin')->group(function() {
    Route::get('',[AdminController::class,'showDashboard'])->name('admin.index');
    Route::get('/logout',[AdminController::class,'logout'])->name('admin.logout');

    Route::prefix('category')->group(function() {
        Route::get('',[CategoryController::class,'all_category_product'])
        ->name('admin.all_category');

        Route::get('add',[CategoryController::class,'add_category_product'])->name('admin.new_category');

        Route::post('/save',[CategoryController::class,'save_category_product'])
        ->name('admin.save_category');

        Route::get('/edit/{category_id}',[CategoryController::class,'edit_category_product'])
        ->name('admin.edit_category');

        Route::post('/update/{category_id}',[CategoryController::class,'update_category_product'])
        ->name('admin.update_category'); 

        Route::get('/delete/{category_id}',[CategoryController::class,'delete_category_product'])
        ->name('admin.delete_category');   

        Route::get('/unactive/{category_id}',[CategoryController::class,'unactive_category_product'])
        ->name('admin.unactive_category');

        Route::get('/active/{category_id}',[CategoryController::class,'active_category_product'])
        ->name('admin.active_category');
    });

    // Brand Product
    Route::prefix('brand')->group(function() {
        Route::get('',[BrandController::class,'all_brand_product'])
        ->name('admin.all_brand');
        Route::get('/add',[BrandController::class,'add_brand_product'])
        ->name('admin.add_brand');
        Route::post('/save',[BrandController::class,'save_brand_product'])
        ->name('admin.save_brand');
        Route::get('/edit/{brand_id}',[BrandController::class,'edit_brand_product'])
        ->name('admin.edit_brand');
        Route::post('/update/{brand_id}',[BrandController::class,'update_brand_product'])
        ->name('admin.update_brand'); 
        Route::get('/delete/{brand_id}',[BrandController::class,'delete_brand_product'])
        ->name('admin.delete_brand');
        Route::get('/unactive/{brand_id}',[BrandController::class,'unactive_brand_product'])
        ->name('admin.unactive_brand');
        Route::get('/active/{brand_id}',[BrandController::class,'active_brand_product'])
        ->name('admin.active_brand');
    });
    
    // Product
    Route::prefix('product')->group(function() {
        Route::get('',[ProductController::class,'all_product'])
        ->name('admin.all_product');
        Route::get('/add',[ProductController::class,'add_product'])
        ->name('admin.add_product');
         Route::post('/save',[ProductController::class,'save_product'])
        ->name('admin.save_product');
        Route::get('/edit/{product_id}',[ProductController::class,'edit_product'])
        ->name('admin.edit_product');
        Route::post('/update/{product_id}',[ProductController::class,'update_product'])
        ->name('admin.update_product'); 
        Route::get('/delete/{product_id}',[ProductController::class,'delete_product'])
        ->name('admin.delete_product');

        Route::get('/unactive/{product_id}',[ProductController::class,'unactive_product'])
        ->name('admin.unactive_product');
        Route::get('/active/{product_id}',[ProductController::class,'active_product'])
        ->name('admin.active_product');
        Route::get('/outOfStock',[ProductController::class,'out_of_stock_product'])
        ->name('admin.out_of_stock');
    });

    // Order đơn hàng
    Route::prefix('order')->group(function(){
        Route::get('',[CheckoutController::class,'manage_order'])
        ->name('admin.manage_order');

        Route::get('/view/{orderId}',[CheckoutController::class,'view_order'])
        ->name('admin.view_order');

        Route::post('/update/{orderId}',[CheckoutController::class,'capnhat'])
        ->name('admin.update_order');

        Route::get('/search',[CheckoutController::class, 'tim_kiem_order'])
        ->name('admin.search_order');
        
        Route::get('/delete/{order_id}',[CheckoutController::class,'delete_order'])
        ->name('admin.delete_order');

       
    });
    
    //thống kê
    Route::prefix('statistic')->group(function(){
        Route::get('/revenue',[AdminController::class,'thong_ke_doanh_thu'])
        ->name('admin.revenue_statistic');
        Route::get('/user',[AdminController::class,'thong_ke_khach_hang'])
        ->name('admin.user_statistic');
        Route::get('/order',[AdminController::class,'thong_ke_don_hang'])
        ->name('admin.order_statistic');
        Route::get('/search',[AdminController::class, 'tim_kiem_thong_ke'])
        ->name('admin.timkiem_thong_ke');
        Route::get('/chart',[AdminController::class, 'bieudo_thongke'])
        ->name('admin.chart_statistic');
    });
    
    //khuyến mãi
    Route::prefix('coupon')->group(function(){
        Route::get('',[CouponController::class,'all_coupon'])
        ->name('admin.all_coupon');
        Route::get('/add',[CouponController::class,'add_coupon'])
        ->name('admin.add_coupon');
        Route::post('/save',[CouponController::class,'save_coupon'])
        ->name('admin.save_coupon');
        Route::get('/edit/{coupon_id}',[CouponController::class,'edit_coupon'])
        ->name('admin.edit_coupon');
        Route::post('/update/{coupon_id}',[CouponController::class,'update_coupon'])
        ->name('admin.update_coupon');
        Route::get('/delete/{coupon_id}',[CouponController::class,'delete_coupon'])
        ->name('admin.delete_coupon');
        Route::get('/apply',[CouponController::class,'apply_coupon'])
        ->name('admin.apply_coupon');
        Route::post('/save-product',[CouponController::class,'save_coupon_product'])
        ->name('admin.save_product_coupon');
        Route::get('/delete-product/{product_id}',[CouponController::class,'delete_product_coupon'])
        ->name('admin.delete_product_coupon');
        
    });
});

//User
Route::get('/',[HomeController::class,'index'])->name('home_page');
Route::get('/trangchu',[HomeController::class, 'index'])->name('home');
Route::post('/timkiem',[HomeController::class, 'tim_kiem'])->name('search');

// danh mục sản phẩm của trang chủ
Route::get('/danh-muc-san-pham/{category_id}',[CategoryController::class, 'show_category_home'])
->name('category');
Route::get('/thuonghieu/{brand_id}',[BrandController::class, 'thuonghieu'])
->name('brand');
//trang chi tiết sp
Route::get('/chi-tiet-san-pham/{product_id}',[ProductController::class, 'detail_product'])
->name('detail_product');
Route::get('/tat-ca-sp',[ProductController::class,'tat_ca_sp'])
->name('allproduct');
    //Cart -> thêm sp vào giỏ hàng

    //hêr

    Route::post('/save-cart',[CartController::class,'save_cart'])
    ->name('save_cart'); 
    Route::post('/sell-cart',[CartController::class,'sell_cart'])
    ->name('sell_cart'); 
    Route::get('/show-cart',[CartController::class,'show_cart'])
    ->name('show_cart'); 
    Route::get('/delete-cart/{rowId}',[CartController::class,'delete_cart'])
    ->name('delete_cart');
    

  
 Route::get('/login-checkout',[CheckoutController::class,'login_checkout'])
 ->name('login_checkout');
  Route::post('/add-customer',[CheckoutController::class,'add_customer'])
->name('user.add_account');
  Route::post('/login-customer',[CheckoutController::class,'login_customer'])
->name('user.login');

  


//trả về trang tài khoản người dùng
    Route::get('/account/{customer_id}',[HomeController::class, 'show_account'])->name('account_user');
    Route::get('/order-history/{customer_id}',[HomeController::class, 'show_order_account'])->name('order_account');

    Route::get('/edit-profile/{customer_id}',[CheckoutController::class,'edit_profile'])->name('edit_profile');
    Route::get('/edit-shipping/{customer_id}',[CheckoutController::class,'edit_shipping'])->name('edit_shipping');
    Route::get('/edit-password/{customer_id}',[CheckoutController::class,'edit_password'])->name('edit_password');

    Route::get('/update-profile-user/{customer_id}',[CheckoutController::class,'update_profile_user'])->name('update_profile_user'); 
    Route::get('/update-shipping-user/{customer_id}',[CheckoutController::class,'update_shipping_user'])->name('update_shipping_user');
    Route::get('/update-password-user/{customer_id}',[CheckoutController::class,'update_password_user'])->name('update_password_user'); 

//Checkout  ktra đăng nhập để thanh tonasthanh toán
    
    Route::get('/logout-checkout',[CheckoutController::class,'logout_checkout']); 
   
    // Route::get('/checkout/{customer_id}',[CheckoutController::class,'checkout']); 
    Route::get('/payment/{customer_id}',[CheckoutController::class,'payment']); 
    Route::post('/thanhtoantructiep',[CheckoutController::class,'thanhtoan_tructiep']);
    Route::get('/thanhtoantructiep',[CheckoutController::class,'thanhtoan_tructiep']);
    Route::post('/thanhtoan-vnpay',[CheckoutController::class,'thanhtoan_vnpay']);
    Route::post('/save-checkout-customer',[CheckoutController::class,'save_checkout_customer']);
    Route::post('/update-address/{customer_id}',[CheckoutController::class,'update_address']); 
    Route::get('/vnpay-payment',[CheckoutController::class,'vnpay_payment'])
    ->name('vnpay_payment');
    Route::post('/thanhtoanonline',[CheckoutController::class,'show_handcash']);
    Route::get('/thanhtoanonline',[CheckoutController::class,'show_handcash']);
//cua usser

//lienhe
    Route::get("/lienhe", function(){ 
        $category = DB::table('category')->where('category_status','1')->orderBy("category_id","desc")->get();
        $brand = DB::table('brand')->where('brand_status','1')->orderBy("brand_id","desc")->get();
        return view('pages.lienhe.lienhe')->with('category',$category)->with('brand',$brand); });
    use App\Mail\GuiEmail;
    Route::post("/guilienhe", function(Illuminate\Http\Request $request){ 
        $arr = request()->post(); 
        $ht = trim(strip_tags( $arr['ht'] ));
        $em = trim(strip_tags( $arr['em'] ));
        $nd = trim(strip_tags( $arr['nd'] ));
        $adminEmail = 'duy35931@gmail.com'; //Gửi thư đến ban quản trị
        Mail::mailer('smtp')->to( $adminEmail )
        ->send( new GuiEmail($ht, $em, $nd) );

        $request->session()->flash('thongbao', "Đã gửi mail");
        return redirect("thongbao"); 
        });
    Route::get("/thongbao", function(Illuminate\Http\Request $request){ 
            $tb = $request->session()->get('thongbao');
            $category = DB::table('category')->where('category_status','1')->orderBy("category_id","desc")->get();
            $brand = DB::table('brand')->where('brand_status','1')->orderBy("brand_id","desc")->get();
            return view('pages.lienhe.thongbao',['thongbao'=> $tb])->with('category',$category)->with('brand',$brand); 
        });