<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Web bán phụ kiện</title>
    <link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{ asset('frontend/images/ico/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">

    <style>
    .lzd-header .lzd-logo-bar .logo-bar-content .lzd-nav-cart .cart-num {
    position: absolute;
    background: #f36e36;
    color: #fff;
    top: -4px;
    font-weight: 400;
    right: -4px;
    text-align: center;
    border: 3px solid #f36e36;
    font-size: 13px;
    min-width: 14px;
    line-height: 14px;
    border-radius: 50%;
    display: none;
}
    </style>

      
<body>
@include('sweetalert::alert')
    <header id="header">
        <!--header-->
        <!-- <div class="header_top">
            
        </div> -->
        <!--/header_top-->

        <div class="header-middle">
            <!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="{{ route('home') }}" title="logo"><img src="{{asset('frontend/images/Capture.PNG')}}" alt="" height="70";/></a>
                        </div>
                      
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                           
                            <?php
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id != null){

                                ?>
                                
                                <li class="dropdown"><a href="{{ route('account_user',['customer_id'=> $customer_id]) }}"><i class="fa fa-user"></i>Tài khoản<i class="fa fa-angle-down"></i></a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('account_user',['customer_id'=> $customer_id]) }}" style="color:black;">
                                           Quản lý tài khoản</a></li>
										<li><a href="{{ route('order_account',['customer_id'=> $customer_id]) }}" style="color:black;">
                                           Đơn hàng của tôi</a></li>
                                    </ul>
                                </li>
                                <?php
                                }else{
                                ?>
                                
                                 <li class="dropdown"><a href="{{route('login_checkout')}}"><i class="fa fa-user"></i>Tài khoản<i class="fa fa-angle-down"></i></a>
                                    <ul class="sub-menu">
                                        <li><a href="{{route('login_checkout')}}" style="color:black;">
                                           Quản lý tài khoản</a></li>
										<li><a href="{{route('login_checkout')}}" style="color:black;">
                                           Đơn hàng của tôi</a></li>
                                    </ul>
                                </li>
                                <?php
                                } 
                                ?>
                               
                                <!-- <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li> -->

                               
                                <?php
                                    $customer_id = Session::get('customer_id');
                                    $shipping_id = Session::get('shipping_id');
                                    if($customer_id != null || $shipping_id != null){

                                ?>
                                
                                    <li><a href="{{URL::to('/payment/'.$customer_id)}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php
                                }else{
                                ?>
                                 <li><a href="{{route('login_checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php
                                }
                                ?>

                                <li><a href="{{route('show_cart')}}" id="abcv"><i class="fa fa-shopping-cart" id="abcv"></i>Giỏ hàng</a>
                               
                                </li>
                                <?php
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id != null){

                                ?>
                                
                                    <li><a href="{{URL::to('/logout-checkout')}}"><i class="fa-solid fa-arrow-right-from-bracket"></i> Đăng xuất</a></li>
                                <?php
                                }else{
                                ?>
                                <li><a href="{{route('login_checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                                <?php
                                } 
                                ?>
                               
                               
                                
                              
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-middle-->

        <div class="header-bottom">
            <!--header-bottom-->
            <div class="container">
                <div class="row" >
                    <div class="col-sm-8">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left" id="hello">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{ route('home') }}" class="{{(request()->is('trangchu')) ? 'active' : '' }}">Trang chủ</a></li>
                                <li class="" ><a href="{{ route('allproduct')}}" class="{{(request()->is('tat-ca-sp')) ? 'active' : '' }}">Sản phẩm</a>
                                    
                                </li>
                              
                                <li ><a href="{{route('show_cart')}}" class="{{(request()->is('show-cart')) ? 'active' : '' }}" >Giỏ hàng</a></li>
                                <li><a href="{{URL::to('/lienhe')}}" class="{{(request()->is('lienhe')) ? 'active' : '' }}">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <form action="" method="get">
                            {{csrf_field()}}
                            <div class="search_box pull-right" style="width:250px">
                                <input type="text" placeholder="Tìm kiếm" name="keyword_sub" value="{{  $_GET['keyword_sub'] ?? ''  }}"/>
                                <button type="submit" class="btn btn-primary btn-sm" style="margin-top:0px">
                                    <i class="fa-solid fa-magnifying-glass"></i> </button>
                            </div>
                     </form>
                     
                     
                    </div>
                </div>
            </div>
        </div>
        <!--/header-bottom-->
    </header>
    <!--/header-->


    <!--/slider-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Danh mục sản phẩm</h2>
                        <div class="panel-group category-products" id="accordian">
                            <!--category-productsr-->
                            @foreach ($category as $key => $cate)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="{{route('category',['category_id'=> $cate->category_id])}}"
                                    class="{{(request()->is('danh-muc-san-pham/'.$cate->category_id)) ? 'active' : '' }}"
                                    >{{$cate->category_name}}</a></h4>
                                </div>
                            </div>
                           
                            @endforeach
                        <div class="brands_products">
                            <!--brands_products-->
                            <h2 style="margin-top: 30px">Thương hiệu sản phẩm</h2>
                            <div class="brands-name">
                                @foreach ($brand as $key => $brand)
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="{{route('brand',['brand_id'=> $brand->brand_id])}}"
                                    class="{{(request()->is('thuonghieu/'.$brand->brand_id)) ? 'active' : '' }}"
                                    > <span class="pull-right"></span>{{$brand->brand_name}}</a></li>
                                    
                                </ul>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
                <div class="col-sm-9 padding-right">
                    
                    <!-- yield cọi lại nội dung của file home.blade.php -->
                    @yield('content')       

                </div>
            
        </div>
    </section>

    

    <footer id="footer">
        <!--Footer-->
       

        <div class="footer-widget">
            <div class="">
                <div class="row" style="margin-right:0px;">
                    <div class="col-sm-4" style="margin-left: 20px;">
                        <div class="single-widget">
                            <h2>Thông tin về chúng tôi</h2>
                            <p  style="margin-left: 20px;"> Website thương mại điện tử giúp người dùng mua sắm trực tuyến và có nhiều lựa chọn</p>
                        </div>
                    </div>
                   
                   
                    <div class="col-sm-3">
                        <div class="single-widget">
                            <h2>Danh mục sản phẩm</h2>
                            <ul class="nav nav-pills nav-stacked">
                            @foreach ($category as $key => $cate)
                                <li><a href="{{route('category',['category_id'=>$cate->category_id])}}">{{$cate->category_name}}</a></li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>Theo dõi chúng tôi trên</h2>
                            <a href="https://www.facebook.com/profile.php?id=100061796479733" style="font-size:20px"><i class="fa-brands fa-facebook"></i> </a>
                            <a href="#" style="font-size:22px; color:orange;"><i class="fa-brands fa-instagram"></i> </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

       

    </footer>
    <!--/Footer-->



    <script src="{{asset('frontend/js/jquery.js')}}"></script>
    <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('frontend/js/price-range.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('frontend/js/main.js')}}"></script>
</body>

</html>