@extends('admin_layout')
@section('admin_content')
            <div class="col-lg-12">
           
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm khuyến mãi
                        </header>
                       
                            <div class="panel-body">
                            @include('common.alert')
                            <div class="position-center">
                                <form role="form" method="post" action="{{route('admin.save_coupon')}}">
                                    {{csrf_field()}}
                                   
                                    <div class="form-group">
                                        <span class="text-danger">* </span>
                                        <label for="">Tên khuyến mãi</label>
                                        <input type="text" name="coupon_name" class="form-control" placeholder="Nhập tên khuyến mãi" value="{{ old('coupon_name')}}">
                                                @error('coupon_name')
                                                    <span class="text-danger" style="color: red">{{ $message }} </span>
                                                 @enderror
                                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="">Mô tả</label>
                                        <textarea type="text" style="resize:none;" rows="6" name="coupon_desc" class="form-control" placeholder="Mô tả"></textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <span class="text-danger">* </span>
                                        <label for="">Giá trị khuyến mãi (%)</label>
                                        <input type="number" name="coupon_value" class="form-control" style="width:40%"
                                        placeholder="Nhập giá trị khuyến mãi" value="{{ old('coupon_value')}}">
                                                @error('coupon_value')
                                                    <span class="text-danger" style="color: red">{{ $message }} </span>
                                                 @enderror
                                                        
                                    </div>
                                    <div class="form-group">
                                        <span class="text-danger">* </span>
                                        <label for="">Ngày bắt đầu áp dụnng khuyến mãi</label>
                                        
                                        <input type="date" name="coupon_start" class="form-control" value="{{ old('coupon_start')}}" style="width:40%"> 
                                                @error('coupon_start')
                                                    <span class="text-danger" style="color: red">{{ $message }} </span>
                                                 @enderror
                                                        
                                    </div>
                                    <div class="form-group">
                                        <span class="text-danger">* </span>
                                        <label for="">Ngày kết thúc khuyến mãi</label>
                                        <input type="date" name="coupon_end" class="form-control" placeholder="DD-MM-YYYY" style="width:40%"
                                        required pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}"
                                        value="{{ old('coupon_end')}}">
                                                @error('coupon_end')
                                                    <span class="text-danger" style="color: red">{{ $message }} </span>
                                                 @enderror
                                                        
                                    </div>
                                     <button type="submit" class="btn btn-info" name="save_coupon">Thêm</button>
                                     <a  class="btn btn-warning" name="quay lai" type="button" href="{{route('admin.all_coupon')}}">Hủy</a>
                                </form>
                              
                               
                                </div>
                            </div>

                        </div>
                    </section>
                   
                    
                    
                           
            </div>
          

@endsection