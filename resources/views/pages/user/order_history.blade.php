@extends('layout')
@section('content')
<div class="table-agile-info">
<h4 class="panel-heading">
     Đơn hàng của tôi
    </h4>
    @foreach($order_id as $id)
    <div class="row w3-res-tb">
     
      <div class="col-sm-8">
       <h5> Mã đơn hàng {{$id['order_id']}}</h5>
      </div>
      <div class="col-sm-3">
        <h5>trạng thái </h5>
      </div>
     

  
 
    
  
    <div class="table-responsive">
      
    @foreach($product_of_order as $oc)
        @foreach($oc as $key => $o)
       
    <table class="table table-striped b-t b-light">
       
        <tbody>
          
          <tr>
           <td>t</td>
           <td>g</td>
           <td>g</td>
           <td>g</td>
          </tr>
     
        </tbody>
    </table>
    </div>
    @endforeach
      
     @endforeach
    
     
    </div>
    @endforeach
@endsection