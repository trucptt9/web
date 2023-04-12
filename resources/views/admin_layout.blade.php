<!DOCTYPE html>

<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smar tphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{asset('backend/css/style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('backend/css/style-responsive.css')}}" rel="stylesheet" />
    <!-- font CSS -->
    <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{asset('backend/css/font.css')}}" type="text/css" />
    <link href="{{asset('backend/css/font-awesome.css')}}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{asset('backend/css/morris.css')}}" type="text/css" /> --}}
    <!-- calendar -->
    <link rel="stylesheet" href="{{asset('backend/css/monthly.css')}}">
    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="{{asset('backend/js/jquery2.0.3.min.js')}}"></script>
    <script src="{{asset('backend/js/raphael-min.js')}}"></script>
    {{-- <script src="{{asset('backend/js/morris.js')}}"></script> --}}
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
    
</head>

<body>
@include('sweetalert::alert')

    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="{{route('admin.index')}}" class="logo">
                    ADMIN
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->

            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <form action="" method="get">
                            <input type="text" name="search" value="{{  $_GET['search'] ?? ''  }}" class="form-control search" placeholder=" Search">
                        </form>
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="{{asset('backend/images/3.png')}}">
                            <span class="username">
                                <!-- Hiện thị tên của người dùng đăng nhập về
                                    được lấy từ hàm dashboard của AdminController
                                -->
                                
                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="#"><i class=" fa fa-suitcase"></i>Thông tin</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Cài đặt</a></li>
                            <li><a href="{{ route('admin.logout') }}"><i class="fa fa-key"></i> Đăng xuất</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a  href="{{ route('admin.index') }}" class="{{ Route::currentRouteName() == 'admin.index' ? 'active' : '' }}">
                                <i class="fa fa-dashboard"></i>
                                <span>Tổng quan</span>
                            </a>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;" class="{{ in_array(Route::currentRouteName(), ['admin.new_category', 'admin.all_category']) ? 'active' : '' }}">
                                <i class="fa fa-book"></i>
                                <span>Danh mục sản phẩm</span>
                            </a>
                            <ul class="sub" style="{{ in_array(Route::currentRouteName(), ['admin.new_category', 'admin.all_category']) ? 'display: block;' : 'display: none;' }}">
                                <li class="{{ Route::currentRouteName() == 'admin.new_category' ? 'active' : '' }}"><a href="{{ route('admin.new_category') }}">Thêm danh mục</a></li>
                                <li class="{{ Route::currentRouteName()=='admin.all_category' ? 'active' : '' }}">
                                    <a href="{{ route('admin.all_category') }}">Liệt kê danh mục</a>
                                </li>
                                
                            </ul>
                        </li>
                        <!-- thương hiệu -->
                        <li class="sub-menu">
                            <a href="javascript:;" class="{{ in_array(Route::currentRouteName(), ['admin.all_brand', 'admin.add_brand']) ? 'active' : '' }}">
                                <i class="fa-brands fa-bandcamp"></i>
                                <span>Thương hiệu sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li class="{{ Route::currentRouteName() == 'admin.add_brand' ? 'active': '' }}">
                                    <a href="{{ route('admin.add_brand' )}}">Thêm thương hiệu</a>
                                </li>
                                <li class="{{ Route::currentRouteName() == 'admin.all_brand' ? 'active' : ''}}">
                                    <a href="{{route('admin.all_brand')}}">Liệt kê thương hiệu</a>
                                </li>
                                
                            </ul>
                        </li>

                        <!-- sản phẩm -->
                        <li class="sub-menu">
                            <a href="javascript:;" class="{{ in_array(Route::currentRouteName(), ['admin.all_product', 'admin.add_product']) ? 'active' : '' }}">
                                <i class="fa-solid fa-box"></i>
                                <span>Sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li class="{{Route::currentRouteName() == 'admin.add_product' ? 'active':''}}">
                                    <a href="{{route('admin.add_product')}}">Thêm sản phẩm</a>
                                </li>
                                <li class="{{Route::currentRouteName() == 'admin.all_product' ? 'active':''}}">
                                    <a href="{{route('admin.all_product')}}">Liệt kê sản phẩm</a>
                                </li>
                                
                            </ul>
                        </li>
                        <!-- don hang -->
                        <li class="">
                            <a href="{{route('admin.manage_order')}}"class="{{ Route::currentRouteName() == 'admin.manage_order' ? 'active' : '' }}">
                              <i class="fa-solid fa-list-check"></i>
                                <span>Quản lý đơn hàng</span>
                            </a>
                           
                        </li>

                         <!-- thống kê -->
                         <li class="sub-menu">
                            <a href="javascript:;" class="{{ in_array(Route::currentRouteName(), 
                            ['admin.revenue_statistic', 'admin.user_statistic','admin.order_statistic']) ? 'active' : '' }}">
                                <i class="fa-solid fa-chart-column"></i>
                                <span>Thống kê</span>
                            </a>
                            <ul class="sub">
                                <li class="{{ Route::currentRouteName() == 'admin.revenue_statistic' ? 'active' : '' }}">
                                    <a href="{{route('admin.revenue_statistic')}}">Thống kê theo doanh thu</a>
                                </li>
                                <li class="{{ Route::currentRouteName() == 'admin.user_statistic' ? 'active' : '' }}">
                                    <a href="{{route('admin.user_statistic')}}">Thống kê theo khách hàng</a>
                                </li>
                                <li class="{{ Route::currentRouteName() == 'admin.order_statistic' ? 'active' : '' }}">
                                    <a href="{{route('admin.order_statistic')}}">Thống kê theo đơn hàng</a>
                                </li>
                                
                            </ul>
                        </li>
                        
                        <!-- khuyến mãi -->
                        <li class="sub-menu">
                            <a href="javascript:;" class="{{ in_array(Route::currentRouteName(), ['admin.all_coupon', 'admin.apply_coupon']) ? 'active' : '' }}">
                               <i class="fa-solid fa-tags"></i>
                                <span>Khuyến mãi</span>
                            </a>
                            <ul class="sub">
                                <li class="{{ Route::currentRouteName() == 'admin.apply_coupon' ? 'active' : '' }}">
                                    <a href="{{route('admin.apply_coupon')}}">Áp dụng khuyến mãi</a>
                                </li>
                                <li class="{{ Route::currentRouteName() == 'admin.all_coupon' ? 'active' : '' }}">
                                    <a href="{{route('admin.all_coupon')}}">Quản lý khuyến mãi</a>
                                </li>
                                
                            </ul>
                        </li>
                        
                       
                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper" style="color:black;">
				@yield('admin_content')
                
            </section>
            <!-- footer -->
           
            <!-- / footer -->
        </section>
        <!--main content end-->
    </section>
    <script src="{{asset('backend/js/bootstrap.js')}}"></script>
    <script src="{{asset('backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('backend/js/scripts.js')}}"></script>
    <script src="{{asset('backend/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('backend/js/jquery.nicescroll.js')}}"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="{{asset('backend/js/jquery.scrollTo.js')}}"></script>
    <!-- morris JavaScript -->
    <script>
    $(document).ready(function() {
        //BOX BUTTON SHOW AND CLOSE
        jQuery('.small-graph-box').hover(function() {
            jQuery(this).find('.box-button').fadeIn('fast');
        }, function() {
            jQuery(this).find('.box-button').fadeOut('fast');
        });
        jQuery('.small-graph-box .box-close').click(function() {
            jQuery(this).closest('.small-graph-box').fadeOut(200);
            return false;
        });

        //CHARTS
        function gd(year, day, month) {
            return new Date(year, month - 1, day).getTime();
        }

        // graphArea2 = Morris.Area({
        //     element: 'hero-area',
        //     padding: 10,
        //     behaveLikeLine: true,
        //     gridEnabled: false,
        //     gridLineColor: '#dddddd',
        //     axes: true,
        //     resize: true,
        //     smooth: true,
        //     pointSize: 0,
        //     lineWidth: 0,
        //     fillOpacity: 0.85,
        //     data: [{
        //             period: '2015 Q1',
        //             iphone: 2668,
        //             ipad: null,
        //             itouch: 2649
        //         },
        //         {
        //             period: '2015 Q2',
        //             iphone: 15780,
        //             ipad: 13799,
        //             itouch: 12051
        //         },
        //         {
        //             period: '2015 Q3',
        //             iphone: 12920,
        //             ipad: 10975,
        //             itouch: 9910
        //         },
        //         {
        //             period: '2015 Q4',
        //             iphone: 8770,
        //             ipad: 6600,
        //             itouch: 6695
        //         },
        //         {
        //             period: '2016 Q1',
        //             iphone: 10820,
        //             ipad: 10924,
        //             itouch: 12300
        //         },
        //         {
        //             period: '2016 Q2',
        //             iphone: 9680,
        //             ipad: 9010,
        //             itouch: 7891
        //         },
        //         {
        //             period: '2016 Q3',
        //             iphone: 4830,
        //             ipad: 3805,
        //             itouch: 1598
        //         },
        //         {
        //             period: '2016 Q4',
        //             iphone: 15083,
        //             ipad: 8977,
        //             itouch: 5185
        //         },
        //         {
        //             period: '2017 Q1',
        //             iphone: 10697,
        //             ipad: 4470,
        //             itouch: 2038
        //         },

        //     ],
        //     lineColors: ['#eb6f6f', '#926383', '#eb6f6f'],
        //     xkey: 'period',
        //     redraw: true,
        //     ykeys: ['iphone', 'ipad', 'itouch'],
        //     labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
        //     pointSize: 2,
        //     hideHover: 'auto',
        //     resize: true
        // });


    });
    </script>
    <!-- calendar -->
    <script type="text/javascript" src="{{asset('backend/js/monthly.js')}}"></script>
    <script type="text/javascript">
    $(window).load(function() {

        $('#mycalendar').monthly({
            mode: 'event',

        });

        $('#mycalendar2').monthly({
            mode: 'picker',
            target: '#mytarget',
            setWidth: '250px',
            startHidden: true,
            showTrigger: '#mytarget',
            stylePast: true,
            disablePast: true
        });

        switch (window.location.protocol) {
            case 'http:':
            case 'https:':
                // running on a server, should be good.
                break;
            case 'file:':
                alert('Just a heads-up, events will not work when run locally.');
        }

    });
    </script>
    <!-- //calendar -->

    
</body>

</html>