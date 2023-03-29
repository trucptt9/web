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

        <div class="review-payment">
            <h2>Thông tin nhận hàng</h2>
            <?php
				if($infor_shipping != null){
			?>
            <div class="row">
                <div class="col-sm-10">
                    {{$infor_shipping->shipping_name}} ( {{$infor_shipping->shipping_phone}} )
                    {{$infor_shipping->shipping_address}}
                </div>
                <div class="col-sm-2">


                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success btn-sm open_modal" data-toggle="modal"
                        data-target="#myModal">
                        Thay đổi
                    </button>

                    <!-- Modal -->
                    <form action="{{URL::to('/update-address/'.$infor_shipping->customer_id)}}" method="post">
                        {{csrf_field()}}
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <a type="" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></a>
                                        <h2 class="modal-title" id="myModalLabel">Thông tin nhận hàng</h2>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-one" style="width:100%">



                                            <input type="text" placeholder="Họ tên người nhận" name="name"
                                                class="form-control">

                                            <input type="text" placeholder="Số điện thoại" name="phone"
                                                class="form-control" style="margin-top:10px">

                                            <input type="text" placeholder="Địa chỉ" name="address" class="form-control"
                                                style="margin-top:10px">
                                            <input type="hidden" value="" name="customer_id">
                                            <textarea name="note" placeholder="Ghi chú" style="margin-top:10px"
                                                class="form-control" rows="4"></textarea>



                                        </div>
                                    </div>
                                    <div class="modal-footer ">


                                        <input type="submit" class="btn btn-success" 
                                            style="margin-top:10px" value="Lưu">
                                        <button type="button" class="btn btn-info" data-dismiss="modal"
                                            style="margin-top:10px">Đóng</button>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </form>
                </div>

            </div>


            <?php
			}else{
			?>
            <div class="row">
                <div class="col-sm-4">
                    Vui lòng nhập thông tin giao hàng!
                </div>
                <div class="col-sm">


                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success btn-sm open_modal" data-toggle="modal"
                        data-target="#myModal">
                        Nhập thông tin
                    </button>

                    <!-- Modal -->

                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <form action="{{URL::to('/save-checkout-customer')}}" method="post">
                                {{csrf_field()}}
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <a type="submit" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></a>
                                        <h2 class="modal-title" id="myModalLabel">Thông tin nhận hàng</h2>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-one" style="width:100%">



                                            <input type="text" placeholder="Họ tên người nhận" name="name"
                                                class="form-control">

                                            <input type="text" placeholder="Số điện thoại" name="phone"
                                                class="form-control" style="margin-top:10px">

                                            <input type="text" placeholder="Địa chỉ" name="address" class="form-control"
                                                style="margin-top:10px">
                                            <input type="hidden" value="{{$customer_id}}" name="customer_id">
                                            <textarea name="note" placeholder="Ghi chú" style="margin-top:10px"
                                                class="form-control" rows="4"
                                                style="height:200px!important ;"></textarea>



                                        </div>
                                    </div>
                                    <div class="modal-footer ">


                                        <button type="submit" class="btn btn-success" 
                                            style="margin-top:10px">Lưu</button>
                                        <button type="button" class="btn btn-info" data-dismiss="modal"
                                            style="margin-top:10px">Đóng</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>

            </div>

            <?php
			}
			?>


        </div>

        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
        </div>
        <div class="table-responsive cart_info">
            <?php
					$content= Cart::content();
				?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="description">Sản phẩm</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($content as $v_content)

                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{URL::to('public/upload/product/'.$v_content->options->image)}}"
                                    alt="" height="100" width="100"></a>
                        </td>
                        <td class="cart_description" style="width:300px;">
                            <h5><a href="">{{$v_content->name}}</a></h5>
                            <p>ID Sản phẩm: {{$v_content->id}}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($v_content->price).' vnđ'}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">

                                <input class="cart_quantity_input" type="text" name="quantity"
                                    value="{{$v_content->qty}}" autocomplete="off" size="2">

                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price" style="font-size:20px;">
                                <?php
										$subtotal = $v_content->price*$v_content->qty;
										echo number_format($subtotal).'vnđ';
									?>
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{URL::to('/delete-cart/'.$v_content->rowId)}}"
                                style="color:red;"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="payment-options">
            <div class="review-payment">
                <h2>Phương thức thanh toán</h2>
            </div>
            <form action="{{URL::to('/phuongthucthanhtoan')}}" method="post">
                {{csrf_field()}}
                <span>
                    <label><input type="radio" name="payment_op" value="0"> Thanh toán khi nhận hàng</label>
                </span>

                <span>
                    <label><input type="radio" name="payment_op" value="1"> Thanh toán trực tuyến</label>
                </span>
                <div>

                <?php
				if($infor_shipping != null){
			    ?>
                    <input type="submit" value="Đặt hàng" class="btn btn-success btn-sm" style="font-size:18px">
                <?php
                }else{
                ?>
                <input type="submit" value="Đặt hàng" class="btn btn-success btn-sm" style="font-size:18px">
                <section class='alert alert-danger' style="margin-top:20px">{{session('alert')}}</section>
                <?php
                }
                ?>
                </div>

            </form>
        </div>
    </div>
</section>


@endsection