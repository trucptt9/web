@extends('admin_layout')
@section('admin_content')
            <div class="col-lg-12">
           
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm thương hiệu sản phẩm
                        </header>
                        <?php
                         $message = Session::get('message');
                            if($message){
                        
                            echo '<span class="text-center" style="color: green; font-weight: bold;">'.$message.'</span>';
                                Session::put('message',null);
                            }
                        ?>
                            <div class="panel-body">
                          
                            <div class="position-center">
                                <form role="form" method="post" action="{{URL::to('/save-brand-product')}}">
                                    {{csrf_field()}}
                                   
                                    <div class="form-group">
                                        <label for="">Tên thương hiệu</label>
                                        <input type="text" name="brand_product_name" class="form-control" placeholder="Nhập tên danh mục">
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
                                    
                                </form>
                              
                               
                                </div>
                            </div>

                        </div>
                    </section>
                   
                    
                    
                           
            </div>
          

@endsection