@extends('layout')
@section('content')

<section id="cart_items">
    <div class="">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/trangchu')}}">Trang chủ</a></li>
                <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div>
        <!--/breadcrums-->

       

        <div class="register-req">
            <h5>Đăng nhập để thanh toán giỏ hàng. Bạn chưa có tài khoản? <span> <a  href="{{URL::to('/login-checkout')}}">Đăng ký</a></span></h5>
        </div>
        <!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                
                <div class="col-sm-10 clearfix">
                    <div class="bill-to">
                        <p>Thông tin nhận hàng</p>
                        <div class="form-one" style="width:100%">
                            <form action="{{URL::to('/save-checkout-customer')}}" method="post">
                               {{csrf_field()}}
                                <input type="text" placeholder="Họ tên người nhận" name="name">
                               
                                <input type="text" placeholder="Số điện thoại" name="phone">

                                <input type="text" placeholder="Địa chỉ" name="address">
                                
                                 <textarea name="note" placeholder="Ghi chú"
                                    rows="2" style="height:150px"></textarea>
                               <input type="submit" value="Gửi" class="btn btn-primary btn-sm" style="width:30%">
                            </form>
                        </div>
                      
                    </div>
                </div>
                
            </div>
        </div>
        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
        </div>

      
        <div class="payment-options">
            <span>
                <label><input type="checkbox"> Direct Bank Transfer</label>
            </span>
            <span>
                <label><input type="checkbox"> Check Payment</label>
            </span>
            <span>
                <label><input type="checkbox"> Paypal</label>
            </span>
        </div>
    </div>
</section>
@endsection