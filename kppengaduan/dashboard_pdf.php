<?php
 // Define relative path from this script to mPDF
 $nama_dokumen='dashboard'; //Beri nama file PDF hasil.
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

<div id="wrapper">


        <div id="page-wrapper" >
            <div id="page-inner">

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
                    
                      
                <div class=" col-sm-12 col-xs-12">                     
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Complaint Accumulation (2017)
                        </div>
                        <div class="panel-body">
                            <?php include("templatepdf.php"); ?>
                        </div>
                    </div>            
                </div>

                
                </div>
                
                
    
                 <!-- /. ROW  -->           
        </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->        
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