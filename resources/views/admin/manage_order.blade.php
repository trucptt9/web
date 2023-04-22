@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê đơn hàng
    </div>

    {{-- <div class="row" style="margin-top:10px">
      <form action="{{ route('admin.search_order') }}" method="get">
      <div class="col-sm-3">
        
        
        <select class="form-control" style="width:200px;" name="name_search"  >
          <option value="0" type="">-- Chọn tên -- </option>
          @foreach($all_order as $key => $order)
         
          <option value=" {{ $order->customer_name}}" type="" > {{ $order->customer_name }} </option>
          @endforeach
        </select>
       
      </div>
      <div class="col-sm-6" style="display: flex">
        
        <input type="date" class="form-control" style="width:200px;" name="date_order" value='0' value="{{  $_GET['date_order'] ?? ''  }}"> 
        <button class="btn btn-sm btn-success" type="submit" style="margin-left:10px" >Tìm kiếm</button>
      </form>
      </div>

      
       
    
    </div> --}}
   

    
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
            
            <th>ID đơn hàng</th>
            <th>Tên khách hàng</th>
            <th>Tổng giá trị đơn hàng</th>
            <th>Ngày đặt hàng</th>
            <th >Tình trạng đơn hàng</th>
            
            
            <th style="width:123px;">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_order as $key => $order)
          <tr>
            
            <td>{{$order->order_id}}</td>
          
            <td>{{$order->customer_name}}</td>
            <td>{{number_format($order->order_total).' VND'}}</td>
            <td>{{date('d/m/Y', strtotime($order->order_ngaydathang))}}</td>
            <td>{{$order->order_status}}</td>
           
            <!-- <td><span class="text-ellipsis">
              
           
            </span></td> -->
            
            <td>
              <a href="{{route('admin.view_order',['orderId'=>$order->order_id])}}"
                 class="active btn btn-sm btn-success " ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-active" style="font-size: 18px;"></i>
              </a>
              <a href="{{route('admin.delete_order',['order_id'=>$order->order_id])}}" 
              onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')"
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
         {{ $all_order->links() }}
        </div>
      </div>
    </footer>
  </div>
  
</div>


@endsection