@extends('admin_layout')
@section('admin_content')
<style>
.edit{
  color: #fff!important;

}
</style>
<div class="table-agile-info">
  <div class="panel panel-default">
    @include('common.alert')
  <a class="btn btn-success " href="{{  route('admin.new_category')}}" type="button" style="margin-bottom: 10px;">Thêm</a>
    <div class="panel-heading">
      Liệt kê danh mục sản phẩm
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
          
            <th>Tên danh mục</th>
            <th style="width:120px">Hiển thị</th>
            
            <th >Thao tác</th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_category_product as $key => $cate_pro)
          <tr>
           
            <td>{{$cate_pro->category_name}}</td>
            <td><span class="text-ellipsis">
              <?php 
                  if($cate_pro->category_status==0){
              ?>
                   <a href="{{ route('admin.active_category',['category_id'=>$cate_pro->category_id ]) }}"> <i class="fa-regular fa-circle-xmark" style="color: #f70808;font-size:18px"></i></a>
                  <?php
                    }else{
                  ?>
                    <a href="{{ route('admin.unactive_category',['category_id'=>$cate_pro->category_id ]) }}"> <i class="fa-regular fa-circle-check" style="color: #34e411;font-size:18px"></i></a>
                  <?php
                  }
               ?>
           
            </span></td>
            
            <td style="width: 123px">
              <a href="{{ route('admin.edit_category',['category_id' => $cate_pro->category_id]) }}"
                 class="active btn btn-sm btn-success " ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-active" style="font-size: 18px;"></i>
              </a>
              <a href="{{  route('admin.delete_category',['category_id'=>$cate_pro->category_id]) }}" 
              onclick="return confirm('Bạn có chắc muốn xóa danh mục này không?')"
              class="edit btn btn-sm btn-danger" ui-toggle-class="">
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
          {{ $all_category_product->links() }}
          </div>
      </div>
       
    </footer>
  </div>
 
</div>


@endsection