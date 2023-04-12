@extends('admin_layout')
@section('admin_content')


<form action="{{route('admin.timkiem_thong_ke')}}">
        <div class="input-group" style="width:50%">
            <input type="text" class="input-sm form-control" placeholder="Search" name="keyword_sub">
            <span class="input-group-btn">
                <button class="btn btn-sm btn-success" type="submit">Tìm kiếm</button>
            </span>
        </div>
        </form>
    
<div class="panel-heading">
            Tổng doanh thu
        </div>
<div class="table-agile-info">
    <table class="table table-striped b-t b-light">
            <thead>
                <tr>

                    <th>Tổng số tiền đơn hàng</th>
                    <th>Tổng số tiền đã thanh toán</th>
                    <th>Tổng số tiền chưa thanh toán</th>
                    


                </tr>
            </thead>
            <tbody>
                <tr>

                    <td>{{number_format($total).'VND'}}</td>
                    <td>{{number_format($total_paid).'VND'}}</td>
                    <td>{{number_format($total_unpaid).'VND'}}</td>
                </tr>
                
            </tbody>
        </table>
    <div class="panel panel-default">
        <!-- <div class="input-group" style="width:50%">
            <input type="text" class="input-sm form-control" placeholder="Search">
            <span class="input-group-btn">
                <button class="btn btn-sm btn-success" type="button">Tìm kiếm</button>
            </span>
        </div> -->
        <div class="panel-heading">
            Các sản phẩm đã bán
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped b-t b-light">
            <thead>
                <tr>

                    <th>ID sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng tiền</th>
                    
                </tr>
            </thead>
            <tbody>
            @foreach($statistical as $statistical)
                <tr>




                    <td>{{$statistical->product_id}}</td>
                    <td>{{$statistical->product_name}}</td>
                    <td>{{$statistical->count}}</td>
                    <td>{{number_format($statistical->product_price).'VND'}}</td>
                    <td>{{number_format($statistical->total).'VND'}}</td>
                    



                </tr>
                @endforeach
                
            </tbody>
        </table>
        
        

        
   
    </div>

</div>

</div>


@endsection