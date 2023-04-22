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
                                
				<form action="{{URL::to('/update-profile-user/'.$customer_id)}}" >
					{{csrf_field()}}
				<table class="">
					<tr>
						<td colspan='2'><h2 class="title text-center">Nhập thông tin mới</h2></td>
					</tr>
					
						    
                            <tr>
							    <td class="text-left">Tên người dùng</td>
                                <td class="text-left">
								<input type="text" placeholder="Nhập họ tên mới" name="customer_name" value="{{old('customer_name')}}" />
								@error('customer_name')
								<span class="text-danger" style="color: red">{{ $message }} </span>
								@enderror
							    </td>
                                
                            </tr>
                            
                            <tr>
							    <td class="text-left">Số điện thoại</td>
                                <td class="text-left">
                                <input type="text" placeholder="Nhập số điện thoại mới" name="customer_phone" value="{{old('customer_phone')}}"/>
								@error('customer_phone')
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