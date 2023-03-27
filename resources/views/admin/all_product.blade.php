@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê các sản phẩm
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
            
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>
            <th>Nội dung sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Hiển thị</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_product as $key => $pro)
          <tr>
         
            <td>{{$pro->product_name}}</td>
            <td> <img src="public/upload/product/{{$pro->product_image}}" height="100" width="100"> </td>
            <td>{{$pro->category_name}}</td>
            <td>{{$pro->brand_name}}</td>
            <td>{{$pro->product_content}}</td>
            <td>{{$pro->product_price}}</td>
            <td>{{$pro->product_SLtrongkho}}</td>
            <td><span class="text-ellipsis">
              <?php 
                  if($pro->product_status==0){
              ?>
                   <a href="{{URL::to('/active-product/'.$pro->product_id)}}"> <i class="fa-regular fa-circle-xmark" style="color: #f70808;font-size:18px"></i></a>;
                  <?php
                    }else{
                  ?>
                    <a href="{{URL::to('/unactive-product/'.$pro->product_id)}}"> <i class="fa-regular fa-circle-check" style="color: #34e411;font-size:18px"></i></a>;
                  <?php
                  }
               ?>
           
            </span></td>
            
            <td>
              <a href="{{URL::to('edit-product/'.$pro->product_id)}}" class="active" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active" style="font-size: 18px;"></i>
              </a>
              <a href="{{URL::to('delete-product/'.$pro->product_id)}}" 
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
  
</div>


@endsection