@extends('layout')
@section('content')
<section  id="form" style="margin-top:0px;"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập</h2>
						<form action="{{URL::to('/login-customer')}}" method="post">
							{{csrf_field()}}
							<input type="email" placeholder="Nhập email" name="email_account" />
							<input type="password" placeholder="Nhập password" name="password_account"/>
							<span>
								<input type="checkbox" class="checkbox"> 
								Nhớ lần đăng nhập tiếp theo
							</span>
							<button type="submit" class="btn btn-default">Đăng nhập</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">Hoặc</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng ký tài khoản</h2>
						<form action="{{URL::to('/add')}}" method="post">
                                {{csrf_field()}}	
							<input type="text" placeholder="Họ tên" name="name"/>
							<input type="email" placeholder="Nhập emai" name="email"/>
                            <input type="text" placeholder="Nhập số điện thoại" name="phone"/>
							<input type="password" placeholder="Mật khẩu" name="password"/>
                            
                            <input type="password" placeholder="Nhập lại mật khẩu" name="password_confirm"/>
							<button type="submit" value="Đăng ký" name="login">Đăng ký </button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section>

@endsection