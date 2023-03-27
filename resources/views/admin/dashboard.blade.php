@extends('admin_layout')
@section('admin_content')


			<div class="col-md-6 market-update-gd">
				<div class="market-update-block clr-block-4">
					<div class="col-md-4 market-update-right">
                    <i class="fa fa-users" ></i>
					</div>
					 <div class="col-md-8 market-update-left">
					 <h4>Tổng số khách hàng</h4>
					<h3>{{$number_customer}}</h3>
					<p>Số người có đăng ký tài khoản</p>
				  </div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-6 market-update-gd" >
				<div class="market-update-block clr-block-1">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-users" ></i>
					</div>
					<div class="col-md-8 market-update-left">
					<h4>Tổng sản phẩm </h4>
						<h3>{{$number_product}}</h3>
						<p>Số sản phẩm hiện đang bán của trang web</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-6 market-update-gd" style="margin-top:30px">
				<div class="market-update-block clr-block-3">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-usd"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Tổng đơn hàng</h4>
						<h3>{{$number_order}}</h3>
						<p>Số đơn hàng hiện có</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-6 market-update-gd " style="margin-top:30px">
				<div class="market-update-block clr-block-2">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Hết hàng</h4>
						<h3>{{$number_hethang}}</h3>
						<p>Số lượng sản phẩm đã hết hàng</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
@endsection