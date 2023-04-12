@extends('layout')
@section('content')


    
<section id="cart_items">
    <div class="">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}">Trang chủ</a></li>
                <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div> 
        <!--/breadcrums-->

       

        
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
                                <input type="hidden" value="{{$customer_id}}" name="customer_id">
                                 <textarea name="note" placeholder="Ghi chú"
                                    rows="2" style="height:150px"></textarea>
                               <input type="submit" value="Gửi" class="btn btn-primary btn-sm" style="width:30%">
                            </form>
                        </div>
                      
                    </div>
                </div>
                
            </div>
        </div>
       
      
    </div>
</section>
@endsection