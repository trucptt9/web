@extends('admin_layout')
@section('admin_content')

<div class="row">
    
            <div class="col-lg-12">
           
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm sản phẩm
                        </header>
                        
                            <div class="panel-body">
                          
                            <div class="position-center">
                                <form role="form" method="post" action="{{URL::to('/save-product')}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                   
                                <div class="form-group">    
                                    <label for="">Tên sản phẩm</label>
                                    <input type="text" name="product_name" class="form-control" placeholder="Nhập tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="">Nội dung sản phẩm</label>
                                    <textarea type="password" style="resize:none;" rows="3" name="product_content" class="form-control" id="exampleInputPassword1" placeholder="nội dung sản phẩm"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">Giá sản phẩm</label>
                                    <input type="text" name="product_price" class="form-control" placeholder="Nhập tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="">Số lượng hiện có</label>
                                    <input type="number" name="product_SLtrongkho" class="form-control" placeholder="Nhập tên danh mục">
                                </div>
                                <div class="form-group">
                                     <label for="">Danh mục</label>
                                        <select class="form-control m-bot15" name="product_category">
                                        @foreach($category as $key => $cate)
                                                <option value='{{$cate->category_id}}'>{{$cate->category_name}}</option>
                                              
                                            @endforeach
                                      
                                            
                                        </select>
                                </div>
                                <div class="form-group">
                                     <label for="">Thương hiệu</label>
                                        <select class="form-control m-bot15" name="product_brand">
                                        @foreach($brand as $key => $br)
                                                <option value='{{$br->brand_id}}'>{{$br->brand_name}}</option>
                                              
                                            @endforeach
                                            
                                            
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Hình ảnh sản phẩm</label>
                                    <input type="file" name="product_image" class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="">Mô tả sản phẩm</label>
                                    <textarea type="password" style="resize:none;" rows="6" name="product_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả"></textarea>
                                </div>
                                <div class="form-group">
                                     <label for="">Trạng thái</label>
                                        <select class="form-control m-bot15" name="product_status">
                                            <option value='0'>Ẩn</option>
                                            <option value='1'>Hiện</option>
                                            
                                        </select>
                                </div>
                            
                                <button type="submit" class="btn btn-info" name="add_product">Thêm</button>
                            </form>
                           
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