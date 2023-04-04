@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    @include('common.alert')
    <a href="{{URL::to('/add-coupon')}}" class="btn btn-success" type="button">Thêm khuyến mãi</a>
    
    <div class="panel-heading">
      Liệt kê khuyến mãi
    </div>
    
    <div class="row w3-res-tb">
      <!-- <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div> -->
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
          
            
            <th style="width:30px;"></th>
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
              <a href="{{URL::to('edit-coupon/'.$cp->coupon_id)}}" class="active" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active" style="font-size: 18px;"></i>
              </a>
              <a href="{{URL::to('delete-coupon/'.$cp->coupon_id)}}"
              onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')"
              class="active" ui-toggle-class="">
                <i class="fa fa-times text-danger text" style="font-size: 18px;"></i>
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
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
  <!-- @if(Session::has('message'))
                            <script>
                                swal("Thông báo","{{Session::get('message')}}",'success',{
                                    button:true,
                                    button:"OK",
                                }
                                );
                            </script>
                     @endif -->
</div>


@endsection