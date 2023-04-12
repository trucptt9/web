<!-- lấy các phần của layout -->
@extends('layout')
<!-- đặt tên cho section là content để sử dụng bên file layout.blade.php bằng @yield('content') -->
@section('content')        
<div class="features_items">
    <!--features_items-->
    @foreach($brand_name as $key => $name)
    <h2 class="title text-center">{{$name->brand_name}}</h2>
    @endforeach
    @foreach($brand_byID as $key => $product)
    <a href="{{route('detail_product',['product_id'=>$product->product_id])}}">
    <div class="col-sm-3">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{asset('upload/product/'.$product->product_image)}}" alt="lỗi" height="145" width="145"    />
                    
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
  <h2 class="tryit" >{{number_format($product->product_price).' VND'}}</h2>
  </div>
                <?php   
                }
                ?>
                    <form action="{{ route('sell_cart')}}" method="POST"> 
                        {{csrf_field()}}
                        <input name="productid_hidden" type="hidden" value="{{$product->product_id}}"/>
                        <input name="qty" type="hidden" value="1" class="form-control" style="width:30%"/>


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
                    
                    <?php
                        if($product->product_SLtrongkho >0 ){
                    ?>
                        <button type="submit" class="btn btn-fefault cart mt-4" style="margin-top:20px;margin-left:0px">
                            <i class="fa fa-shopping-cart"></i>
                            Mua ngay
                        </button>
                    <?php
                    }else{
                    ?>
                     <button type="submit" class="btn btn-fefault cart mt-4 disabled" style="margin-top:20px;margin-left:0px">
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