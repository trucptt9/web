<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Web bán phụ kiện</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{('public/frontend/images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">

    

      
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
                            <a href="{{URL::to('/trangchu')}}"><img src="public/frontend/images/logo.png" alt="" width="80"
                                    height="80" /></a>
                        </div>
                      
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                            <?php
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id != null){

                                ?>
                                
                                <li><a href="{{URL::to('/account/'.$customer_id)}}"><i class="fa fa-user"></i> Tài khoản</a></li>
                                <?php
                                }else{
                                ?>
                                 <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-user"></i> Tài khoản</a></li>
                                <?php
                                } 
                                ?>
                               
                                <!-- <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li> -->

                               
                                <?php
                                    $customer_id = Session::get('customer_id');
                                    $shipping_id = Session::get('shipping_id');
                                    if($customer_id != null && $shipping_id == null){

                                ?>
                                
                                    <li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php
                                }elseif($customer_id != null && $shipping_id != null){
                                ?>
                                 <li><a href="{{URL::to('/payment/'.$customer_id)}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php
                                }else{
                                ?>
                                    <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php
                                }
                                ?>

                                <li><a href="{{URL::to('/show-cart')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                                <?php
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id != null){

                                ?>
                                
                                    <li><a href="{{URL::to('/logout-checkout')}}"><i class="fa-solid fa-arrow-right-from-bracket"></i> Đăng xuất</a></li>
                                <?php
                                }else{
                                ?>
                                <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
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
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('/trangchu')}}" class="active">Trang chủ</a></li>
                                <li class="dropdown"><a href="{{URL::to('/tat-ca-sp')}}">Sản phẩm</a>
                                    
                                </li>
                              
                                <li><a href="{{URL::to('/show-cart')}}">Giỏ hàng</a></li>
                                <li><a href="contact-us.html">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <form action="{{URL::to('/timkiem')}}" method="post">
                            {{csrf_field()}}
                            <div class="search_box pull-right" style="width:250px">
                                <input type="text" placeholder="Tìm kiếm" name="keyword_sub"/>
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
                                    <h4 class="panel-title"><a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a></h4>
                                </div>
                            </div>
                           
                            @endforeach
                        <div class="brands_products">
                            <!--brands_products-->
                            <h2 style="margin-top: 30px">Thương hiệu sản phẩm</h2>
                            <div class="brands-name">
                                @foreach ($brand as $key => $brand)
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand->brand_id)}}"> <span class="pull-right"></span>{{$brand->brand_name}}</a></li>
                                    
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
                                <li><a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a></li>
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



    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
</body>

</html>