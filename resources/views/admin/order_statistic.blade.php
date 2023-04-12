@extends('admin_layout')
@section('admin_content')
<div class="panel panel-default">
    <div class="panel-heading">
               Thống kê theo tình trạng đơn hàng
            </div>
    <div class="table-agile-info">
        <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên trạng thái</th>
                        <th>Số lượng đơn</th>
                    
                        <th>Tổng tiền</th>
                        
    
    
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $value )
                    <tr>
                       
                            
                        
                        <td>{{$value->order_status }} </td>
                       
                        <td>{{$value->count}}</td>
                        <td>{{number_format($value->sum).' VND'}}</td>
                        
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
                   {{ $orders->links() }}
                   </div>
               </div>
                
             </footer>
        </div>
      
@endsection