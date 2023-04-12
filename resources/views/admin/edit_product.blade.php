@extends('admin_layout')
@section('admin_content')

<div class="row">
    
            <div class="col-lg-12">
           
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật sản phẩm
                        </header>
                        
                            <div class="panel-body">
                          
                            <div class="position-center">
                                @foreach($edit_product as $key =>$pro)
                                <form role="form" method="post" action="{{route('admin.update_product',['product_id'=>$pro->product_id])}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-sm-3 form-group">    
                                            <span class="text-danger">* </span><label for="">Mã sản phẩm</label>
                                            <input type="text" name="product_idcode" class="form-control" placeholder="Nhập mã sản phẩm" value="{{ $pro->product_idcode }}">
                                           
        
                                            
                                        </div>
                                        <div class="col-sm-9 form-group">    
                                            <span class="text-danger">* </span><label for="">Tên sản phẩm</label>
                                            <input type="text" name="product_name" class="form-control"  value="{{ $pro->product_name }}">
                                            @error('product_name')
                                                            <span class="text-danger" style="color: red">{{ $message }} </span>
                                             @enderror
                                        </div>
                                    </div>
                                
                                <div class="form-group">
                                    <label for="">Nội dung sản phẩm</label>
                                    <textarea style="resize:none;" rows="3" name="product_content"
                                     class="form-control" >{{ $pro->product_content }}</textarea>
                                   
                                </div>
                                <div class="row">
                                    <div class="col-sm-3 form-group">    
                                        <span class="text-danger">* </span><label for="">Đơn vị tính</label>
                                        <input type="text" name="product_unit" class="form-control" placeholder="Nhập đơn vị tính" value="{{ $pro->product_unit }}">
                                        @error('product_unit')
                                                        <span class="text-danger" style="color: red">{{ $message }} </span>
                                         @enderror
                                    </div>
                                    <div class=" col-sm-5 form-group">
                                    <span class="text-danger">* </span><label for="">Giá sản phẩm</label>
                                        <input type="number" name="product_price" class="form-control" value="{{ $pro->product_price }}">
                                        @error('product_price')
                                                        <span class="text-danger" style="color: red">{{ $message }} </span>
                                         @enderror
                                    </div>
                                  
                                    <div class="col-sm-4 form-group">
                                        <span class="text-danger">* </span> <label for="">Số lượng hiện có</label>
                                            <input type="number" name="product_SLtrongkho" class="form-control" value="{{ $pro->product_SLtrongkho }}" >
                                            @error('product_SLtrongkho')
                                                            <span class="text-danger" style="color: red">{{ $message }} </span>
                                             @enderror
                                        </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label for="">Danh mục</label>
                                           <select class="form-control m-bot15" name="product_category">
                                            @foreach($category as $key => $cate)
                                             @if($cate->category_id == $pro->category_id)
                                                <option selected value='{{$cate->category_id}}'>{{$cate->category_name}}</option>
                                       @else
                                       <option value='{{$cate->category_id}}'>{{$cate->category_name}}</option>
                                       @endif

                                                 
                                               @endforeach
                                         
                                               
                                           </select>
                                   </div>
                                   <div class="col-sm-6 form-group">
                                    <label for="">Thương hiệu</label>
                                       <select class="form-control m-bot15" name="product_brand">
                                        @foreach($brand as $key => $br)
                                            @if($br->brand_id == $pro->brand_id)
                                                <option selected value='{{$br->brand_id}}'>{{$br->brand_name}}</option>
                                            @else
                                                 <option value='{{$br->brand_id}}'>{{$br->brand_name}}</option>
                                             @endif

                                             
                                           @endforeach
                                           
                                           
                                       </select>
                               </div> 
                                </div>
                               
                               
                                <div class="form-group">
                                    <label for="">Hình ảnh sản phẩm</label>
                                    <input type="file" name="product_image" class="form-control" >
                                    <img src="{{URL::to('public/upload/product/'.$pro->product_image)}}" height="100" width="100">  

                                </div>
                                <div class="form-group">
                                    <label for="">Mô tả sản phẩm</label>
                                    <textarea type="text" style="resize:none;" rows="6" name="product_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả"></textarea>
                                </div>
                                
                            
                               
                                <a  class="btn btn-warning" name="quay lai" type="button" href="{{route('admin.all_product')}}">Hủy</a>
                            
                                <button type="submit" class="btn btn-info" name="update_product">Cập nhật</button>
                            </form>
                           @endforeach
                                </div>
                            </div>

                        </div>
                    </section>
                    <!-- @if(Session::has('message'))
                            <script>
                                swal("Thông báo","{{Session::get('message')}}",'success',{
                                    button:true,
                                    button:"OK",
                                }
                                );
                            </script>
                     @endif -->
      
            </div>
          

@endsection