@extends('admin_layout')
@section('admin_content')

<div class="row">
    
            <div class="col-lg-12">
           
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm sản phẩm
                        </header>
                        
                            <div class="panel-body">
                            @include('common.alert')
                            <div class="position-center">
                                <form role="form" method="post" action="{{route('admin.save_product')}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-sm-3 form-group">    
                                            <span class="text-danger">* </span><label for="">Mã sản phẩm</label>
                                            <input type="text" name="product_idcode" class="form-control" placeholder="Nhập mã sản phẩm" value="{{ old('product_idcode') }}">
                                            @error('product_idcode')
                                                            <span class="text-danger" style="color: red">{{ $message }} </span>
                                             @enderror
        
                                            
                                        </div>
                                        <div class="col-sm-9 form-group">    
                                            <span class="text-danger">* </span><label for="">Tên sản phẩm</label>
                                            <input type="text" name="product_name" class="form-control" placeholder="Nhập tên sản phẩm" value="{{ old('product_name') }}">
                                            @error('product_name')
                                                            <span class="text-danger" style="color: red">{{ $message }} </span>
                                             @enderror
                                        </div>
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="">Nội dung sản phẩm</label>
                                        <textarea  style="resize:none;" rows="3" name="product_content" class="form-control" 
                                        id="exampleInputPassword1" placeholder="Mô tả" vlaue={{ old('product_content') }}></textarea>
                                    </div>
                                <div class="row">
                                    <div class="col-sm-3 form-group">    
                                        <span class="text-danger">* </span><label for="">Đơn vị tính</label>
                                        <input type="text" name="product_unit" class="form-control" placeholder="Nhập đơn vị tính" value="{{ old('product_unit') }}">
                                        @error('product_unit')
                                                        <span class="text-danger" style="color: red">{{ $message }} </span>
                                         @enderror
                                    </div>
                                    <div class=" col-sm-5 form-group">
                                    <span class="text-danger">* </span><label for="">Giá sản phẩm</label>
                                        <input type="number" name="product_price" class="form-control" value="{{ old('product_price') }}">
                                        @error('product_price')
                                                        <span class="text-danger" style="color: red">{{ $message }} </span>
                                         @enderror
                                    </div>
                                  
                                    <div class="col-sm-4 form-group">
                                        <span class="text-danger">* </span> <label for="">Số lượng hiện có</label>
                                            <input type="number" name="product_SLtrongkho" class="form-control" value="{{ old('product_SLtrongkho') }}" placeholder="Nhập tên danh mục">
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
                                                   <option value='{{$cate->category_id}}'>{{$cate->category_name}}</option>
                                                 
                                               @endforeach
                                         
                                               
                                           </select>
                                   </div>
                                   <div class="col-sm-6 form-group">
                                    <label for="">Thương hiệu</label>
                                       <select class="form-control m-bot15" name="product_brand">
                                       @foreach($brand as $key => $br)
                                               <option value='{{$br->brand_id}}'>{{$br->brand_name}}</option>
                                             
                                           @endforeach
                                           
                                           
                                       </select>
                               </div> 
                                </div>
                               
                               
                                <div class="form-group">
                                    <span class="text-danger">* </span> <label for="">Hình ảnh sản phẩm</label>
                                    <input type="file" name="product_image" class="form-control" value="{{ old('product_image') }}"  >
                                    @error('product_image')
                                                    <span class="text-danger" style="color: red">{{ $message }} </span>
                                     @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Mô tả sản phẩm</label>
                                    <textarea type="password" style="resize:none;" rows="6" name="product_desc" class="form-control" value={{old('product_desc')}} placeholder="Mô tả"></textarea>
                                </div>
                                <div class="form-group" style="width: 40%">
                                     <label for="">Trạng thái</label>
                                        <select class="form-control m-bot15" name="product_status">
                                            <option value='1'>Hiện</option>
                                            <option value='0'>Ẩn</option>
                                            
                                            
                                        </select>
                                </div>
                            
                                <button type="submit" class="btn btn-info" name="add_product">Thêm</button>
                                <a  class="btn btn-warning" name="quay lai" type="button" href="{{route('admin.all_product')}}">Hủy</a>
                           
                            </form>
                           
                                </div>
                            </div>

                        </div>
                    </section>
                  
            </div>
          

@endsection