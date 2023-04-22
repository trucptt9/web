@extends('admin_layout')
@section('admin_content')

<div class="row">
    
            <div class="col-lg-12">
           
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm danh mục sản phẩm
                        </header>
                       
                            <div class="panel-body">
                            @include('common.alert')
                            <div class="position-center">
                                <form role="form" method="post" action="{{ route('admin.save_category') }}">
                                    {{csrf_field()}}
                                   
                                <div class="form-group">
                                    <label for="">Tên danh mục</label>
                                    <input type="text" name="category_product_name" class="form-control" placeholder="Nhập tên danh mục">
                                    @error('category_product_name')
                                                    <span class="text-danger" style="color: red">{{ $message }} </span>
                                     @enderror
                                                        
                                </div>
                                <div class="form-group">
                                    <label for="">Mô tả danh mục</label>
                                    <textarea type="password" style="resize:none;" rows="6" name="category_product_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả"></textarea>
                                </div>
                                <div class="form-group">
                                     <label for="">Trạng thái</label>
                                        <select class="form-control m-bot15" name="category_product_status">
                                            <option value='0'>Ẩn</option>
                                            <option value='1'>Hiện</option>
                                            
                                        </select>
                                </div>
                            
                                <button type="submit" class="btn btn-info" name="add_category_product">Thêm</button>
                                <a  class="btn btn-warning" name="quay lai" type="button" href="{{ route('admin.all_category') }}">Hủy</a>
                            </form>
                           
                                </div>
                            </div>

                        </div>
                    </section>
                    
            </div>
          

@endsection