@extends('admin_layout')
@section('admin_content')
<div class="panel panel-default">
    <div class="panel-heading">
              Doanh thu theo ngày
            </div>
        </div>
<div class="col-md-12 floatcharts_w3layouts_left">
   
    <div class="floatcharts_w3layouts_top">
        <div class="floatcharts_w3layouts_bottom">
<div id="chart" style="height: 250px;"></div>


<?php 
        $chartdata = '';

        foreach ($data as $key => $value) {
            $chartdata .=  "{date: '".date('d/m/Y',strtotime($value->date))."', value: $value->value}," ;
            
        }
   
    ?>
    <script>
        var chart = Morris.Bar({
          element: 'chart',
          data: [<?php echo $chartdata; ?>],
          xkey: 'date',
          ykeys: ['value'],
          labels: ['Tổng tiền']
        });
        </script>
   

        </div>
    </div>
</div>



<div class="col-md-12 floatcharts_w3layouts_left">
    <div class="panel panel-default">
    <div class="panel-heading">
               Doanh thu theo tháng
            </div>
        </div>
    <div class="floatcharts_w3layouts_top">
        <div class="floatcharts_w3layouts_bottom">
    <div id="chart2" style="height: 250px;"></div>
    <?php
    
    $chartdata2 = '';
    $i =1;
    foreach($data2 as $key => $value){
    
     $chartdata2 .=  "{month: $value->thang, value: $value->value }," ;
     
      
    }

  
    ?>
    <script>
    var chart2 = Morris.Bar({
      element: 'chart2',
      data: [<?php echo $chartdata2; ?>],
      xkey: 'month',
      ykeys: ['value'],
      labels: ['Tổng tiền']
    });

    
</script>

    

        </div>
    </div>
</div>
















@endsection