<?php
   include('session.php');
   if(isset($_GET['idofcomplaintrecord'])){
        $idofcomplaintrecord=$_GET['idofcomplaintrecord'];
    }
    $sqlproses = "SELECT * FROM tindakanpenanganan INNER JOIN user ON userid = iduser where idofcomplaintrecord='$idofcomplaintrecord'";
    $resultproses = mysqli_query($db,$sqlproses);
    $resulttimeline = mysqli_query($db,$sqlproses);
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

    <link rel="stylesheet" type="text/css" href="assets/css/datepicker.css">
    <script type="text/javascript" src="assets/js2/jquery.min.js"></script>

    <script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/149125/pdf.combined.js'></script>
   <script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0/angular.min.js'></script> 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="assets/js1/pagination.js"></script>
    <script>
    $(document).ready(function()
     {
       $("#tab").pagination({
       items: 3,
       contents: 'contents',
       previous: 'Previous',
       next: 'Next',
       position: 'bottom',
       });
    });
    </script>
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
                        <a  href="index.php"><i class="fa fa-dashboard fa-2x"></i> Dashboard</a>
                    </li>
                     <li>
                        <a  href="reportbymonth.php"><i class="fa fa-bar-chart fa-2x"></i> Report by Month</a>
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
                        <a  class="active-menu"  href="listcomplaint.php"><i class="fa fa-list fa-2x"></i> List Complaint</a>
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

              <div class="row">
                <div class="col-md-4">
                  <!--   Kitchen Sink -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List Proses Pengaduan
                        </div>
                        <div class="panel-body">
                            <div class="contents">
                        <?php

                            while($rowproses = mysqli_fetch_array($resultproses))
                                {
                                  $day1 = $rowproses["tanggal"];
                                  $day2 = date("Y-m-d");
                                  $sqlhari="SELECT TIMESTAMPDIFF(DAY, '$day1', '$day2') as 'totalhari'";
                                  $resulthari = mysqli_query($db,$sqlhari);
                                  $totalhari = mysqli_fetch_array($resulthari);
                                  $hari = $totalhari["totalhari"];
                                    echo '<div class="alert alert-info">
                                <h5><strong>'.$rowproses["username"].' ['.$rowproses["userid"].']</strong></h5>
                                <span class="time">'.$day1.'</span>
                                <span>'.$rowproses["keterangan"].'</span><br><br>
                                <span>Proses Ke : '.$rowproses["tujuan"].' </span>
                                <br>
                                <span class="pull-right">('.$hari.' day)</span>
                                <br>
                            </div>';
                                }
  

                        ?>
                          </div> 
                            
                        </div>
                    </div>
                </div>    
                <div class="col-md-8">

                  <div class="panel panel-default">
                        <div class="panel-heading">
                            Timeline Pengaduan
                        </div>
                        <div class="panel-body">
                          <ul class="timeline">
                              <!-- Item 1 -->
                              <?php
                              $count=1;
                                while($rowtimeline = mysqli_fetch_array($resulttimeline)){
                                    if($count%2==1){
                                        echo '<li>
                                            <div class="direction-r">
                                            <div class="flag-wrapper">
                                                    <span class="flag">Proses Lanjutan '.$count.'</span>
                                                    <span class="time-wrapper"><span class="time">'.$rowtimeline["tanggal"].'</span></span>
                                                </div>
                                            <div class="desc"><span>Proses Ke : '.$rowtimeline["tujuan"].'</span><br><span>Oleh : </span><span>'.$rowtimeline["username"].'</span>
                                             
                                            </div>
                                            </div>

                                        </li>';
                                    } 
                                    else{
                                        echo '<li>
                                            <div class="direction-l">
                                                <div class="flag-wrapper">
                                                    <span class="flag">Proses Lanjutan '.$count.'</span>
                                                    <span class="time-wrapper"><span class="time">'.$rowtimeline["tanggal"].'</span></span>
                                                </div>
                                            <div class="desc"><span>Proses Ke : '.$rowtimeline["tujuan"].'</span><br><span>Oleh : </span><span>'.$rowtimeline["username"].'</span>
                                            </div>
                                            </div>
                                        </li>';
                                    }   
                                    
                                    
                            $count++;

                                }
                              ?>
                            
  
                          </ul>
  
                        </div>
                    </div>

                </div>

              </div>      
               <!-- The Timeline -->


            </div>
          </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->        
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>



</body>
</html>