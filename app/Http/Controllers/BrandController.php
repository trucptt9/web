<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class BrandController extends Controller
{
    public function add_brand_product(){
        
        return view('admin.add_brand_product');
    }

    public function all_brand_product(Request $request){
        $search = $request->search ?? '';
        $all_brand_product = DB::table('brand')->where('brand_name','like',"%$search%")->paginate(5); 
        return view('admin.all_brand_product')->with('all_brand_product', $all_brand_product);
    }
    public function save_brand_product(Request $request){
        
        // khi người dùng nhấn nút Thêm ở danh mục thêm danh mục sp mới thì nội dung dữ liệu của form đó được guier tới đây
       
        $request->validate([
            
            'brand_product_name'=> 'required',
            'brand_product_desc' => 'nullable',
        ],
        [
          
            "brand_product_name.required"=>"Trường này không được bỏ trống",
           
           
        ]);
       
        $data = array();
        // 'brand_name' là của cột trong bảng brand tên phải giống với cột trong csdl ko đc khác
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;

        DB::table('brand')->insert($data);
       
        // Alert::success('Success Title', 'Success Message');
        /* A way to pass a message to the next request. */
    /*  */
     
        
      
        return to_route('admin.add_brand')->with('success', 'Thêm thương hiệu thành công');
       

    }

    public function unactive_brand_product($brand_id){
        
       DB::table('brand')->where('brand_id',$brand_id)
                            ->update(['brand_status'=> 0]);

        // $alert='Cập nhật thành công!';
        
        return to_route('admin.all_brand');
    }
    public function active_brand_product($brand_id){
        
        DB::table('brand')->where('brand_id',$brand_id)
                             ->update(['brand_status'=> 1]);
         
                    
         return to_route('admin.all_brand');
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
      
       return to_route('admin.all_brand')->with('success', 'Cập nhật thương hiệu thành công');
     }
     public function delete_brand_product($brand_id){
        
        $pro = DB::table('product')->where('product.brand_id',$brand_id)->first();
        if($pro != null){
            return to_route('admin.all_brand')->with('error',"Không thể xóa thương hiệu này vì vẫn còn sản phẩm thuộc thương hiệu.");
          
        }
        else{
            DB::table('brand')->where('brand_id',$brand_id)->delete();
            Session::put('message','Xóa danh mục thành công');
            return to_route('admin.all_brand');
        }
      
      }

    //   end admin
    public function thuonghieu($brand_id){
        $category = DB::table('category')->where('category_status','1')->orderBy("category_id","desc")->get();
        $brand = DB::table('brand')->where('brand_status','1')->orderBy("brand_id","desc")->get();

        $brand_name = DB::table('brand')->where('brand.brand_id',$brand_id)->limit(1)->get();
        $brand_byID = DB::table('product')
        ->where('product.brand_id',$brand_id)->join('brand','product.brand_id','=','brand.brand_id')

                                            ->leftJoin('promotional_products','product.product_id','promotional_products.product_id')
                                            ->leftJoin('coupon','promotional_products.coupon_id','coupon.coupon_id')
                                            ->select('product.*','promotional_products.price_final','coupon.*')
                                            ->get();
        return view('pages.brand.show_brand')->with('brand',$brand)->with('category',$category)
                                            ->with('brand_name',$brand_name)->with('brand_byID',$brand_byID);
    }
}