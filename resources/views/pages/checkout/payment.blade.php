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
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
                  
                </div>
            </div>


            <?php
			}else{
			?>
            <p>Vui lòng nhập thông tin giao hàng <span><a href="#">Nhập thông tin</a></span></p>
            </p>
            <?php
			}
			?>




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
                    <input type="submit" value="Đặt hàng" class="btn btn-success btn-sm" style="font-size:18px">
                </div>

            </form>
        </div>
    </div>
</section>
@endsection