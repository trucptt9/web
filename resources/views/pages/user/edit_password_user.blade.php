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
                                
				<form action="{{URL::to('/update-password-user/'.$customer_id)}}" >
					{{csrf_field()}}
				<table class="">
					<tr>
						<td colspan='2'><h2 class="title text-center">Nhập thông tin mới</h2></td>
					</tr>
					
						    
                            <tr>
							    <td class="text-left">Mật khẩu cũ</td>
                                <td class="text-left">
								<input type="password" placeholder="Nhập mật khẩu cũ" name="old_password" value="{{old('old_password')}}" />
								@error('customer_name')
								<span class="text-danger" style="color: red">{{ $message }} </span>
								@enderror
							    </td>
                                
                            </tr>
                            
                            <tr>
							    <td class="text-left">Mật khẩu mới</td>
                                <td class="text-left">
                                <input type="password" placeholder="Nhập mật khẩu mới" name="new_password" value="{{old('new_password')}}"/>
								@error('customer_name')
								<span class="text-danger" style="color: red">{{ $message }} </span>
								@enderror
							    </td>
                    
                            </tr>
							<tr>
							    <td class="text-left">Xác nhận lại mật khẩu</td>
                                <td class="text-left">
								<input type="password" placeholder="Nhập lại mật khẩu mới" name="new_password_2" value="{{old('new_password_2')}}" />
								@error('customer_name')
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