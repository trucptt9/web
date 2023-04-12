@extends('admin_layout')
@section('admin_content')

<div class="row">
    
            <div class="col-lg-12">
           
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật danh mục sản phẩm
                        </header>
                        
                            <div class="panel-body">
                          @foreach($edit_brand_product as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" method="post" action="{{route('admin.update_brand',['brand_id' =>$edit_value->brand_id ])}}">
                                    {{csrf_field()}}
                                   
                                <div class="form-group">
                                    <label for="">Tên danh mục</label>
                                    <input type="text" name="brand_product_name" value="{{$edit_value->brand_name}}" class="form-control" placeholder="Nhập tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="">Mô tả danh mục</label>
                                    <textarea type="password" style="resize:none;" rows="6"
                                    name="brand_product_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả">{{$edit_value->brand_desc}}</textarea>
                                </div>
                                
                            
                                <button type="submit" class="btn btn-info" name="add_brand_product">Cập nhật</button>
                            </form>
                           
                                </div>
                                @endforeach
                            </div>

                        </div>
                    </section>
                   
      
            </div>
          

@endsection