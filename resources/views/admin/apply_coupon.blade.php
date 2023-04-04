@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
    @include('common.alert')
        <div class="panel-heading">
            Áp dụng khuyến mãi cho sản phẩm
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
                        <th>ID SP</th>
                        <th style="width:200px">Tên sản phẩm</th>
                        <th>Giá sản phẩm</th>
                        
                        <th>Khuyến mãi áp dụng</th>
                        <th style="width:20px"></th>

                        <th style="width:20px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product_coupon as $key => $pro)
                    <tr>
                        <td>{{$pro->product_id}}</td>
                        <td>{{$pro->product_name}}</td>

                        <td>{{number_format($pro->product_price).' VND'}}</td>

                        <?php
                            
                            if($pro->coupon_name == null){
                        ?>

                                <td>Không có</td>
                        <?php
                            }else{
                            ?>
                            <td>{{$pro->coupon_name}}</td>
                            <?php
                            }
                            ?>
                         
                        <td>
                           
                        <button type="button" class="btn btn-success btn-sm open_modal" data-toggle="modal"
                        data-target="#myModal">
                        Thêm km
                    </button>
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <form action="{{URL::to('/save-coupon-product/'.$pro->product_id)}}" method="post">
                                {{csrf_field()}}
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <a type="submit" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></a>
                                        <h2 class="modal-title" id="myModalLabel">Khuyến mãi</h2>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-one" style="width:100%">



                                           <select name="km">
                                                @foreach($coupons as $key => $cp)
                                                    <option value={{$cp->coupon_id}}>{{$cp->coupon_name}} </option>
                                                @endforeach
                                            </select>
                                           



                                        </div>
                                    </div>
                                    <div class="modal-footer ">


                                        <button type="submit" class="btn btn-success" 
                                            style="margin-top:10px">Lưu</button>
                                        <button type="button" class="btn btn-info" data-dismiss="modal"
                                            style="margin-top:10px">Đóng</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                        </td>
                        <td>
                            <a href="{{URL::to('/delete-product-coupon/'.$pro->product_id)}}">
                                <!-- xóa khuyến mãi của sp đó thôi -->
                                <i class="fa-solid fa-trash" style="color:red;"></i>
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