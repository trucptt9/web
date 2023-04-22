@extends('layout')
@section('content')
<section  id="form" style="margin-top:0px;"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
				@include('common.alert')
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập</h2>
						<form action="{{URL::to('/login-customer')}}" method="post">
							{{csrf_field()}}
							<input type="email" placeholder="Nhập email" name="email" value="{{old('email')}}" />
							@error('email')
							<span class="text-danger" style="color: red">{{ $message }} </span>
							@enderror
							<input type="password" placeholder="Nhập password" name="password" value="{{old('password')}}"/>
							@error('password')
							<span class="text-danger" style="color: red">{{ $message }} </span>
							@enderror
							<!-- <span>
								<input type="checkbox" class="checkbox"> 
								Nhớ lần đăng nhập tiếp theo
							</span> -->
							<button type="submit" class="btn btn-default">Đăng nhập</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">Hoặc</h2>
				</div>
				<div class="col-sm-5">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng ký tài khoản</h2>
						<form action="{{route('user.add_account')}}" method="post">
                                {{csrf_field()}}	
							<input type="text" placeholder="Họ tên" name="customer_name" 
							value="{{old('customer_name')}}" 
							/>
							@error('customer_name')
							<span class="text-danger" style="color: red">{{ $message }} </span>
							@enderror
																
							
					
							<input type="email" placeholder="Nhập emai" name="customer_email" value="{{old('customer_email')}}"/>
							
							@error('customer_email')
								<span class="text-danger" style="color: red">{{ $message }} </span>
							@enderror
                            <input type="text" placeholder="Nhập số điện thoại" name="customer_phone" value="{{old('customer_phone')}}"/>
							@error('customer_phone')
							<span class="text-danger" style="color: red">{{ $message }} </span>
							@enderror
							<input type="password" placeholder="Mật khẩu" name="customer_password" 
							 value="{{old('customer_password')}}"/>
                            @error('customer_password')
							<span class="text-danger" style="color: red">{{ $message }} </span>
							@enderror

                            <input type="password" placeholder="Nhập lại mật khẩu" name="customer_password_confirmation" value="{{old('customer_password')}}"/>
							
							<button type="submit" value="Đăng ký" name="login">Đăng ký </button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section>

@endsection