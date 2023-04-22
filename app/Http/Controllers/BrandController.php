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
    public function thuonghieu($brand_id,Request $request){
        $search = $request->keyword_sub ?? ''; 
        $sort=$request->sort ?? '';
        $price_min=$request->price_min ?? '';
        $price_max=$request->price_max ?? '';
        if ($request->price_max==0){
            $price_max=9999999999999;
        }
        $coupon_min=$request->coupon_min/100 ?? '';
        $coupon_max=$request->coupon_max/100 ?? '';
        if ($request->coupon_max==0){
            $coupon_max=9999999999999;
        }
        $category = DB::table('category')->where('category_status','1')->orderBy("category_id","desc")->get();
        $brand = DB::table('brand')->where('brand_status','1')->orderBy("brand_id","desc")->get();

        $brand_name = DB::table('brand')->where('brand_status','1')->where('brand.brand_id',$brand_id)->limit(1)->get();
        $brand_byID = DB::table('product')->where('product_status','1')
        ->where('product.brand_id',$brand_id)->join('brand','product.brand_id','=','brand.brand_id')

                                            ->leftJoin('promotional_products','product.product_id','promotional_products.product_id')
                                            ->leftJoin('coupon','promotional_products.coupon_id','coupon.coupon_id')
                                            ->where('product.product_name','like',"%$search%")
                                            ->where('product.product_price','>',$price_min)
                                            ->where('product.product_price','<',$price_max)
                                            ->orWhere('promotional_products.price_final','<=',$price_max)
                                            ->Where('promotional_products.price_final','>=',$price_max)
                                            ->select('product.*','promotional_products.price_final','coupon.*')
                                            ->get();

        if($coupon_min==0&&$coupon_max>1){
            if ($sort==0){
            $brand_byID = DB::table('product')->where('product_status','1')
            ->where('product.brand_id',$brand_id)->join('brand','product.brand_id','=','brand.brand_id')
            ->join('category','product.category_id', '=','category.category_id')
                                                  
                                                ->leftJoin('promotional_products','product.product_id','promotional_products.product_id')
                                                ->leftJoin('coupon','promotional_products.coupon_id','coupon.coupon_id')
                                                ->where('product.product_name','like',"%$search%")
                                                ->where('product.product_price','>=',$price_min)
                                                ->where('product.product_price','<=',$price_max)
                                               
                                                ->orWhere('promotional_products.price_final','<=',$price_max)
                                                ->Where('promotional_products.price_final','>=',$price_max)
                                                
                                                ->select('product.*','category.category_name','brand.brand_name','promotional_products.price_final','coupon.*')
                                                ->orderBy('product.product_id','desc')
                                                ->get();
            }elseif($sort==2){
                $brand_byID = DB::table('product')->where('product_status','1')
                ->where('product.brand_id',$brand_id)->join('brand','product.brand_id','=','brand.brand_id')
                ->join('category','product.category_id', '=','category.category_id')
                                                      
                                                    ->leftJoin('promotional_products','product.product_id','promotional_products.product_id')
                                                    ->leftJoin('coupon','promotional_products.coupon_id','coupon.coupon_id')
                                                    ->where('product.product_name','like',"%$search%")
                                                    ->where('product.product_price','>=',$price_min)
                                                    ->where('product.product_price','<=',$price_max)
                                                   
                                                    ->orWhere('promotional_products.price_final','<=',$price_max)
                                                    ->Where('promotional_products.price_final','>=',$price_max)
                                                    
                                                    ->select('product.*','category.category_name','brand.brand_name','promotional_products.price_final','coupon.*')
                                                    ->orderBy('product.product_price')
                                                    ->get();
                }elseif($sort==3){
                    $brand_byID = DB::table('product')->where('product_status','1')
                    ->where('product.brand_id',$brand_id)->join('brand','product.brand_id','=','brand.brand_id')
                    ->join('category','product.category_id', '=','category.category_id')
                                                          
                                                        ->leftJoin('promotional_products','product.product_id','promotional_products.product_id')
                                                        ->leftJoin('coupon','promotional_products.coupon_id','coupon.coupon_id')
                                                        ->where('product.product_name','like',"%$search%")
                                                        ->where('product.product_price','>=',$price_min)
                                                        ->where('product.product_price','<=',$price_max)
                                                        
                                                        ->orWhere('promotional_products.price_final','<=',$price_max)
                                                        ->Where('promotional_products.price_final','>=',$price_max)
                                                        
                                                        ->select('product.*','category.category_name','brand.brand_name','promotional_products.price_final','coupon.*')
                                                        ->orderBy('product.product_price','desc')
                                                        ->get();
                    }elseif($sort==4){
                        $brand_byID = DB::table('product')->where('product_status','1')
                        ->where('product.brand_id',$brand_id)->join('brand','product.brand_id','=','brand.brand_id')
                        ->join('category','product.category_id', '=','category.category_id')
                                                              
                                                            ->leftJoin('promotional_products','product.product_id','promotional_products.product_id')
                                                            ->leftJoin('coupon','promotional_products.coupon_id','coupon.coupon_id')
                                                            ->where('product.product_name','like',"%$search%")
                                                            ->where('product.product_price','>=',$price_min)
                                                            ->where('product.product_price','<=',$price_max)
                                                            
                                                            ->orWhere('promotional_products.price_final','<=',$price_max)
                                                            ->Where('promotional_products.price_final','>=',$price_max)
                                                            
                                                            ->select('product.*','category.category_name','brand.brand_name','promotional_products.price_final','coupon.*')
                                                            ->orderBy('product.product_name')
                                                            ->get();
                        }elseif($sort==5){
                            $brand_byID = DB::table('product')->where('product_status','1')
                            ->where('product.brand_id',$brand_id)->join('brand','product.brand_id','=','brand.brand_id')
                            ->join('category','product.category_id', '=','category.category_id')
                                                                
                                                                ->leftJoin('promotional_products','product.product_id','promotional_products.product_id')
                                                                ->leftJoin('coupon','promotional_products.coupon_id','coupon.coupon_id')
                                                                ->where('product.product_name','like',"%$search%")
                                                                ->where('product.product_price','>=',$price_min)
                                                                ->where('product.product_price','<=',$price_max)
                                                                
                                                                ->orWhere('promotional_products.price_final','<=',$price_max)
                                                                ->Where('promotional_products.price_final','>=',$price_max)
                                                                
                                                                ->select('product.*','category.category_name','brand.brand_name','promotional_products.price_final','coupon.*')
                                                                ->orderBy('product.product_name','desc')
                                                                ->get();
                            }
                            return view('pages.brand.show_brand')->with('brand_byID', $brand_byID)
                            ->with('category', $category)
                            ->with('brand', $brand)
                            ->with('brand_name',$brand_name);    
                    }else{
                        if ($sort==0){
                            $brand_byID = DB::table('product')->where('product_status','1')
                            ->where('product.brand_id',$brand_id)->join('brand','product.brand_id','=','brand.brand_id')
                            ->join('category','product.category_id', '=','category.category_id')
                                                                 
                                                                ->Join('promotional_products','product.product_id','promotional_products.product_id')
                                                                ->Join('coupon','promotional_products.coupon_id','coupon.coupon_id')
                                                                ->where('product.product_name','like',"%$search%")
                                                                ->where('product.product_price','>=',$price_min)
                                                                ->where('product.product_price','<=',$price_max)
                                                                ->where('coupon.coupon_value','>=',$coupon_min)
                                                                ->where('coupon.coupon_value','<=',$coupon_max)
                                                                ->orWhere('promotional_products.price_final','<=',$price_max)
                                                                ->Where('promotional_products.price_final','>=',$price_max)
                                                                ->where('coupon.coupon_value','>=',$coupon_min)
                                                                ->where('coupon.coupon_value','<=',$coupon_max)
                                                                ->select('product.*','category.category_name','brand.brand_name','promotional_products.price_final','coupon.*')
                                                                ->orderBy('product.product_id','desc')
                                                                ->get();
                            }elseif($sort==2){
                                $brand_byID = DB::table('product')->where('product_status','1')
                                ->where('product.brand_id',$brand_id)->join('brand','product.brand_id','=','brand.brand_id')
                                ->join('category','product.category_id', '=','category.category_id')
                                                                      
                                                                    ->leftJoin('promotional_products','product.product_id','promotional_products.product_id')
                                                                    ->leftJoin('coupon','promotional_products.coupon_id','coupon.coupon_id')
                                                                    ->where('product.product_name','like',"%$search%")
                                                                    ->where('product.product_price','>',$price_min)
                                                                    ->where('product.product_price','<',$price_max)
                                                                    ->where('coupon.coupon_value','>=',$coupon_min)
                                                                    ->where('coupon.coupon_value','<=',$coupon_max)
                                                                    ->orWhere('promotional_products.price_final','<=',$price_max)
                                                                    ->Where('promotional_products.price_final','>=',$price_max)
                                                                    ->where('coupon.coupon_value','>=',$coupon_min)
                                                                    ->where('coupon.coupon_value','<=',$coupon_max)
                                                                    ->select('product.*','category.category_name','brand.brand_name','promotional_products.price_final','coupon.*')
                                                                    ->orderBy('product.product_price')
                                                                    ->get();
                                }elseif($sort==3){
                                    $brand_byID = DB::table('product')->where('product_status','1')
                                    ->where('product.brand_id',$brand_id)->join('brand','product.brand_id','=','brand.brand_id')
                                    ->join('category','product.category_id', '=','category.category_id')
                                                                          
                                                                        ->leftJoin('promotional_products','product.product_id','promotional_products.product_id')
                                                                        ->leftJoin('coupon','promotional_products.coupon_id','coupon.coupon_id')
                                                                        ->where('product.product_name','like',"%$search%")
                                                                        ->where('product.product_price','>',$price_min)
                                                                        ->where('product.product_price','<',$price_max)
                                                                        ->where('coupon.coupon_value','>=',$coupon_min)
                                                                        ->where('coupon.coupon_value','<=',$coupon_max)
                                                                        ->orWhere('promotional_products.price_final','<=',$price_max)
                                                                        ->Where('promotional_products.price_final','>=',$price_max)
                                                                        ->where('coupon.coupon_value','>=',$coupon_min)
                                                                        ->where('coupon.coupon_value','<=',$coupon_max)
                                                                        ->select('product.*','category.category_name','brand.brand_name','promotional_products.price_final','coupon.*')
                                                                        ->orderBy('product.product_price','desc')
                                                                        ->get();
                                    }elseif($sort==4){
                                        $brand_byID = DB::table('product')->where('product_status','1')
                                        ->where('product.brand_id',$brand_id)->join('brand','product.brand_id','=','brand.brand_id')
                                        ->join('category','product.category_id', '=','category.category_id')
                                                                              
                                                                            ->leftJoin('promotional_products','product.product_id','promotional_products.product_id')
                                                                            ->leftJoin('coupon','promotional_products.coupon_id','coupon.coupon_id')
                                                                            ->where('product.product_name','like',"%$search%")
                                                                            ->where('product.product_price','>',$price_min)
                                                                            ->where('product.product_price','<',$price_max)
                                                                            ->where('coupon.coupon_value','>=',$coupon_min)
                                                                            ->where('coupon.coupon_value','<=',$coupon_max)
                                                                            ->orWhere('promotional_products.price_final','<=',$price_max)
                                                                            ->Where('promotional_products.price_final','>=',$price_max)
                                                                            ->where('coupon.coupon_value','>=',$coupon_min)
                                                                            ->where('coupon.coupon_value','<=',$coupon_max)
                                                                            ->select('product.*','category.category_name','brand.brand_name','promotional_products.price_final','coupon.*')
                                                                            ->orderBy('product.product_name')
                                                                            ->get();
                                        }elseif($sort==5){
                                            $brand_byID = DB::table('product')->where('product_status','1')
                                            ->where('product.brand_id',$brand_id)->join('brand','product.brand_id','=','brand.brand_id')
                                            ->join('category','product.category_id', '=','category.category_id')
                                                                                  
                                                                                ->leftJoin('promotional_products','product.product_id','promotional_products.product_id')
                                                                                ->leftJoin('coupon','promotional_products.coupon_id','coupon.coupon_id')
                                                                                ->where('product.product_name','like',"%$search%")
                                                                                ->where('product.product_price','>',$price_min)
                                                                                ->where('product.product_price','<',$price_max)
                                                                                ->where('coupon.coupon_value','>=',$coupon_min)
                                                                                ->where('coupon.coupon_value','<=',$coupon_max)
                                                                                ->orWhere('promotional_products.price_final','<=',$price_max)
                                                                                ->Where('promotional_products.price_final','>=',$price_max)
                                                                                ->where('coupon.coupon_value','>=',$coupon_min)
                                                                                ->where('coupon.coupon_value','<=',$coupon_max)
                                                                                ->select('product.*','category.category_name','brand.brand_name','promotional_products.price_final','coupon.*')
                                                                                ->orderBy('product.product_name','desc')
                                                                                ->get();
                                            }
                                            return view('pages.brand.show_brand')->with('brand_byID', $brand_byID)
                                            ->with('category', $category)
                                            ->with('brand', $brand)
                                            ->with('brand_name',$brand_name);    
                    }
                    
        return view('pages.brand.show_brand')->with('brand_byID', $brand_byID)
        ->with('category', $category)
        ->with('brand', $brand)
        ->with('brand_name',$brand_name);
        
    }
    
}