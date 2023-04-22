@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
       
        <div class="panel-heading">
            Chi tiết đơn hàng
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
                @foreach($order_detail as $o_content)
                <tr>




                    <td>{{$o_content->product_id}}</td>
                    <td>{{$o_content->product_name}}</td>
                    <td>{{$o_content->product_qty}}</td>
                    <td>{{$o_content->price}}</td>
                    <td>
                        <?php    
                echo    $o_content->product_qty*$o_content->price
            ?>
                    </td>



                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="panel-heading">
            Thông tin khách hàng
        </div>
        <table class="table table-striped b-t b-light">
            <thead>
                <tr>

                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Ghi chú</th>


                </tr>
            </thead>
            <tbody>

                <tr>

                    <td>{{$order_byid->shipping_name}}</td>
                    <td>{{$order_byid->shipping_phone}}</td>
                    <td>{{$order_byid->shipping_address}}</td>
                    <td>{{$order_byid->shipping_note}}</td>


                </tr>

            </tbody>
        </table>

        <form action="{{route('admin.update_order',['orderId'=>$order_byid->order_id])}}" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <h4 for="">Cập nhật tình trạng đơn hàng</h4>
                <select class="form-control m-bot15" name="tinhtrangdonhang" style="width:40%">
                    <option value='Đang xử lý'>Đang xử lý</option>
                    <option value='Đã giao cho bên vận chuyển'>Đã giao cho bên vận chuyển</option>
                    <option value='Giao hàng thành công'>Giao hàng thành công</option>
                    <option value='Hủy đơn hàng'>Hủy đơn hàng</option>


                </select>
            </div>
            <a href="{{route('admin.manage_order')}}" class="btn btn-warning">Quay lại </a>
           <button type="submit" class="btn btn-success" name="update_trangthai">Cập nhật</button>
        
        </form>
   
    </div>

</div>

</div>


@endsection