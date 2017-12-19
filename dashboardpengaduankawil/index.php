<?php
include('config.php');
$tahun = Date("Y");
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
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <script src="https://code.highcharts.com/highcharts.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <script src="assets/js/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="assets/js/jquery.easing.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.easy-ticker.js"></script>

<?php

    $tamp1 = "SELECT * FROM complaint";
    $tamp2 = mysqli_query($db,$tamp1);
    $countz = mysqli_num_rows($tamp2);
?>

<script type="text/javascript">
    var counting = "<?php echo $countz ?>";
</script>

<script type="text/javascript">

$(document).ready(function(){

    var dd = $('.vticker').easyTicker({
        direction: 'up',
        easing: 'easeInOutBack',
        speed: 'slow',
        interval: 2000,
        height: 'auto',
        visible: 2,
        mousePause: 0,
        controls: {
            up: '.up',
            down: '.down',
            toggle: '.toggle',
            stopText: 'Stop !!!'
        }
    }).data('easyTicker');
    
   
    
});



setInterval(function(){ 
      $.ajax({
           url:"update.php",
           method:"POST",
           data:{ },
           success:function(data){
            var g = JSON.parse(data);
             // alert(g['data']);
            if(counting != g['counting']){
            $('#complaintz').html(g['data']);
                counting = g['counting'];
             }
           }
      });
     },1000);

     // load_notification();

     //Notif------------------------------------------------------------> 
 
     // setInterval(function(){ 
     //    load_notification(); 
     // }, 5000);
    //Notif------------------------------------------------------------------>
</script>


    <style type="text/css">
        .container {
                width: 90%;
                margin: -15px auto;
            }
    </style>
</head>
<body>

  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">DASHBOARD PENGADUAN BPJSTK PUSAT JAKARTA</a>
    </div>
    <!-- <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li style="padding-top: 10px;"><select class="form-control input-sm">
                                                <option>-- Years --</option>
                                                <?php 
                                                    $sql = "SELECT * FROM report";
                                                    $result = mysqli_query($db,$sql);
                                                    while($row = mysqli_fetch_array($result))
                                                    {
                                                        echo "<option value='".$row['tahun']."'>".$row['tahun']."</option>";
                                                    }
                                                ?>
                                </select></li>
      </ul>
    </div> -->
  </div>
</nav>

<div class="container-fluid">
    <div class="row" style="margin-top: -20px;">
<div class="panel-body">
    <div class="col-md-6">                     
            <div class="panel panel-default">
                <div class="panel-heading">
                <label>Jumlah Pengaduan</label>
                </div>
                <div class="panel-body">
                 <?php
                        
                                $x=01;
                                $n=01;
                                $tampTotalComplaint=0;
                                while($x<=12){
                                    $sql1 = "SELECT * FROM report INNER JOIN user ON userid = iduser WHERE tahun = '$tahun' AND bulan='$x' AND lokasi='kapu'";
                                    $result1 = mysqli_query($db,$sql1);
                                    $row1 = mysqli_fetch_array($result1);
                                    $totalcomplaint=$row1[1]+$row1[2]+$row1[3]+0;
                                    $tampTotalComplaint+=$totalcomplaint;
                                    $x++;
                                }
                                                                        
                                while($n<=12){
                                    $sql1 = "SELECT * FROM report INNER JOIN user ON userid = iduser WHERE tahun = '$tahun' AND bulan='$n' AND lokasi='kapu'";
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
                            <div id="container" style="min-width: 310px; height: 300px; margin: 0 auto"></div>
                            <script>
                            Highcharts.chart('container', {
                                    chart: {
                                        type: 'column'
                                    },
                                    title: {
                                        text: '<?php echo $tahun?>'
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
    <div class="col-md-6">                     
            <div class="panel panel-default">
                <div class="panel-heading">
                    <label>Daftar Nama Pengaduan Belum Selesai</label>
                </div>
                <div class="panel-body">
                <br>
                <br>
                <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th style="padding: 0 120px 0 120px; ">User</th>
                        <th>Pengaduan Dengan File</th>
                        <th>Pengaduan Tanpa File</th>
                    </tr>
                </thead>
                <tbody>
                  
                        <?php
                            $n=1;
                            $sql2 = "SELECT * FROM user WHERE lokasi='kawil'";
                            $result2 = mysqli_query($db,$sql2);
                            while($row2 = mysqli_fetch_array($result2)){
                                $uidfile=$row2['iduser'];
                                $sqlfile = "SELECT count(*) AS total_file FROM complaint INNER JOIN user ON userid = iduser WHERE photo<>'' OR video<>'' AND userid='$uidfile' AND lokasi='kawil' AND status='onprogress' ORDER BY total_file DESC";
                                $resultfile = mysqli_query($db,$sqlfile);
                                $rowfile = mysqli_fetch_array($resultfile);
                                
                                $sqlnofile = "SELECT count(*) AS total_file FROM complaint INNER JOIN user ON userid = iduser WHERE photo='' AND video='' AND userid='$uidfile' AND lokasi='kawil' AND status='onprogress' ORDER BY total_file DESC";
                                $resultnofile = mysqli_query($db,$sqlnofile);
                                $rownofile = mysqli_fetch_array($resultnofile);
                                if ($n<=5) {
                                    echo "<tr>
                                <td>".$n."</td>
                                <td>".$row2['username']."</td>
                                <td>".$rowfile['total_file']."</td>
                                <td>".$rownofile['total_file']."</td>
                                </tr>";
                                $n++;
                                }

                                
                            }

                        ?>
                    </tbody>
                    </table>
               
                <br>
                </div>
            </div>
        </div> 
 </div>   
</div>


         
<div class="row" style="margin-top: -20px;">
<div class="panel-body">
    <div class="col-md-3">
          <div class="panel panel-default">
            <div class="panel-heading">
                <label>Jumlah Pengaduan Sudah Selesai </label>
            </div>  
            <div class="panel-body">
            <?php
            $sqlfinished = "SELECT count(*) AS total_finished FROM complaint INNER JOIN user ON userid = iduser WHERE status='selesai' AND lokasi='kawil'";
            $resultfinished = mysqli_query($db,$sqlfinished);
            $rowfinished = mysqli_fetch_array($resultfinished);

            echo '<h1 class="text-center position2">'.$rowfinished["total_finished"].'</h1>';
            ?>
              
            </div>  
          </div>
        </div> 

        <div class="col-md-3">
          <div class="panel panel-default">
            <div class="panel-heading">
                <label>Jumlah Pengaduan Belum Selesai</label>
            </div>  
            <div class="panel-body">
            <?php
            $sqlonprogress = "SELECT count(*) AS total_progress FROM complaint INNER JOIN user ON userid = iduser WHERE status='onprogress' AND lokasi='kawil'";
            $resultonprogress = mysqli_query($db,$sqlonprogress);
            $rowonprogress = mysqli_fetch_array($resultonprogress);

            echo '<h1 class="text-center position2">'.$rowonprogress['total_progress'].'</h1>';
            ?>
              
            </div>  
          </div>
        </div>
     
       
            <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading">
                <label>Daftar Pengaduan</label>
            </div>  
            <div class="panel-body">
            <div class="vticker">
            <ul id="complaintz">
            <?php
            $sql3 = "SELECT * FROM complaint";
                    $result3 = mysqli_query($db,$sql3);
                    $countz = mysqli_num_rows($result3);
                    while($row3 = mysqli_fetch_array($result3)){
                       echo '<li style="padding-left:20%;padding-right:20%;"><div class="alert alert-info">
                        <span style="font-weight: bold;">Complaint Title : </span>
                        <span>'.$row3["complainttitle"].'<br>
                        <span style="font-weight: bold;">Keterangan Penangan : </span>
                        <span>'.$row3["status"].'</span><br>
                        <span style="font-weight: bold;">Complaint Received By : </span>
                        <i style="color: black;" ></i>&nbsp<span>'.$row3["complaintreceivedby"].'</span>
                        </li>';
                    }
                    
            ?>
            </ul>
            </div>
            </div> 
            <br>


             
          </div>
            </div>

          
        
         
</div>
</div>
</div>

        
<footer class="text-center">
  <p style="color: white;">Copyright&copy; 2017 BPJS Ketenagakerjaan, All Rights Reserved.</p>
</footer>
            


 <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    
    
   
</body>
</html>
