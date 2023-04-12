@extends('layout')
@section('content')


@foreach($product_detail as $key => $pro_detail)
<div class="product-details">
    <!--product-details-->
    <div class="col-sm-5">
        <div class="view-product">
            <img src="{{asset('upload/product/'.$pro_detail->product_image)}}" alt="" />

        </div>
        <div id="similar-product" class="carousel slide" data-ride="carousel">


        </div>

    </div>
    <div class="col-sm-7">
        <!--/product-information-->
        <div class="product-information">
            <img src="images/product-details/new.jpg" class="newarrival" alt="" />
            <h2>{{$pro_detail->product_name}}</h2>
            <p>ID sản phẩm: {{$pro_detail->product_idcode}}</p>
          
            <?php 
                    $date = date('d/m/Y');
                    $start = date('d/m/Y',strtotime($pro_detail->coupon_start));
                    $end = date('d/m/Y',strtotime($pro_detail->coupon_end));
                    if($pro_detail->price_final != null && ($date >=  $start && $date <= $end)){
                        ?>
                        <div style="height:px;">
                        <h2 class="tryit">{{number_format($pro_detail->price_final).' VND'}}</h2>
                        <del style="color:#9e9e9e;"> {{number_format($pro_detail->product_price).' VND '}} </del>
                        <span style="font-weight:500;"> -{{$pro_detail->coupon_value *100}}%</span>
                    </div>
                        <?php
                    
                    }else{
                ?>
                   <div style="height:46px;">
                        <h3 class="tryit" >{{number_format($pro_detail->product_price).' VND'}}</h3>
                    </div>
                        <?php   
                }
                ?>
            <p><b>Thương hiệu:</b> {{$pro_detail->brand_name}}</p>
            <?php
                if($pro_detail->product_SLtrongkho > 0){
                   
            ?> <p><b>Trạng thái: </b>Còn hàng</p>
                    <form action="{{ route('save_cart')}}" method="POST"> 
                        {{csrf_field()}}
                        <?php 
                    $date = date('d/m/Y');
                    $start = date('d/m/Y',strtotime($pro_detail->coupon_start));
                    $end = date('d/m/Y',strtotime($pro_detail->coupon_end));
                    if($pro_detail->price_final != null && ($date >=  $start && $date <= $end)){
                        ?>
                       <input name="price" type="hidden" value="{{$pro_detail->price_final}}"/>
                    </div>
                        <?php
                    
                    }else{
                ?>
                   <input name="price" type="hidden" value="{{$pro_detail->product_price}}"/>
                        <?php   
                }
                ?>
                    <p>
                    
                        <label>Số lượng:</label>
                        <input name="productid_hidden" type="hidden" value="{{$pro_detail->product_id}}"/>
                        <input name="qty" type="number" value="1" class="form-control" style="width:30%" min= "1" max ="{{$pro_detail->product_SLtrongkho}}"/>
                      
                    </p>
                    <button type="submit" class="btn btn-fefault cart mt-4" style="margin-top:20px;margin-left:0px">
                            <i class="fa fa-shopping-cart"></i>
                            Thêm vào giỏ hàng
                    </button>
                    </form>
            <?php
                }
                else{
            ?>
                   <p><b>Trạng thái: </b> <span class="text-danger">Hết hàng<span></p>
                   <form > 
                        {{csrf_field()}}
                    <p>
                    
                        <label>Số lượng:</label>
                        <input name="productid_hidden" type="hidden" value="{{$pro_detail->product_id}}"/>
                        <input name="qty" type="number" value="1" class="form-control" style="width:30%"/>
                        
                    </p>
                    <button type="submit" class="btn btn-secondary cart mt-4 disabled"
                     style="margin-top:20px;margin-left:0px; background-color:grey;"
                    
                     >
                            <i class="fa fa-shopping-cart"></i>
                            Thêm vào giỏ hàng
                    </button>
                    </form>
            <?php
                }
            ?>
           
            
            
           
            <a href=""><img src="images/product-details/share.png" class="share img-responsive" alt="" /></a>
        </div>
        <!--/product-information-->
    </div>
</div>
<div class="category-tab shop-details-tab">
    <!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#details" data-toggle="tab">Đặc điểm nổi bật</a></li>
            <li><a href="#companyprofile" data-toggle="tab">Mô tả</a></li>
            <li ><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="details">
        <p>{{$pro_detail->product_content}}</p>
        </div>

        <div class="tab-pane fade" id="companyprofile">
        <p>{{$pro_detail->product_desc}}</p>
            
        </div>

        <div class="tab-pane fade " id="reviews">
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                </ul>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur.</p>
                <p><b>Write Your Review</b></p>

                <form action="#">
                    <span>
                        <input type="text" placeholder="Your Name" />
                        <input type="email" placeholder="Email Address" />
                    </span>
                    <textarea name=""></textarea>
                    <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                    <button type="button" class="btn btn-default pull-right">
                        Submit
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>


@endforeach
@endsection