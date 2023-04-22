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
    public function add_category_product(){
        
        return view('admin.add_category_product');
    }

    public function all_category_product(Request $request){
        $search = $request->search ?? '';
       
        $all_category_product = DB::table('category')->where('category_name','like',"%$search%")->paginate(5); 
        return view('admin.all_category_product')->with('all_category_product', $all_category_product);
    }
    public function save_category_product(Request $request){
        
        // khi người dùng nhấn nút Thêm ở danh mục thêm danh mục sp mới thì nội dung dữ liệu của form đó được guier tới đây
        $request->validate([
            
            'category_product_name'=> 'required',
            'category_product_desc' => 'nullable',
        ],
        [
          
            "category_product_name.required"=>"Trường này không được bỏ trống",
           
           
        ]);
        $data = array();
        // 'category_name' là của cột trong bảng category tên phải giống với cột trong csdl ko đc khác
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;

        DB::table('category')->insert($data);
       
       
        /* A way to pass a message to the next request. */
         Session::put('message','Thêm mới thành công');
        return to_route('admin.new_category')->with('success', 'Thêm danh mục thành công');
       

    }

    public function unactive_category_product($category_id){
        
       DB::table('category')->where('category_id',$category_id)
                            ->update(['category_status'=> 0]);

        // $alert='Cập nhật thành công!';
        
        return to_route('admin.all_category');
    }
    public function active_category_product($category_id){
        
        DB::table('category')->where('category_id',$category_id)
                             ->update(['category_status'=> 1]);
         
                    
         return to_route('admin.all_category');
     }

     public function edit_category_product($category_id){
        
        $edit_category_product = DB::table('category')->where('category_id',$category_id)->get(); 
        return view('admin.edit_category_product')->with('edit_category_product', $edit_category_product);
     }
     public function update_category_product($category_id, Request $request){
        
       $data = array();
       $data['category_name'] = $request->category_product_name;
       $data['category_desc'] = $request->category_product_desc;

       DB::table('category')->where('category_id',$category_id)->update($data);
       
       return to_route('admin.all_category')->with('success', 'Cập nhật danh mục thành công');
     }
     public function delete_category_product($category_id){
        
        $pro = DB::table('product')->where('product.category_id',$category_id)->first();
        if($pro != null){
            return to_route('admin.all_category')->with('error',"Không thể xóa danh mục này vì vẫn còn sản phẩm thuộc danh mục.");
          
        }
        else{
            DB::table('category')->where('category_id',$category_id)->delete();
            //Session::put('message','Xóa danh mục thành công');
            return to_route('admin.all_category');
        }
      
      }

    //   end function admin page

    // start function user page
    public function show_category_home($category_id,Request $request){
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

        $category_name = DB::table('category')->where('category.category_id',$category_id)->limit(1)->get();
        /* $category_byID = DB::table('product')->where('product.category_id',$category_id)->where('product_status','1')
                                            ->join('category','product.category_id','=','category.category_id')
                                            ->leftJoin('promotional_products','product.product_id','promotional_products.product_id')
                                            ->leftJoin('coupon','promotional_products.coupon_id','coupon.coupon_id')
                                            ->where('product.product_name','like',"%$search%")
                                            ->select('product.*','promotional_products.price_final','coupon.*')
                                            ->get(); */
        /* return view('pages.category.show_category')->with('category',$category)->with('brand',$brand)
                                                ->with('category_name',$category_name)
                                                    ->with('category_byID',$category_byID); */
        $category_byID = DB::table('product')->where('product_status','1')
        ->where('product.category_id',$category_id)->join('category','product.category_id','=','category.category_id')

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
            $category_byID = DB::table('product')->where('product_status','1')
            ->where('product.category_id',$category_id)->join('category','product.category_id','=','category.category_id')
            ->join('brand','product.brand_id', '=','brand.brand_id')
                                                  
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
                $category_byID = DB::table('product')->where('product_status','1')
                ->where('product.category_id',$category_id)->join('category','product.category_id','=','category.category_id')
                ->join('brand','product.brand_id', '=','brand.brand_id')
                                                      
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
                    $category_byID = DB::table('product')->where('product_status','1')
                    ->where('product.category_id',$category_id)->join('category','product.category_id','=','category.category_id')
                    ->join('brand','product.brand_id', '=','brand.brand_id')
                                                          
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
                        $category_byID = DB::table('product')->where('product_status','1')
                        ->where('product.category_id',$category_id)->join('category','product.category_id','=','category.category_id')
                        ->join('brand','product.brand_id', '=','brand.brand_id')
                                                              
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
                            $category_byID = DB::table('product')->where('product_status','1')
                            ->where('product.category_id',$category_id)->join('category','product.category_id','=','category.category_id')
                            ->join('brand','product.brand_id', '=','brand.brand_id')
                                                                
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
                            return view('pages.category.show_category')->with('category_byID', $category_byID)
                            ->with('category', $category)
                            ->with('brand', $brand)
                            ->with('category_name',$category_name);    
                    }else{
                        if ($sort==0){
                            $category_byID = DB::table('product')->where('product_status','1')
                            ->where('product.category_id',$category_id)->join('category','product.category_id','=','category.category_id')
                            ->join('brand','product.brand_id', '=','brand.brand_id')
                                                                 
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
                                $category_byID = DB::table('product')->where('product_status','1')
                                ->where('product.category_id',$category_id)->join('category','product.category_id','=','category.category_id')
                                ->join('brand','product.brand_id', '=','brand.brand_id')
                                                                      
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
                                    $category_byID = DB::table('product')->where('product_status','1')
                                    ->where('product.category_id',$category_id)->join('category','product.category_id','=','category.category_id')
                                    ->join('brand','product.brand_id', '=','brand.brand_id')
                                                                          
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
                                        $category_byID = DB::table('product')->where('product_status','1')
                                        ->where('product.category_id',$category_id)->join('category','product.category_id','=','category.category_id')
                                        ->join('brand','product.brand_id', '=','brand.brand_id')
                                                                              
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
                                            $category_byID = DB::table('product')->where('product_status','1')
                                            ->where('product.category_id',$category_id)->join('category','product.category_id','=','category.category_id')
                                            ->join('brand','product.brand_id', '=','brand.brand_id')
                                                                                  
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
                                            return view('pages.category.show_category')->with('category_byID', $category_byID)
                                            ->with('category', $category)
                                            ->with('brand', $brand)
                                            ->with('category_name',$category_name);    
                    }
                    
        return view('pages.category.show_category')->with('category_byID', $category_byID)
        ->with('category', $category)
        ->with('brand', $brand)
        ->with('category_name',$category_name);
    }
   



    
}