@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    @include('common.alert')
  <a class="btn btn-success " href="{{route('admin.add_product')}}" type="button" style="margin-bottom: 10px;">Thêm</a>
    <div class="panel-heading">
      Liệt kê các sản phẩm
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
         
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Đơn vị</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>
            
            <th style="width:150px;">Giá</th>
            <th>Số lượng</th>
            <th style="width:90px;">Hiển thị</th>
            
            <th style="width:120px;">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_product as $key => $pro)
          <tr>
         
            <td>{{$pro->product_name}}</td>
            <td> <img src="{{asset('upload/product/'.$pro->product_image)}}" height="100" width="100"> </td>
              <td>{{$pro->product_unit}}</td>
            <td>{{$pro->category_name}}</td>
            <td>{{$pro->brand_name}}</td>
           
            <td>{{number_format($pro->product_price).' VND'}}</td>
            <td>{{$pro->product_SLtrongkho}}</td>

            <td><span class="text-ellipsis">
              <?php 
                  if($pro->product_status==0){
              ?>
                   <a href="{{route('admin.active_product',['product_id'=>$pro->product_id])}}"> <i class="fa-regular fa-circle-xmark" style="color: #f70808;font-size:18px"></i></a>
                  <?php
                    }else{
                  ?>
                    <a href="{{route('admin.unactive_product',['product_id'=>$pro->product_id])}}"> <i class="fa-regular fa-circle-check" style="color: #34e411;font-size:18px"></i></a>
                  <?php
                  }
               ?>
           
            </span></td>
            
            <td>
              <a href="{{route('admin.edit_product',['product_id'=>$pro->product_id])}}"
                 class="active btn btn-sm btn-success" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-active" style="font-size: 18px;"></i>
              </a>
              <a href="{{route('admin.delete_product',['product_id'=>$pro->product_id])}}" 
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
        {{ $all_product->links() }}
        </div>
      </div>
       
    </footer>
  </div>
  
</div>


@endsection