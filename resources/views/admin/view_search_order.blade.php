@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê đơn hàng
    </div>
    
    <div class="row w3-res-tb">
    
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
      <form action="{{URL::to('/timkiem_order')}}">
        <div class="input-group">
            <input type="text" class="input-sm form-control" placeholder="Search" name="keyword">
            <span class="input-group-btn">
              <button class="btn btn-sm btn-default" type="submit" name="keyword">Tìm kiếm</button>
            </span>
          </div>
        </form>
        
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            
            <th>ID đơn hàng</th>
            <th>Tên khách hàng</th>
            <th>Tổng giá trị đơn hàng</th>
            <th>Ngày đặt hàng</th>
            <th>Tình trạng đơn hàng</th>
            
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_order as $key => $order)
          <tr>
            
            <td>{{$order->order_id}}</td>
          
            <td>{{$order->customer_name}}</td>
            <td>{{$order->order_total}}</td>
            <td>{{date('d/m/Y', strtotime($order->order_ngaydathang))}}</td>
            <td>{{$order->order_status}}</td>
           
            <!-- <td><span class="text-ellipsis">
              
           
            </span></td> -->
            
            <td>
              <a href="{{route('admin.view_order',[ 'orderId'=>$order->order_id])}}" class="active" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active" style="font-size: 18px;"></i>
              </a>
              <a href="{{route('admin.add_product',[ 'order_id'=>$order->order_id])}}" 
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
  
</div>


@endsection