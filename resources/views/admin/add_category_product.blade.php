@extends('admin_layout')
@section('admin_content')

<div class="row">
    
            <div class="col-lg-12">
           
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm danh mục sản phẩm
                        </header>
                        
                            <div class="panel-body">
                          
                            <div class="position-center">
                                <form role="form" method="post" action="{{URL::to('/save-category-product')}}">
                                    {{csrf_field()}}
                                   
                                <div class="form-group">
                                    <label for="">Tên danh mục</label>
                                    <input type="text" name="category_product_name" class="form-control" placeholder="Nhập tên danh mục">
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
                            </form>
                           
                                </div>
                            </div>

                        </div>
                    </section>
                    @if(Session::has('message'))
                            <script>
                                swal("Thông báo","{{Session::get('message')}}",'success',{
                                    button:true,
                                    button:"OK",
                                }
                                );
                            </script>
                     @endif
      
            </div>
          

@endsection