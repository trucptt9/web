@extends('admin_layout')
@section('admin_content')
            <div class="col-lg-12">
           
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm thương hiệu sản phẩm
                        </header>
                       
                            <div class="panel-body">
                            @include('common.alert')
                            <div class="position-center">
                                <form role="form" method="post" action="{{route('admin.save_brand')}}">
                                    {{csrf_field()}}
                                   
                                    <div class="form-group">
                                        <label for="">Tên thương hiệu</label>
                                        <input type="text" name="brand_product_name" class="form-control" placeholder="Nhập tên danh mục">
                                                @error('brand_product_name')
                                                    <span class="text-danger" style="color: red">{{ $message }} </span>
                                                 @enderror
                                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="">Mô tả</label>
                                        <textarea type="password" style="resize:none;" rows="6" name="brand_product_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Trạng thái</label>
                                            <select class="form-control m-bot15" name="brand_product_status">
                                                <option value='0'>Ẩn</option>
                                                <option value='1'>Hiện</option>
                                                
                                            </select>
                                    </div>
                                
                                     <button type="submit" class="btn btn-info" name="save_brand_product">Thêm</button>
                                     <a  class="btn btn-warning" name="quay lai" type="button" href="{{route('admin.all_brand')}}">Hủy</a>
                                </form>
                              
                               
                                </div>
                            </div>

                        </div>
                    </section>
                   
                    
                    
                           
            </div>
          

@endsection