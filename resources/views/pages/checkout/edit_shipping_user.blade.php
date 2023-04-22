@extends('layout')
@section('content')
	<section id="cart_items">
		<div class="table-agile-info">
			<div class="breadcrumbs">
				<h2 class="title">Quản lý tài khoản</h2>
			</div>
			<div class="table-responsive " style="display:grid;grid-template-columns: auto auto;">
				@include('common.alert')
				<?php
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id != null){

                                ?>
                                
                <li><a href="{{URL::to('/account/'.$customer_id)}}"><i class="fa fa-solid fa-rotate-left"></i> Quay lại</a></li> 
                                
				<form action="{{URL::to('/update-shipping-user/'.$customer_id)}}" >
					{{csrf_field()}}
				<table class="">
					<tr>
						<td colspan='2'><h2 class="title text-center">Nhập thông tin nhận hàng mới</h2></td>
					</tr>
					
						    
                            <tr>
							    <td class="text-left">Tên người nhận hàng</td>
                                <td class="text-left">
								<input type="text" placeholder="Nhập họ tên mới" name="shipping_name" value="{{old('shipping_name')}}" />
								@error('shipping_name')
								<span class="text-danger" style="color: red">{{ $message }} </span>
								@enderror
							    </td>
                                
                            </tr>
                            
                            <tr>
							    <td class="text-left">Số điện thoại nhận hàng</td>
                                <td class="text-left">
                                <input type="text" placeholder="Nhập số điện thoại mới" name="shipping_phone" value="{{old('shipping_phone')}}"/>
								@error('shipping_phone')
								<span class="text-danger" style="color: red">{{ $message }} </span>
								@enderror
							    </td>
                    
                            </tr>
                            <tr>
							    <td class="text-left">Địa chỉ nhận hàng</td>
                                <td class="text-left">
                                <input type="text" placeholder="Nhập địa chỉ nhận hàng mới" name="shipping_address" value="{{old('shipping_address')}}"/>
								@error('shipping_address')
								<span class="text-danger" style="color: red">{{ $message }} </span>
								@enderror
							    </td>
                    
                            </tr>
                            <tr>
							    <td class="text-left">Ghi chú</td>
                                <td class="text-left">
                                <input type="text" placeholder="Nhập ghi chú mới" name="shipping_note" value="{{old('shipping_note')}}"/>
								@error('shipping_note')
								<span class="text-danger" style="color: red">{{ $message }} </span>
								@enderror
							    </td>
                    
                            </tr>
                            <tr >
								
                                
                                <td  colspan='2' class="text-center"   style="margin-top:20px;text-aign:center"><button type="submit" class="btn btn-fefault cart mt-4" name="btn_submit">
                                    Hoàn tất</button>
								</td>
                        
                    		</tr>
					
					
				</table>
				</form>
				<?php
                                } ?>
                
						
				
				
			</div>
			
		</div>
	</section> 

	

@endsection