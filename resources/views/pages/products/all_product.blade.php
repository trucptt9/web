<!-- lấy các phần của layout -->
@extends('layout')
<!-- đặt tên cho section là content để sử dụng bên file layout.blade.php bằng @yield('content') -->
@section('content')   


<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">Tất cả sản phẩm</h2>
    @foreach($products as $key => $product)
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
                    <button type="submit" class="btn btn-fefault cart mt-4" style="margin-top:20px;margin-left:0px">
                        <i class="fa fa-shopping-cart"></i>
                        Mua ngay
                     </button>
                    

                    </form>
                </div>
                
            </div>
         
        </div>
    </div>
</a>
    @endforeach

</div>

@endsection