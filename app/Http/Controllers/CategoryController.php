<?php

/* Telling PHP that the code in this file is part of the `App\Http\Controllers` namespace. */
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;
@include('sweetalert::alert');

session_start();
class CategoryController extends Controller
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
    public function add_category_product(){
        $this->AuthLogin();
        return view('admin.add_category_product');
    }

    public function all_category_product(){
        $this->AuthLogin();
        $all_category_product = DB::table('category')->get(); 
        return view('admin.all_category_product')->with('all_category_product', $all_category_product);
    }
    public function save_category_product(Request $request){
        $this->AuthLogin();
        // khi người dùng nhấn nút Thêm ở danh mục thêm danh mục sp mới thì nội dung dữ liệu của form đó được guier tới đây
        $data = array();
        // 'category_name' là của cột trong bảng category tên phải giống với cột trong csdl ko đc khác
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;

        DB::table('category')->insert($data);
       
       
        /* A way to pass a message to the next request. */
         Session::put('message','Thêm mới thành công');
        return Redirect::to('add-category-product');
       

    }

    public function unactive_category_product($category_id){
        $this->AuthLogin();
       DB::table('category')->where('category_id',$category_id)
                            ->update(['category_status'=> 0]);

        // $alert='Cập nhật thành công!';
        
        return Redirect::to('all-category-product');
    }
    public function active_category_product($category_id){
        $this->AuthLogin();
        DB::table('category')->where('category_id',$category_id)
                             ->update(['category_status'=> 1]);
         
                    
         return Redirect::to('all-category-product');
     }

     public function edit_category_product($category_id){
        $this->AuthLogin();
        $edit_category_product = DB::table('category')->where('category_id',$category_id)->get(); 
        return view('admin.edit_category_product')->with('edit_category_product', $edit_category_product);
     }
     public function update_category_product($category_id, Request $request){
        $this->AuthLogin();
       $data = array();
       $data['category_name'] = $request->category_product_name;
       $data['category_desc'] = $request->category_product_desc;

       DB::table('category')->where('category_id',$category_id)->update($data);
       Session::put('message','Cập nhật thành công');
       return Redirect::to('all-category-product');
     }
     public function delete_category_product($category_id){
        $this->AuthLogin();
 
        DB::table('category')->where('category_id',$category_id)->delete();
        Session::put('message','Xóa danh mục thành công');
        return Redirect::to('all-category-product');
      }
}
