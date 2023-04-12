@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    @include('common.alert')
    <a href="{{route('admin.add_coupon')}}" class="btn btn-success" type="button" style="margin-bottom:10px">Thêm khuyến mãi</a>
    
    <div class="panel-heading">
      Liệt kê khuyến mãi
    </div>
    
    <div class="row w3-res-tb">
     
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
      
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>ID</th>
            <th>Tên Khuyến mãi</th>
            <th>Giá trị</th>
          
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
          
            
            <th style="width:123px;">Thao tác</th>
          </tr>
        </thead>
        <tbody>
        @foreach($all_coupon as $key => $cp)
          <tr>
           
            <td>{{$cp->coupon_id}}</td>
            <td>{{$cp->coupon_name}}</td>
            <td>{{($cp->coupon_value)*100}}%</td>
            <td>{{date('d/m/Y', strtotime ($cp->coupon_start))}}</td>
            <td>{{date('d/m/Y', strtotime ($cp->coupon_end))}}</td>
           </td>
            
            <td>
              <a href="{{route('admin.edit_coupon',[ 'coupon_id'=>$cp->coupon_id])}}"
                 class="active btn btn-sm btn-success" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-active" style="font-size: 18px;"></i>
              </a>
              <a href="{{route('admin.delete_coupon',[ 'coupon_id'=>$cp->coupon_id])}}"
              onclick="return confirm('Bạn có chắc muốn xóa khuyến mãi này không?')"
              class="active btn btn-sm btn-danger" ui-toggle-class="">
                <i class="fa fa-times text" style="font-size: 18px;"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
            {{ $all_coupon->links() }}
        </div>
      </div>
    </footer>
  </div>
  
</div>



@endsection