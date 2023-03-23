<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
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

// FRONTEND
// goi toi file controller roi goi ham index cua HomeCOntroller
Route::get('/',[HomeController::class,'index']);
Route::get('/trangchu',[HomeController::class, 'index']);



//BACKEND ->admin

// tra ve trang login
Route::get('/admin',[AdminController::class,'index']);

//tra ve trang dashboard
Route::get('/dashboard',[AdminController::class,'showDashboard']);

// gui thong tin dang nhap de kiem tra tai khoan co trong csdl admin ko
//neu co thi tra ve trang dashboard cua admin , neu khong thi tra ve thong bao loi r quay lai trang dang nhap
Route::post('/admin-dashboard',[AdminController::class,'dashboard']);
Route::get('/logout',[AdminController::class,'logout']);



// Category Product
Route::get('/add-category-product',[CategoryController::class,'add_category_product']);

Route::get('/all-category-product',[CategoryController::class,'all_category_product']);
Route::post('/save-category-product',[CategoryController::class,'save_category_product']);
Route::get('/edit-category-product/{category_id}',[CategoryController::class,'edit_category_product']);
Route::post('/update-category-product/{category_id}',[CategoryController::class,'update_category_product']); 
Route::get('/delete-category-product/{category_id}',[CategoryController::class,'delete_category_product']);

Route::get('/unactive-category-product/{category_id}',[CategoryController::class,'unactive_category_product']);
Route::get('/active-category-product/{category_id}',[CategoryController::class,'active_category_product']);

// Brand Product

Route::get('/add-brand-product',[BrandController::class,'add_brand_product']);

Route::get('/all-brand-product',[BrandController::class,'all_brand_product']);
Route::post('/save-brand-product',[BrandController::class,'save_brand_product']);
Route::get('/edit-brand-product/{brand_id}',[BrandController::class,'edit_brand_product']);
Route::post('/update-brand-product/{brand_id}',[BrandController::class,'update_brand_product']); 
Route::get('/delete-brand-product/{brand_id}',[BrandController::class,'delete_brand_product']);

Route::get('/unactive-brand-product/{brand_id}',[BrandController::class,'unactive_brand_product']);
Route::get('/active-brand-product/{brand_id}',[BrandController::class,'active_brand_product']);

// Product
Route::get('/add-product',[ProductController::class,'add_product']);

Route::get('/all-product',[ProductController::class,'all_product']);
Route::post('/save-product',[ProductController::class,'save_product']);
Route::get('/edit-product/{product_id}',[ProductController::class,'edit_product']);
Route::post('/update-product/{product_id}',[ProductController::class,'update_product']); 
Route::get('/delete-product/{product_id}',[ProductController::class,'delete_product']);

Route::get('/unactive-product/{product_id}',[ProductController::class,'unactive_product']);
Route::get('/active-product/{product_id}',[ProductController::class,'active_product']);

// Order
Route::get('/manage-order',[CheckoutController::class,'manage_product']);
