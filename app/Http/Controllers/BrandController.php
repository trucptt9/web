<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;


class BrandController extends Controller
{
    public function add_brand_product(){
     
        return view('admin.add_brand_product');
    }

    public function all_brand_product(){
        $all_brand_product = DB::table('brand')->get(); 
        return view('admin.all_brand_product')->with('all_brand_product', $all_brand_product);
    }
    public function save_brand_product(Request $request){
        // khi người dùng nhấn nút Thêm ở danh mục thêm danh mục sp mới thì nội dung dữ liệu của form đó được guier tới đây
        $data = array();
        // 'brand_name' là của cột trong bảng brand tên phải giống với cột trong csdl ko đc khác
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;

        DB::table('brand')->insert($data);
       
       
        /* A way to pass a message to the next request. */
         Session::put('message','Thêm mới thành công');
        return Redirect::to('add-brand-product');
       

    }

    public function unactive_brand_product($brand_id){
       DB::table('brand')->where('brand_id',$brand_id)
                            ->update(['brand_status'=> 0]);

        // $alert='Cập nhật thành công!';
        
        return Redirect::to('all-brand-product');
    }
    public function active_brand_product($brand_id){
        DB::table('brand')->where('brand_id',$brand_id)
                             ->update(['brand_status'=> 1]);
         
                    
         return Redirect::to('all-brand-product');
     }

     public function edit_brand_product($brand_id){
        $edit_brand_product = DB::table('brand')->where('brand_id',$brand_id)->get(); 
        return view('admin.edit_brand_product')->with('edit_brand_product', $edit_brand_product);
     }
     public function update_brand_product($brand_id, Request $request){
       $data = array();
       $data['brand_name'] = $request->brand_product_name;
       $data['brand_desc'] = $request->brand_product_desc;

       DB::table('brand')->where('brand_id',$brand_id)->update($data);
       Session::put('message','Cập nhật thành công');
       return Redirect::to('all-brand-product');
     }
     public function delete_brand_product($brand_id){
      
 
        DB::table('brand')->where('brand_id',$brand_id)->delete();
        Session::put('message','Xóa danh mục thành công');
        return Redirect::to('all-brand-product');
      }
}
