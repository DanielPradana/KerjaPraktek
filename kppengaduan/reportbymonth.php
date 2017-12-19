<?php
   include('session.php');
   $tahun=date("Y");
   $tahunsekarang=date("Y");
   $bulansekarang=date("m");
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

   <script src="assets/js1/Chart.bundle.js"></script>

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
    <div id="wrapper">

        <nav class="navbar navbar-default navbar-cls-top navbar-fixed-top" role="navigation" style="margin-bottom: 0;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">BPJSTK DCIS SYSTEM</a> 
            </div>
        </nav>   
           <!-- /. NAV TOP  -->
            <nav class="navbar-default navbar-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="main-menu">
                    <li class="text-center">
                    <?php
                    $imageprofile=$rowuser['image'];
                        if($imageprofile==null){
                            echo '<img src="assets/img/find_user.png" class="user-image img-responsive"/>';
                        }
                        else{
                            echo '<img src="assets/img/user/profile/'.$_SESSION["iduser"].'/'.$imageprofile.'" class="user-image img-responsive"/>';
                        }
                    ?>  
                        
                        <h4 style="color: yellow; margin-top: -20px;"><?php echo $_SESSION["iduser"]; ?></h4>
                        <p style="color: black; margin-top: -20px;"><?php echo $_SESSION["username"]; ?></p>                       
                    </li>
        
                    
                    <li>
                        <a href="index.php"><i class="fa fa-dashboard fa-2x"></i> Dashboard</a>
                    </li>
                    <li>
                        <a class="active-menu" href="reportbymonth.php"><i class="fa fa-bar-chart fa-2x"></i> Report by Month</a>
                    </li>
                    <?php
                        if($rowuser['lokasi']=="kapu"){
                            echo '<li>
                        <a  href="recordacomplaint.php"><i class="fa fa-file fa-2x"></i> Record a Complaint</a>
                    </li>';
                        }
                        else{
                            echo '';
                        }
                    ?>
                    
                    <li>
                        <a   href="listcomplaint.php"><i class="fa fa-list fa-2x"></i> List Complaint</a>
                    </li>   
                    <li  >
                        <a  href="printreport.php"><i class="fa fa-print fa-2x"></i> Print Report</a>
                    </li>
                    <li  >
                        <a  href="profile.php"><i class="fa fa-chain fa-2x"></i> Profile Setting</a>
                    </li>
                    <li>
                        <a href="logout.php" onclick="return logout()"><i class="fa fa-sign-out fa-2x"></i>Logout</a> 
                    </li>
                              
                    </ul>
               
            </div>
            
        </nav>
        <!-- /. NAV SIDE  -->
    <div id="page-wrapper" >
            <div id="page-inner">

            <?php
                    $uid = $_SESSION['iduser'];
                    $sql = "SELECT * FROM report WHERE userid = '$uid' AND tahun = '$tahunsekarang' AND bulan = '$bulansekarang'";
                    $result = mysqli_query($db,$sql);
                    $row = mysqli_fetch_array($result);
                    $complaintdelete = $row['complaintdelete'];
                    $complaintfinished = $row['complaintfinished'];
                    $complaintonprogress = $row['complaintonprogress'];
                    $sum_total=$complaintdelete+$complaintfinished+$complaintonprogress;
                ?>

                  <hr />
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-6">         
                         <div class="panel panel-back noti-box">
                         <p class="text-muted">Total Complaint</p>  
                            <span class="icon-box bg-color-yellow set-icon">
                            <i class="fa fa-area-chart"></i>
                            </span>
                                <div class="text-box" >
                                    <p class="main-text"><?php echo $sum_total ?></p>
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
                                        <p class="main-text"><?php echo $row['complaintdelete']+0; ?></p>
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
                                <p class="main-text"><?php echo $row['complaintfinished']+0; ?></p>
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
                                <p class="main-text"><?php echo $row['complaintonprogress']+0; ?></p>
                            </div>
                        </div>
                    </div>
                 </div>
                 <!-- /. ROW  -->     
                 <hr />             
            <form method="GET" action="" enctype="multipart/form-data">
            <table style="margin-left: -20px;">
                <th>
                    <td><div style="margin-top: 10px;" id="datepicker" class="input-group date" data-date-format="yyyy">
                        <input class="form-control" type="text" name="tahun">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </td>

                    <td><button style="margin-top: -10px;" type="submit" class="btn btn-primary">Search</button></td>
                    <td style="padding-left: 10px;" ><a href="reportbymonth_pdf.php?tahun=<?php echo $tahun;?>"><i class="fa fa-file-pdf-o fa-2x" style="margin-top: -20px;"></i></a></td>
                    <td style="padding-left: 10px;" ><a href="" onClick="print_d()"><i class="fa fa-print fa-2x" style="margin-top: -20px;"></i></a></td>
                </th>

                <script>
                            function print_d(){
                                window.open("print_reportbymonth.php?tahun=<?php echo $tahun;?>","_blank");
                            }
                </script>
                
            </table>
            </form>
            
            <script type="text/javascript">
                $(function(){
                    $("#datepicker").datepicker({
                        autoclose: true,
                        todayHighlight: true
                    }).datepicker('update', new Date());
                });
            </script>
            


            <div class="row">
                <div class="col-md-6">
                    <!-- Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Complaint Accumulation
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Month</th>
                                            <th>Total Complaint</th>
                                            <th>Complaint on Progress</th>
                                            <th>Complaint Delete</th>
                                            <th>Complaint Finished</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        
                                        $n=01;
                                        $tampTotalComplaint=0;
                                        $tampTotalOnProgress=0;
                                        $tampTotalDelete=0;
                                        $tampTotalFinished=0;
                                        
                                        while($n<=12){
                                            $sql1 = "SELECT * FROM report WHERE userid = '$uid' AND tahun = '$tahun' AND bulan='$n'";
                                            $result1 = mysqli_query($db,$sql1);
                                            $row1 = mysqli_fetch_array($result1);
                                            $totalcomplaint=$row1[1]+$row1[2]+$row1[3]+0;
                                            $onprogress=$row1[1]+0;
                                            $delete=$row1[2]+0;
                                            $finished=$row1[3]+0;
                                            include("reportbymonthdata.php");
                                            echo '<tr>
                                            <td>'.$n.'</td>
                                            <td>'.$shbulan.'</td>
                                            <td class="center">'.$totalcomplaint.'</td>
                                            <td class="center">'.$onprogress.'</td>
                                            <td class="center">'.$delete.'</td>
                                            <td class="center">'.$finished.'</td>
                                        </tr>';
                                        $tampTotalComplaint+=$totalcomplaint;
                                        $tampTotalOnProgress+=$onprogress;
                                        $tampTotalDelete+=$delete;
                                        $tampTotalFinished+=$finished;
                                        $n++;
                                        }
                                        echo '<tr>
                                            <td class="center"></td>
                                            <td>Total</td>
                                            <td class="center">'.$tampTotalComplaint.'</td>
                                            <td class="center">'.$tampTotalOnProgress.'</td>
                                            <td class="center">'.$tampTotalDelete.'</td>
                                            <td class="center">'.$tampTotalFinished.'</td>
                                        </tr>';
                                        
                                        if($tampTotalComplaint==0){
                                            echo "<script language='javascript'>\n";
                                            echo "alert('No data')";
                                            echo "</script>\n";
                                        }
                                    ?>
                                        
                                       
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Tables -->
                </div>

                <div class="col-md-6">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Percentage Complaint Accumulation
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Month</th>
                                            <th>Total Complaint</th>
                                            <th>Complaint on Progress</th>
                                            <th>Complaint Delete</th>
                                            <th>Complaint Finished</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        
                                        $n=01;

                                        
                                        while($n<=12){
                                            $sql1 = "SELECT * FROM report WHERE userid = '$uid' AND tahun = '$tahun' AND bulan='$n'";
                                            $result1 = mysqli_query($db,$sql1);
                                            $row1 = mysqli_fetch_array($result1);
                                            $persentotal=($row1[1]+$row1[2]+$row1[3]+0)*100;
                                            $persenprogress=($row1[1]+0)*100;
                                            $persenhapus=($row1[2]+0)*100;
                                            $persenselesai=($row1[3]+0)*100;

                                            if ($persentotal==0||$tampTotalComplaint==0) {
                                                $percenttotalcomplaint=0;
                                            }
                                            else{
                                                $percenttotalcomplaint=$persentotal/$tampTotalComplaint;
                                            }
                                            if($persenprogress==0||$tampTotalOnProgress==0){
                                                $percentonprogress=0;
                                            }
                                            else{
                                                $percentonprogress=$persenprogress/$tampTotalOnProgress;
                                            }
                                            if($persenhapus==0||$tampTotalDelete==0){
                                                $percentdelete=0;
                                            }
                                            else{
                                                $percentdelete=$persenhapus/$tampTotalDelete;
                                            }
                                            if($persenselesai==0||$tampTotalFinished==0){
                                                $percentfinished=0;
                                            }
                                            else{
                                                $percentfinished=$persenselesai/$tampTotalFinished;
                                            }

                                            include("reportbymonthdata.php");
                                            echo '<tr>
                                            <td>'.$n.'</td>
                                            <td>'.$shbulan.'</td>
                                            <td class="center">'.ceil($percenttotalcomplaint).'%</td>
                                            <td class="center">'.ceil($percentonprogress).'%</td>
                                            <td class="center">'.ceil($percentdelete).'%</td>
                                            <td class="center">'.ceil($percentfinished).'%</td>
                                        </tr>';
                                       
                                        $n++;
                                        }
                                        
                                        
                                    ?>
 
                                       
                                       
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Tables -->
                </div>
            </div>
                <!-- /. ROW  -->
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            User Complaint Record Accumulation
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>User</th>
                                            <th>Total</th>
                                            <th>Selesai</th>
                                            <th>Proses</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $x=1;
                                        $hitung=0;
                                        $sqluser1 = "SELECT * FROM user";
                                        $resultuser1 = mysqli_query($db,$sqluser1);
                                        while($rowpetugas=mysqli_fetch_array($resultuser1))
                                        {
                                            $idpetugas=$rowpetugas["iduser"];
                                            $sql1 = "SELECT SUM(complaintonprogress) AS totalonprogress, SUM(complaintfinished) AS totalfinished FROM report WHERE tahun = '$tahun' AND userid = '$idpetugas'";
                                            $result1 = mysqli_query($db,$sql1);
                                            $rowjumlah=mysqli_fetch_array($result1);
                                            $hitung=$rowjumlah["totalfinished"]+$rowjumlah["totalonprogress"];
                                            $hitungselesai=$rowjumlah["totalfinished"]+0;
                                            $hitungprogress=$rowjumlah["totalonprogress"]+0;
                                            echo '<tr>
                                            <td>'.$x.'</td>
                                            <td>'.$rowpetugas["username"].'</td>
                                            <td>'.$hitung.'</td>
                                            <td>'.$hitungselesai.'</td>
                                            <td>'.$hitungprogress.'</td>
                                        </tr>';
                                            
                                        $x++;
                                        }
                                    ?>
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
               
            </div>
           
          
             
            </div>
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
