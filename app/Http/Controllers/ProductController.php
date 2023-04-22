<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;
class ProductController extends Controller
{
    public function add_product(){
        
        $category = DB::table('category')->orderBy("category_id","desc")->get();
        $brand = DB::table('brand')->orderBy("brand_id","desc")->get();
        return view('admin.add_product')->with('category',$category)
                                         ->with('brand',$brand);
    }

    public function all_product(Request $request){
        $search = $request->search ?? '';
        
        $all_product = DB::table('product')
        ->join('category','product.category_id', '=','category.category_id')
                                            ->join('brand','product.brand_id', '=','brand.brand_id') 
                                            ->select('product.*','category.category_name','brand.brand_name')
                                            ->where('product.product_name', 'LIKE', "%$search%")
                                            ->orderBy('product.product_id','desc')
                                            ->paginate(10);
     
    return view('admin.all_product')->with('all_product', $all_product);
                                        
    }
    public function tat_ca_sp(Request $request){
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
        
        $search = $request->keyword_sub ?? '';
        $category = DB::table('category')->orderBy("category_id","desc")->get();
        $brand = DB::table('brand')->orderBy("brand_id","desc")->get();
        $products = DB::table('product')->where('product_status','1')
        ->join('category','product.category_id', '=','category.category_id')
                                            ->join('brand','product.brand_id', '=','brand.brand_id')  
                                            ->leftJoin('promotional_products','product.product_id','promotional_products.product_id')
                                            ->leftJoin('coupon','promotional_products.coupon_id','coupon.coupon_id')
                                            ->where('product.product_name','like',"%$search%")
                                            ->where('product.product_price','>',$price_min)
                                            ->where('product.product_price','<',$price_max)
                                            ->orWhere('promotional_products.price_final','<=',$price_max)
                                            ->Where('promotional_products.price_final','>=',$price_max)
                                            ->select('product.*','category.category_name','brand.brand_name','promotional_products.price_final','coupon.*')
                                                
                                            ->get();
        
        if($coupon_min==0&&$coupon_max>1){
            if ($sort==0){
            $products = DB::table('product')->where('product_status','1')
            ->join('category','product.category_id', '=','category.category_id')
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
            }/* elseif($sort==1){
                $products = DB::table('product')->where('product_status','1')
                                                    ->join('category','product.category_id', '=','category.category_id')
                                                    ->join('brand','product.brand_id', '=','brand.brand_id')  
                                                    ->leftJoin('promotional_products','product.product_id','promotional_products.product_id')
                                                    ->leftJoin('coupon','promotional_products.coupon_id','coupon.coupon_id')
                                                    ->where('product.product_name','like',"%$search%")
                                                    ->where('product.product_price','>',$price_min)
                                                    ->where('product.product_price','<',$price_max)
                                                    
                                                    ->leftJoin('order_detail','order_detail.product_id','product.product_id')
                                                    
                                                    ->select('product.*','category.category_name','brand.brand_name','promotional_products.price_final','coupon.*',DB::raw('sum(order_detail.product_qty) as count'))
                                                    ->groupBy('product.*')
                                                    ->orderBy('count','desc')
                                                    ->get();
                } */elseif($sort==2){
                $products = DB::table('product')->where('product_status','1')
                ->join('category','product.category_id', '=','category.category_id')
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
                    $products = DB::table('product')->where('product_status','1')
                    ->join('category','product.category_id', '=','category.category_id')
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
                        $products = DB::table('product')->where('product_status','1')
                        ->join('category','product.category_id', '=','category.category_id')
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
                            $products = DB::table('product')->where('product_status','1')
                            ->join('category','product.category_id', '=','category.category_id')
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
                            return view('pages.products.all_product')->with('products', $products)
                            ->with('category', $category)
                            ->with('brand', $brand);    
                    }else{
                        if ($sort==0){
                            $products = DB::table('product')->where('product_status','1')
                            ->join('category','product.category_id', '=','category.category_id')
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
                            }/* elseif($sort==1){
                                $products = DB::table('product')->where('product_status','1')
                                                                    ->join('category','product.category_id', '=','category.category_id')
                                                                    ->join('brand','product.brand_id', '=','brand.brand_id')  
                                                                    ->leftJoin('promotional_products','product.product_id','promotional_products.product_id')
                                                                    ->leftJoin('coupon','promotional_products.coupon_id','coupon.coupon_id')
                                                                    ->where('product.product_name','like',"%$search%")
                                                                    ->where('product.product_price','>',$price_min)
                                                                    ->where('product.product_price','<',$price_max)
                                                                    
                                                                    ->leftJoin('order_detail','order_detail.product_id','product.product_id')
                                                                    
                                                                    ->select('product.*','category.category_name','brand.brand_name','promotional_products.price_final','coupon.*',DB::raw('sum(order_detail.product_qty) as count'))
                                                                    ->groupBy('product.*')
                                                                    ->orderBy('count','desc')
                                                                    ->get();
                                } */elseif($sort==2){
                                $products = DB::table('product')->where('product_status','1')
                                ->join('category','product.category_id', '=','category.category_id')
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
                                    $products = DB::table('product')->where('product_status','1')
                                    ->join('category','product.category_id', '=','category.category_id')
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
                                        $products = DB::table('product')->where('product_status','1')
                                        ->join('category','product.category_id', '=','category.category_id')
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
                                            $products = DB::table('product')->where('product_status','1')
                                            ->join('category','product.category_id', '=','category.category_id')
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
                                            return view('pages.products.all_product')->with('products', $products)
                                            ->with('category', $category)
                                            ->with('brand', $brand);    
                    }
                    
        return view('pages.products.all_product')->with('products', $products)
        ->with('category', $category)
        ->with('brand', $brand);
                                        
    }
    public function save_product(Request $request){
        

        $request->validate([
            
            'product_name'=> 'required',
             'product_unit'=> 'required',
              'product_idcode'=> 'required|unique:product,product_idcode',
              
            'product_content' => 'nullable',
            'product_price'=> 'required|numeric',
            'product_SLtrongkho'=> 'required',
            'product_image'=> 'required|image',
        ],
        [
           "product_idcode.required"=>"Trường này không được bỏ trống",
           "product_idcode.unique"=>"Mã sản phẩm đã tồn tại",
           "product_unit.required"=>"Trường này không được bỏ trống",
            "product_name.required"=>"Trường này không được bỏ trống",
            "product_price.required"=>"Trường này không được bỏ trống",
            "product_price.numeric"=>"Trường này không được nhập kí tự",
            "product_SLtrongkho.required"=>"Trường này không được bỏ trống",
            "product_image.required"=>"Trường này không được bỏ trống",
           
        ]);
        $data = array();
        // 'brand_name' là của cột trong bảng brand tên phải giống với cột trong csdl ko đc khác
        $data['product_name'] = $request->product_name;
         $data['product_idcode'] = $request->product_idcode;
          $data['product_unit'] = $request->product_unit;
        $data['product_price'] = $request->product_price;
        $data['brand_id'] = $request->product_brand;
        $data['category_id'] = $request->product_category;
        $data['product_content'] = $request->product_content;
        $data['product_desc'] = $request->product_desc;
        $data['product_status'] = $request->product_status;
        $data['product_SLtrongkho'] = $request->product_SLtrongkho;
        $get_image = $request->file('product_image');
        // thêm ảnh vào public/upload
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('upload/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('product')->insert($data); 
            
            return to_route('admin.add_product')->with('success', 'Thêm sản phẩm thành công');
        }
        $data['product_image'] = '';

        DB::table('product')->insert($data); 
         
        return to_route('admin.add_product')->with('success', 'Thêm sản phẩm thành công');
    }

    public function unactive_product($product_id){
        
       DB::table('product')->where('product_id',$product_id)
                            ->update(['product_status'=> 0]);

       
        
        return to_route('admin.all_product');
    }
    public function active_product($product_id){
        
        DB::table('product')->where('product_id',$product_id)
                            ->update(['product_status'=> 1]);
         
                    
         return to_route('admin.all_product');
     }

     public function edit_product($product_id){
        
        $category = DB::table('category')->orderBy("category_id","desc")->get();
        $brand = DB::table('brand')->orderBy("brand_id","desc")->get();
        $edit_product = DB::table('product')->where('product_id',$product_id)->get(); 
        return view('admin.edit_product')->with('edit_product', $edit_product)
                      ->with('category', $category)
                      ->with('brand', $brand);
     }
     public function update_product($product_id, Request $request){
        
       $data = array();
       $data['product_name'] = $request->product_name;
       $data['product_idcode'] = $request->product_idcode;
       $data['product_unit'] = $request->product_unit;
       $data['product_price'] = $request->product_price;
       $data['brand_id'] = $request->product_brand;
       $data['category_id'] = $request->product_category;
       $data['product_content'] = $request->product_content;
       $data['product_desc'] = $request->product_desc;
       $data['product_SLtrongkho'] = $request->product_SLtrongkho;
       $get_image = $request->file('product_image');

       if($get_image){
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move('public/upload/product',$new_image);
        $data['product_image'] = $new_image;

        DB::table('product')->where('product_id',$product_id)->update($data); 

     
        return to_route('admin.all_product')->with('success','Cập nhật thành công!');
       }
       
        DB::table('product')->where('product_id',$product_id)->update($data); 
       
        return to_route('admin.all_product')->with('success','Cập nhật thành công!');
     }
     public function delete_product($product_id){
      
        
        DB::table('product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return to_route('admin.all_product');
      }

    //   trang chi tiết sp
    public function detail_product(Request $request,$product_id){

     
        $category = DB::table('category')->where('category_status','1')->orderBy("category_id","desc")->get();
        $brand = DB::table('brand')->where('brand_status','1')->orderBy("brand_id","desc")->get();

        $product_detail = DB::table('product') ->where('product.product_id',$product_id) 
        ->join('category','product.category_id', '=','category.category_id')
        ->join('brand','product.brand_id', '=','brand.brand_id') 
        ->leftJoin('promotional_products','product.product_id','promotional_products.product_id')
        ->leftJoin('coupon','promotional_products.coupon_id','coupon.coupon_id')
        ->select('product.*','coupon.*','brand.*','category.*','promotional_products.price_final')
        ->get();

       

        return view('pages.products.show_detail_product')
        ->with('category',$category)->with('brand',$brand)
        ->with('product_detail',$product_detail);
    }

    public function khuyen_mai(){

        return view('admin.khuyenmai');
    }

    public function out_of_stock_product(Request $request){
        $search = $request->search ?? '';
        
        $all_product = DB::table('product')->where('product.product_SLtrongkho','<=',5)
        ->join('category','product.category_id', '=','category.category_id')
                                            ->join('brand','product.brand_id', '=','brand.brand_id') 
                                            ->select('product.*','category.category_name','brand.brand_name')
                                            ->where('product.product_name', 'LIKE', "%$search%")
                                            ->orderBy('product.product_id','desc')
                                            ->paginate(10);
     
    return view('admin.all_product')->with('all_product', $all_product);
    }
}