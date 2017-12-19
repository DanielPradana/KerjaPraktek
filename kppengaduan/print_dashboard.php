<?php
   include('session.php');
   $tahun=null;
   if(isset($_GET['tahun'])){
        $tahun=$_GET['tahun'];
   }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BPJS</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

   <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
   

    <link rel="stylesheet" type="text/css" href="assets/css/datepicker.css">
    <script type="text/javascript" src="assets/js2/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js2/bootstrap-datepicker.js"></script>
    <style type="text/css">
        #datepicker{
            width: 180px; margin: 0 20px 20px 20px;
        }
        #datepicker > span:hover{
            cursor: pointer;
        }
    </style>
</head>
<body>


                  <hr />
                <?php
                    $complaintdelete = 0;
                    $complaintfinished = 0;
                    $complaintonprogress = 0;
                    $uid = $_SESSION['iduser'];
                    $sql = "SELECT * FROM report WHERE userid = '$uid'";
                    $result = mysqli_query($db,$sql);
                    $row = mysqli_fetch_array($result);
                    $complaintdelete = $row['complaintdelete'];
                    $complaintfinished = $row['complaintfinished'];
                    $complaintonprogress = $row['complaintonprogress'];
                    $sum_total=$complaintdelete+$complaintfinished+$complaintonprogress;

                ?>
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-6">         
                         <div class="panel panel-back noti-box">
                         <p class="text-muted">Total Complaint</p>  
                            <span class="icon-box bg-color-yellow set-icon">
                            <i class="fa fa-area-chart"></i>
                            </span>
                                <div class="text-box" >
                                    <p class="main-text"><?php echo $sum_total; ?></p>
                                </div>
                        </div>
                    </div>
                        <div class="col-md-3 col-sm-6 col-xs-6">           
                             <div class="panel panel-back noti-box">
                             <p class="text-muted">Complaint Delete</p>
                                <span class="icon-box bg-color-red set-icon">
                                <i class="fa fa-area-chart"></i>
                                </span>
                                    <div class="text-box" >
                                        <p class="main-text"><?php echo $complaintdelete; ?></p>
                                    </div>
                            </div>
                        </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">           
                         <div class="panel panel-back noti-box">
                         <p class="text-muted">Complaint Finished</p>
                            <span class="icon-box bg-color-green set-icon">
                            <i class="fa fa-area-chart"></i>
                            </span>
                            <div class="text-box" >
                                <p class="main-text"><?php echo $complaintfinished; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">           
                         <div class="panel panel-back noti-box">
                         <p class="text-muted">Complaint on Progress</p>
                            <span class="icon-box bg-color-blue set-icon">
                            <i class="fa fa-area-chart"></i>
                            </span>
                            <div class="text-box" >
                                <p class="main-text"><?php echo $complaintonprogress; ?></p>
                            </div>
                        </div>
                    </div>
                 </div>
                 <!-- /. ROW  -->
                <hr />   

            
            <script type="text/javascript">
                $(function(){
                    $("#datepicker").datepicker({
                        autoclose: true,
                        todayHighlight: true
                    }).datepicker('update', new Date());
                });
            </script>

                <div class="row"> 
                    
                      
                <div class=" col-sm-12 col-xs-12">                     
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Complaint Accumulation (2017)
                        </div>
                        <div class="panel-body">
                        <?php
                        
                                $x=01;
                                $n=01;
                                $tampTotalComplaint=0;
                                while($x<=12){
                                    $sql1 = "SELECT * FROM report WHERE userid = '$uid' AND tahun = '$tahun' AND bulan='$x'";
                                    $result1 = mysqli_query($db,$sql1);
                                    $row1 = mysqli_fetch_array($result1);
                                    $totalcomplaint=$row1[1]+$row1[2]+$row1[3]+0;
                                    $tampTotalComplaint+=$totalcomplaint;
                                    $x++;
                                }
                                                                        
                                while($n<=12){
                                    $sql1 = "SELECT * FROM report WHERE userid = '$uid' AND tahun = '$tahun' AND bulan='$n'";
                                    $result1 = mysqli_query($db,$sql1);
                                    $row1 = mysqli_fetch_array($result1);
                                    $persentotal=($row1[1]+$row1[2]+$row1[3]+0)*100;
                                    

                                    if ($persentotal==0||$tampTotalComplaint==0) {
                                        $percenttotalcomplaint=0;
                                    }
                                    else{
                                        $percenttotalcomplaint=$persentotal/$tampTotalComplaint;
                                    }

                                    
                                    if($n==1){
                                        $jan=$percenttotalcomplaint;
                                    }
                                    else if($n==2){
                                        $feb=$percenttotalcomplaint;
                                    }
                                    else if($n==3){
                                        $mar=$percenttotalcomplaint;
                                    }
                                    else if($n==4){
                                        $apr=$percenttotalcomplaint;
                                    }
                                    else if($n==5){
                                        $mei=$percenttotalcomplaint;
                                    }
                                    else if($n==6){
                                        $jun=$percenttotalcomplaint;
                                    }
                                    else if($n==7){
                                        $jul=$percenttotalcomplaint;
                                    }
                                    else if($n==8){
                                        $ags=$percenttotalcomplaint;
                                    }
                                    else if($n==9){
                                        $sep=$percenttotalcomplaint;
                                    }
                                    else if($n==10){
                                        $okt=$percenttotalcomplaint;
                                    }
                                    else if($n==11){
                                        $nov=$percenttotalcomplaint;
                                    }
                                    else if($n==12){
                                        $des=$percenttotalcomplaint;
                                    }
                                    
                               
                                $n++;
                                }
                                
                                
                            ?>
                            <div id="container" style="width: 600px; height: 300px; margin: 0 auto"></div>
                <script>
                            Highcharts.chart('container', {
                                    chart: {
                                        type: 'column'
                                    },
                                    title: {
                                        text: '2017'
                                    },
                                    subtitle: {
                                        text: 'BPJS Ketenagakerjaan'
                                    },
                                    xAxis: {
                                        categories: [
                                            'Jan(<?php echo ceil($jan)?>)',
                                            'Feb(<?php echo ceil($feb)?>)',
                                            'Mar(<?php echo ceil($mar)?>)',
                                            'Apr(<?php echo ceil($apr)?>)',
                                            'May(<?php echo ceil($mei)?>)',
                                            'Jun(<?php echo ceil($jun)?>)',
                                            'Jul(<?php echo ceil($jul)?>)',
                                            'Aug(<?php echo ceil($ags)?>)',
                                            'Sep(<?php echo ceil($sep)?>)',
                                            'Oct(<?php echo ceil($okt)?>)',
                                            'Nov(<?php echo ceil($nov)?>)',
                                            'Dec(<?php echo ceil($des)?>)'
                                        ],
                                        crosshair: true
                                    },
                                    yAxis: {
                                        min: 0,
                                        title: {
                                            text: ''
                                        }
                                    },
                                    tooltip: {
                                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                            '<td style="padding:0"><b>{point.y:.1f} %</b></td></tr>',
                                        footerFormat: '</table>',
                                        shared: true,
                                        useHTML: true
                                    },
                                    plotOptions: {
                                        column: {
                                            pointPadding: 0.2,
                                            borderWidth: 0
                                        }
                                    },
                                    series: [{
                                        name: 'Data Pengaduan',
                                        data: [<?php echo ceil($jan)?>, <?php echo ceil($feb)?>, <?php echo ceil($mar)?>, <?php echo ceil($apr)?>, <?php echo ceil($mei)?>, <?php echo ceil($jun)?>, <?php echo ceil($jul)?>, <?php echo ceil($ags)?>, <?php echo ceil($sep)?>, <?php echo ceil($okt)?>, <?php echo ceil($nov)?>, <?php echo ceil($des)?>]

                                    }]
                                });
                </script>
                        </div>
                    </div>            
                </div>

                
                </div>
                
                
    
                 <!-- /. ROW  -->           
     
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>

<script>
        window.load = print_d();
        function print_d(){
            window.print();
        }
    </script>

</body>
</html>