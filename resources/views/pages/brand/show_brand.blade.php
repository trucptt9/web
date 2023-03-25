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
    <a href="{{URL::to('chi-tiet-san-pham/'.$product->product_id)}}">
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{URL::to('public/upload/product/'.$product->product_image)}}" alt="lỗi" />
                    <h2>{{number_format($product->product_price).'VND'}}</h2>
                    <p style="height:55px;text-overfl   ow:ellipsis">{{$product->product_name}}</p>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                </div>
               
            </div>
          
        </div>
    </div>
    </a>
    @endforeach

</div>

@endsection