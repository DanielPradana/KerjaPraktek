<?php
 // Define relative path from this script to mPDF
 $nama_dokumen='Reportbymonth'; //Beri nama file PDF hasil.
define('_MPDF_PATH','mpdf/');
include(_MPDF_PATH . "mpdf.php");
$mpdf=new mPDF('utf-8', 'A4'); // Create new mPDF Document
 
//Beginning Buffer to save PHP variables and HTML tags
ob_start(); 
?>
<!--sekarang Tinggal Codeing seperti biasanya. HTML, CSS, PHP tidak masalah.-->
<!--CONTOH Code START-->

<?php
   include('session.php');
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
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-5">         
                         <div class="panel panel-back noti-box">
                         <p class="text-muted">Total Complaint</p>  
                            <span><img src="assets/img/yellow.jpg">
                                <div class="text-box" >
                                    <p class="main-text"><?php echo $sum_total ?></p>
                                </div>
                            </span>
                        </div>
                    </div>
                        <div class="col-md-3 col-sm-6 col-xs-5">           
                             <div class="panel panel-back noti-box">
                             <p class="text-muted">Complaint Delete</p>
                                <span><img src="assets/img/red.jpg">
                                    <div class="text-box" >
                                        <p class="main-text"><?php echo $row['complaintdelete']; ?></p>
                                    </div>
                                </span>
                            </div>
                        </div>
                    <div class="col-md-3 col-sm-6 col-xs-5">           
                         <div class="panel panel-back noti-box">
                         <p class="text-muted">Complaint Finished</p>
                            <span><img src="assets/img/green.jpg">
                            <div class="text-box" >
                                <p class="main-text"><?php echo $row['complaintfinished']; ?></p>
                            </div>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-5">           
                         <div class="panel panel-back noti-box">
                         <p class="text-muted">Complaint on Progress</p>
                            <span><img src="assets/img/blue.jpg">
                            <div class="text-box" >
                                <p class="main-text"><?php echo $row['complaintonprogress']; ?></p>
                            </div>
                            </span>
                        </div>
                    </div>
                 </div>
                 <!-- /. ROW  -->     
                 <hr />                     


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


<!--CONTOH Code END-->
 
<?php
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();
//Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen.".pdf" ,'I');
exit;
?>