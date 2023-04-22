<!-- lấy các phần của layout -->
@extends('layout')
<!-- đặt tên cho section là content để sử dụng bên file layout.blade.php bằng @yield('content') -->
@section('content')        
<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">Kết quả tìm kiếm</h2>
    @foreach($result as $key => $product)
    
    <div class="col-sm-3">
    <a href="{{route('detail_product',['product_id'=>$product->product_id])}}">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{asset('upload/product/'.$product->product_image)}}" alt="lỗi" height="145" width="145" />
                    <h2>{{number_format($product->product_price).'VND'}}</h2>
                    <p style="height:55px;text-overflow:ellipsis">{{$product->product_name}}</p>
                    <form action="{{ route('sell_cart')}}" method="post"> 
                        {{csrf_field()}}
                  
                        <input name="productid_hidden" type="hidden" value="{{$product->product_id}}"/>
                        <input name="qty" type="hidden" value="1" class="form-control" style="width:30%"/>
                        
                   
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