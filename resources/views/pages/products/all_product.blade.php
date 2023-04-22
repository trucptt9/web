<!-- lấy các phần của layout -->
@extends('layout')
<!-- đặt tên cho section là content để sử dụng bên file layout.blade.php bằng @yield('content') -->
@section('content')   


<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">Tất cả sản phẩm</h2>
     <div class="title">
     <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" style="margin:10px;0px"
                        data-target="#myModal"><i class="fa-solid fa-filter"></i>
                        Bộ lọc 
                    </button>

                    <!-- Modal -->
                    <form action="" method="get">
                        {{csrf_field()}}
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                    
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <a type="" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></a>
                                        <h2 class="modal-title" id="myModalLabel">Bộ lọc</h2>
                                    </div>
                                    <div class="modal-body">
                    
                                        <div class="form-one" style="width:100%">


                                            <table class="table-responsive" style="width:100%">
                                                <tr>
                                                    <td class="form-control text-center">Sắp xếp theo:</td>
                                                    <td colspan="2">
                                                        <select name="sort" id="sort" class="form-control text-center" value="{{  $_GET['sort'] ?? ''  }}">
                                                            <option value="0"></option>
                                                            <!-- <option value="1">Bán Chạy</option> -->
                                                            <option value="2">Giá tăng dần</option>
                                                            <option value="3">Giá giảm dần</option>
                                                            <option value="4">Tên A->Z</option>
                                                            <option value="5">Tên Z->A</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="form-control text-center">Lọc theo giá</td>
                                                    <td><input class="form-control text-center" type="number" placeholder="Từ" name="price_min" value="{{  $_GET['price_min'] ?? ''  }}"></td>
                                                    <td><input class="form-control text-center" type="number" placeholder="Đến" name="price_max" value="{{  $_GET['price_max'] ?? ''  }}"></td>
                                                </tr>
                                                <tr>
                                                    <td class="form-control text-center">Khuyến mãi:</td>
                                                    <td colspan="">
                                                        <input class="form-control text-center" type="number" placeholder="Từ" name="coupon_min" value="{{  $_GET['coupon_min'] ?? ''  }}">
                                                    </td>
                                                    <td colspan="">
                                                        <input class="form-control text-center" type="number" placeholder="đến" name="coupon_max" value="{{  $_GET['coupon_max'] ?? ''  }}">
                                                    </td>
                                                </tr>
                                               <!--  <tr>
                                                    <td class="form-control text-center">Tình trạng:</td>
                                                    <td colspan="2">
                                                        <select name="status" id="status" class="form-control text-center" value="{{  $_GET['status'] ?? ''  }}">
                                                            <option value="0">Tất cả</option>
                                                            <option value="1">Còn hàng</option>
                                                            <option value="2">Hết hàng</option>
                                                            
                                                        </select>
                                                    </td>
                                                </tr> -->
                                            </table>
                                            
                    
                    
                    
                                        </div>
                                    </div>
                                    <div class="modal-footer ">
                    
                    
                                        <input type="submit" class="btn btn-success" 
                                            style="margin-top:10px" value="Đồng ý">
                                        <button type="button" class="btn btn-info" data-dismiss="modal"
                                            style="margin-top:10px">Đóng</button>
                                    </div>
                                </div>
                    
                            </div>
                        </div>
                    
                    </form>

                       <!--  <form action="" method="get">
                            {{csrf_field()}}
                            <div class="search_box pull-right" style="width:250px">
                                <input type="text" placeholder="Tìm kiếm" name="keyword_sub" value="{{  $_GET['keyword_sub'] ?? ''  }}"/>
                                <button type="submit" class="btn btn-primary btn-sm" style="margin-top:0px">
                                    <i class="fa-solid fa-magnifying-glass"></i> </button>
                            </div>
                     </form> -->
                     
                     
                    </div>
    @foreach($products as $key => $product)
    <a href="{{route('detail_product',['product_id'=>$product->product_id])}}">
    <div class="col-sm-3">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{asset('upload/product/'.$product->product_image)}}" alt="lỗi" height="145" width="145" />
                   
                         <p style="height:35px;text-overflow:ellipsis">{{$product->product_name}}</p>
                         <?php 
                          $date = date('d/m/Y');
                          $start = date('d/m/Y',strtotime($product->coupon_start));
                          $end = date('d/m/Y',strtotime($product->coupon_end));
                    if($product->price_final != null && ($date >=  $start && $date <= $end)){
                        ?>
                        <div>
                         <h2 class="tryit">{{number_format($product->price_final).' VND'}}</h2>
                    <del style="color:#9e9e9e;"> {{number_format($product->product_price).' VND '}} </del>
                    <span style="font-weight:500;"> -{{$product->coupon_value *100}}%</span>
                    </div>
                <?php
                    
                    }else{
                ?>
                <div style="height:46px">
                    <h2 class="tryit"  >{{number_format($product->product_price).' VND'}}</h2>
                    <del style="color:#9e9e9e; display:none;" > dd </del>
                    <span style="font-weight:500;display:none;" >d </span>
                    </div>
                <?php   
                }
                ?>
                 
                    <form action="{{ route('sell_cart')}}" method="post"> 
                        {{csrf_field()}}
                    
                        <?php 
                    $date = date('d/m/Y');
                    $start = date('d/m/Y',strtotime($product->coupon_start));
                    $end = date('d/m/Y',strtotime($product->coupon_end));
                    if($product->price_final != null && ($date >=  $start && $date <= $end)){
                        ?>
                           <input name="price_final" type="hidden" value="{{$product->price_final}}"/>
                    
                      
                <?php
                    
                    }else{
                ?>
                
                <input name="price_final" type="hidden" value="{{$product->product_price}}"/>
                  <?php   
                  }
                  ?>
                       
                        <input name="productid_hidden" type="hidden" value="{{$product->product_id}}"/>
                        <input name="qty" type="hidden" value="1" class="form-control" style="width:30%"/>
                        
                    
                    <?php
                        if($product->product_SLtrongkho >0 ){
                    ?>
                        <button type="submit" class="btn btn-fefault cart mt-4" style="margin-top:;margin-left:0px">
                            <i class="fa fa-shopping-cart"></i>
                            Mua ngay
                        </button>
                    <?php
                    }else{
                    ?>
                     <button type="submit" class="btn btn-fefault cart mt-4 disabled" style="margin-top:;margin-left:0px">
                            <i class="fa fa-shopping-cart"></i>
                            Mua ngay
                        </button>
                   <?php
                    }
                    ?>
                    

                    </form>
                </div>
                
            </div>
         
        </div>
    </div>
</a>
    @endforeach

</div>

@endsection