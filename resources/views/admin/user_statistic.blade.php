@extends('admin_layout')
@section('admin_content')
<div class="panel panel-default">
    <div class="panel-heading">
               Tổng đơn theo khách hàng
            </div>
    <div class="table-agile-info">
        <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Mã khách hàng </th>
                        <th>Tên khách hàng</th>
                        <th>Số lượng đơn đã đặt</th>

                        <th>Tổng tiền các đơn hàng</th>
                        
    
    
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customer as $value )
                    <tr>
                       
                            
                        
                        <td>{{$value->customer_id }} </td>
                        <td>{{$value->customer_name}}</td>
                        <td>{{$value->count}}</td>
                        <td>{{number_format($value->sum).' VND'}}</td>
                        
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
@endsection