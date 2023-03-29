<!-- lấy các phần của layout -->
@extends('layout')
<!-- đặt tên cho section là content để sử dụng bên file layout.blade.php bằng @yield('content') -->
@section('content')   

<script>
function add_shoppingCart(clicked_id) {
    var id = clicked_id;
    var name = document.getElementById()
}
</script>
<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">Sản phẩm mới nhất</h2>
    @foreach($all_product as $key => $product)
    <a href="{{URL::to('chi-tiet-san-pham/'.$product->product_id)}}">
    <div class="col-sm-3">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{URL::to('public/upload/product/'.$product->product_image)}}" alt="lỗi" height="145" width="145" />
                    <h2>{{number_format($product->product_price).'VND'}}</h2>
                    <p style="height:55px;text-overflow:ellipsis">{{$product->product_name}}</p>
                    <form action="{{URL::to('/sell-cart')}}" method="post"> 
                        {{csrf_field()}}
                    <p>
                    
                       
                        <input name="productid_hidden" type="hidden" value="{{$product->product_id}}"/>
                        <input name="qty" type="hidden" value="1" class="form-control" style="width:30%"/>
                        
                    </p>
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