@extends('admin_layout')
@section('admin_content')
<style>
	.market-update-gd .fa {
		
		font-size: 3em;
		color: #fff;
		text-align: left;
	}
</style>
			<div class="col-md-6 market-update-gd">
				<div class="market-update-block clr-block-4">
					<div class="col-md-3 market-update-right">
                    <i class="fa fa-users" ></i>
					</div>
					 <div class="col-md-9 market-update-left">
					 <h4>Tổng số khách hàng</h4>
					<h3>{{$number_customer}}</h3>
					<p>Số người có đăng ký tài khoản</p>
				  </div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-6 market-update-gd" >
				<div class="market-update-block clr-block-1">
					<div class="col-md-3 market-update-right">
						<i class="fa fa-cube fa-2xl"></i>
					</div>
					<div class="col-md-9 market-update-left">
					<a href="{{ route('admin.all_product') }}"><h4>Tổng sản phẩm </h4>
						<h3>{{$number_product}}</h3>
						<p>Số sản phẩm hiện đang bán của trang web</p> </a> 
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-6 market-update-gd" style="margin-top:30px">
				<div class="market-update-block clr-block-3">
					<div class="col-md-3 market-update-right" >
						<i class="fa fa-file-text-o" aria-hidden="true"></i>
					</div>
					<div class="col-md-9 market-update-left">
					<a href="{{ route('admin.manage_order') }}"> 
						<h4>Tổng đơn hàng</h4>
						<h3>{{$number_order}}</h3>
						<p>Số đơn hàng hiện có</p>
					</a>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-6 market-update-gd " style="margin-top:30px">
				<div class="market-update-block clr-block-2">
					<div class="col-md-3 market-update-right">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</div>
					<div class="col-md-9 market-update-left">
						<a href="{{ route('admin.out_of_stock') }}">
						<h4>Sản phấm sắp hết hàng</h4>
						<h3>{{$number_hethang}}</h3>
						<p>Số lượng sản phẩm sắp hết hàng</p>
						</a>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
@endsection