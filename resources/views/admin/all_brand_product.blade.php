@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">

  <div class="panel panel-default">
    @include('common.alert')
  <a class="btn btn-success " href="{{ route('admin.add_brand' )}}" type="button" style="margin-bottom: 10px;">Thêm</a>
    <div class="panel-heading">
    
      Liệt kê thương hiệu sản phẩm
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
          
            <th>Tên thương hiệu</th>
            <th style="width:100px;">Hiển thị</th>
            
            <th >Thao tác</th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_brand_product as $key => $cate_pro)
          <tr>
          
            <td>{{$cate_pro->brand_name}}</td>
            <td><span class="text-ellipsis">
              <?php 
                  if($cate_pro->brand_status==0){
              ?>
                   <a href="{{route('admin.active_brand',['brand_id' =>$cate_pro->brand_id ])}}"> <i class="fa-regular fa-circle-xmark" style="color: #f70808;font-size:18px"></i></a>
                  <?php
                    }else{
                  ?>
                    <a href="{{route('admin.unactive_brand',['brand_id' =>$cate_pro->brand_id ])}}"> <i class="fa-regular fa-circle-check" style="color: #34e411;font-size:18px"></i></a>
                  <?php
                  }
               ?>
           
            </span></td>
            
            <td style="width:123px">
              <a href="{{route('admin.edit_brand',['brand_id' =>$cate_pro->brand_id ])}}" 
                class="active btn btn-sm btn-success" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-active" style="font-size: 18px;"></i>
              </a>
              <a href="{{route('admin.delete_brand',['brand_id' =>$cate_pro->brand_id ])}}"
              onclick="return confirm('Bạn có chắc muốn xóa thương hiệu này không?')"
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
          {{ $all_brand_product->links() }}
          </div>
      </div>
       
    </footer>
   
  </div>
  
</div>


@endsection