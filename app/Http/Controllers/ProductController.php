<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;
class ProductController extends Controller
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
    public function add_product(){
        $this->AuthLogin();
        $category = DB::table('category')->orderBy("category_id","desc")->get();
        $brand = DB::table('brand')->orderBy("brand_id","desc")->get();
        return view('admin.add_product')->with('category',$category)
                                         ->with('brand',$brand);
    }

    public function all_product(){
        $this->AuthLogin();
        $all_product = DB::table('product')->join('category','product.category_id', '=','category.category_id')
                                            ->join('brand','product.brand_id', '=','brand.brand_id')  
                                            ->select('product.*','category.category_name','brand.brand_name')
                                            ->get();
       
    return view('admin.all_product')->with('all_product', $all_product);
                                        
    }
    public function save_product(Request $request){
        $this->AuthLogin();
        $data = array();
        // 'brand_name' là của cột trong bảng brand tên phải giống với cột trong csdl ko đc khác
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['brand_id'] = $request->product_brand;
        $data['category_id'] = $request->product_category;
        $data['product_content'] = $request->product_content;
        $data['product_desc'] = $request->product_desc;
        $data['product_status'] = $request->product_status;
      
        $get_image = $request->file('product_image');
        // thêm ảnh vào public/upload
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('product')->insert($data); 
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('add-product');
        }
        $data['product_image'] = '';

        DB::table('product')->insert($data); 
        Session::put('message','Thêm sản phẩm thành công');
        return Redirect::to('add-product');
    }

    public function unactive_product($product_id){
        $this->AuthLogin();
       DB::table('product')->where('product_id',$product_id)
                            ->update(['product_status'=> 0]);

       
        
        return Redirect::to('all-product');
    }
    public function active_product($product_id){
        $this->AuthLogin();
        DB::table('product')->where('product_id',$product_id)
                            ->update(['product_status'=> 1]);
         
                    
         return Redirect::to('all-product');
     }

     public function edit_product($product_id){
        $this->AuthLogin();
        $category = DB::table('category')->orderBy("category_id","desc")->get();
        $brand = DB::table('brand')->orderBy("brand_id","desc")->get();
        $edit_product = DB::table('product')->where('product_id',$product_id)->get(); 
        return view('admin.edit_product')->with('edit_product', $edit_product)
                      ->with('category', $category)
                      ->with('brand', $brand);
     }
     public function update_product($product_id, Request $request){
        $this->AuthLogin();
       $data = array();
       $data['product_name'] = $request->product_name;
       $data['product_price'] = $request->product_price;
       $data['brand_id'] = $request->product_brand;
       $data['category_id'] = $request->product_category;
       $data['product_content'] = $request->product_content;
       $data['product_desc'] = $request->product_desc;

       $get_image = $request->file('product_image');

       if($get_image){
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move('public/upload/product',$new_image);
        $data['product_image'] = $new_image;

        DB::table('product')->where('product_id',$product_id)->update($data); 

        Session::put('message','Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');
       }
       
        DB::table('product')->where('product_id',$product_id)->update($data); 
        Session::put('message','Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');
     }
     public function delete_product($product_id){
      
        $this->AuthLogin();
        DB::table('product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('all-product');
      }

    //   trang chi tiết sp
    public function detail_product($product_id){
        $category = DB::table('category')->where('category_status','1')->orderBy("category_id","desc")->get();
        $brand = DB::table('brand')->where('brand_status','1')->orderBy("brand_id","desc")->get();

        $product_detail = DB::table('product')->join('category','product.category_id', '=','category.category_id')
        ->join('brand','product.brand_id', '=','brand.brand_id') 
        ->where('product.product_id',$product_id) 
        ->get();


        return view('pages.products.show_detail_product')
        ->with('category',$category)->with('brand',$brand)
        ->with('product_detail',$product_detail);
    }
}
