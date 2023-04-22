@extends('layout')
@section('content')
	<section id="cart_items">
		<div class="">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{ route('home') }}">Trang chủ</a></li>
				  <li class="active">Giỏ hàng</li>
				</ol>
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
								<a href=""><img src="{{asset('upload/product/'.$v_content->options->image)}}" alt="" height="100" width="100"></a>
							</td>
							<td class="cart_description" style="width:300px;">
								<h5><a href="">{{$v_content->name}}</a></h5>
								
							</td>
							<td class="cart_price">
								<p>{{number_format($v_content->price).' vnđ'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									
									<p class="cart_quantity_input" name="quantity" style="margin-left: 20px;"
									 autocomplete="off" size="2">{{$v_content->qty}}</p>
									
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
								<a class="cart_quantity_delete" href="{{URL::to('/delete-cart/'.$v_content->rowId)}}" style="color:red;"><i class="fa fa-times"></i></a>

							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="">
			
			<div class="row">
				
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng <span>{{Cart::subtotal(0).' vnđ'}}</span></li>
							
							<li>Phí vận chuyển <span>0đ</span></li>
							<li>Thành tiền <span>{{Cart::subtotal(0).' vnđ'}}</span></li>
						</ul>
						<?php
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id != null){

                                ?>
                                
                                    <a href="{{URL::to('/payment/'.$customer_id)}}"> <button class="btn btn-primary">Thanh toán</button></a>
                                <?php
                                }else{
                                ?>
								  <a href="{{route('login_checkout')}}"> <button class="btn btn-primary">Thanh toán</button></a>
                                 
                                <?php
                                } 
                                ?>
							
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

@endsection