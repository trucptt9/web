@extends('admin_layout')
@section('admin_content')
            <div class="col-lg-12">
           
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật khuyến mãi
                        </header>
                       
                            <div class="panel-body">
                            @include('common.alert')
                            <div class="position-center">
                                @foreach($coupon as $key => $cp)
                                <form role="form" method="post" action="{{route('admin.update_coupon',[ 'coupon_id'=>$cp->coupon_id])}}">
                                    {{csrf_field()}}
                                   
                                    <div class="form-group">
                                        <span class="text-danger">* </span>
                                        <label for="">Tên khuyến mãi</label>
                                        <input type="text" name="coupon_name" class="form-control" placeholder="Nhập tên khuyến mãi" value="{{$cp->coupon_name}}">
                                                @error('coupon_name')
                                                    <span class="text-danger" style="color: red">{{ $message }} </span>
                                                 @enderror
                                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="">Mô tả</label>
                                        <textarea type="text" style="resize:none;" rows="6" name="coupon_desc" class="form-control" placeholder="Mô tả">{{$cp->coupon_desc}}</textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <span class="text-danger">* </span>
                                        <label for="">Giá trị khuyến mãi (%)</label>
                                        <input type="number" name="coupon_value" class="form-control" style="width:40%"
                                        value="{{ ($cp->coupon_value)*100}}">
                                                @error('coupon_value')
                                                    <span class="text-danger" style="color: red">{{ $message }} </span>
                                                 @enderror
                                                        
                                    </div>
                                    <div class="form-group">
                                        <span class="text-danger">* </span>
                                        <label for="">Ngày bắt đầu áp dụnng khuyến mãi</label>
                                        
                                        <input type="date" name="coupon_start" class="form-control" value="{{$cp->coupon_start}}" style="width:40%"> 
                                                @error('coupon_start')
                                                    <span class="text-danger" style="color: red">{{ $message }} </span>
                                                 @enderror
                                                        
                                    </div>
                                    <div class="form-group">
                                        <span class="text-danger">* </span>
                                        <label for="">Ngày kết thúc khuyến mãi</label>
                                        <input type="date" name="coupon_end" class="form-control" 
                                        style="width:40%"
                                        value="{{ $cp->coupon_end}}">
                                                @error('coupon_end')
                                                    <span class="text-danger" style="color: red">{{ $message }} </span>
                                                 @enderror
                                                        
                                    </div>
                                     <button type="submit" class="btn btn-info" name="save_brand_product">Lưu</button>
                                     <a  class="btn btn-warning" name="quay lai" type="button" href="{{route('admin.all_coupon')}}">Hủy</a>
                                </form>
                              
                               @endforeach
                                </div>
                            </div>

                        </div>
                    </section>
                   
                    
                    
                           
            </div>
          

@endsection