@extends('layout')
@section('content')
	<section >
		<div class="table-agile-info">
			<div class="breadcrumbs">
				<h2 class="title">Quản lý tài khoản</h2>
			</div>
			
			<div class="table-responsive" style="display:grid;grid-template-columns: auto auto;">
				
				<table class="">
					<tr>
						<td colspan='2'><h2 class="title text-center">Thông tin người dùng</h2></td>
					</tr>
                    @foreach($profile as $profile)
						    
                            <tr>
							    <td class="text-left">Tên người dùng</td>
                                <td class="text-left">
                                    <p>{{$profile->customer_name}}</p> 
							    </td>
                                
                            </tr>
                            <tr>
							    <td class="text-left">Email</td>
                                <td class="text-left">
                                <p>{{$profile->customer_email}}</p> 
							    </td>
                                
                            </tr>
                            <tr>
							    <td class="text-left">Số điện thoại</td>
                                <td class="text-left">
                                <p>{{$profile->customer_phone}}</p> 
							    </td>
                    
                            </tr>
							<?php
                                    $customer_id = Session::get('customer_id');
                                    if($customer_id != null){

                                ?>
                            <tr >
							<form action="{{URL::to('/edit-password/'.$customer_id)}}">
                                	<td  class="text-center"   style="margin-top:20px;text-aign:center"><button type="submit" class="btn btn-fefault cart mt-4">
                                    	<i class="fa fa-light fa-pen-to-square"></i> Đổi mật khẩu</button>  </td>
								</form>
                                <form action="{{URL::to('/edit-profile/'.$customer_id)}}">
                                	<td  class="text-center"   style="margin-top:20px;text-aign:center"><button type="submit" class="btn btn-fefault cart mt-4">
                                    	<i class="fa fa-light fa-pen-to-square"></i> Chỉnh sửa thông tin</button>  </td>
								</form>
							<?php
									}
									?>	
                       
                        
                    </tr>
						@endforeach
					
				</table>
                <?php
					if($profile_shipping->count()==0){
				?>
				<table class="">

                    <tr>
						<td colspan='2'><h2 class="title text-left">Thông tin nhận hàng</h2></td>
					</tr>
						    
                            <tr>
							    <td class="text-left">Tên người nhận hàng</td>
                                <td class="text-center">
                                    <p></p> 
							    </td>
                                
                            </tr>
                            <tr>
							    <td class="text-left">Số điện thoại nhận hàng</td>
                                <td class="text-left">
                                <p></p> 
							    </td>
                                
                            </tr>
                            <tr>
							    <td class="text-left">Địa chỉ nhận hàng</td>
                                <td class="text-center">
                                <p></p> 
							    </td>
                    
                            </tr>
							<tr>
							    <td class="text-left">Ghi chú</td>
                                <td class="text-left">
                                <p></p> 
							    </td>
                    
                            </tr>
                            <tr >
                                
								<form action="{{URL::to('/edit-shipping/'.$customer_id)}}">
                                	<td colspan='2'  class="text-center"   style="margin-top:20px;text-aign:center"><button type="submit" class="btn btn-fefault cart mt-4">
									<i class="fa fa-solid fa-plus"></i> Thêm thông tin nhận hàng</button>
									</td>
								</form>
                        
                    		</tr>
							
						
				</table>
				<?php
					}
					else{
				?>
				
				
				<table class="">

                    <tr>
						<td colspan='2'><h2 class="title text-left">Thông tin nhận hàng</h2></td>
					</tr>
						    @foreach($profile_shipping as $shipping)
                            <tr>
							    <td class="text-left">Tên người nhận hàng</td>
                                <td class="text-left">
                                    <p>{{$shipping->shipping_name}}</p> 
							    </td>
                                
                            </tr>
                            <tr>
							    <td class="text-left">Số điện thoại nhận hàng</td>
                                <td class="text-left">
                                <p>{{$shipping->shipping_phone}}</p> 
							    </td>
                                
                            </tr>
                            <tr>
							    <td class="text-left">Địa chỉ nhận hàng</td>
                                <td class="text-left">
                                <p>{{$shipping->shipping_address}}</p> 
							    </td>
                    
                            </tr>
							<tr>
							    <td class="text-left">Ghi chú</td>
                                <td class="text-left">
                                <p>{{$shipping->shipping_note}}</p> 
							    </td>
                    
                            </tr>
                            <tr >
                                
							<form action="{{URL::to('/edit-shipping/'.$customer_id)}}">
                                	<td colspan='2'  class="text-center"   style="margin-top:20px;text-aign:center"><button type="submit" class="btn btn-fefault cart mt-4">
                                    	<i class="fa fa-light fa-pen-to-square"></i> Chỉnh sửa</button>
									</td>
								</form>
                    		</tr>
						@endforeach
				</table>

				<?php	
					}
				?>
			</div>
			
			
		</div>
	</section> 

	

@endsection