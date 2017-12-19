<?php
   include('session.php');
   if(isset($_GET['idofcomplaintrecord'])){
        $idofcomplaintrecord=$_GET['idofcomplaintrecord'];
    }
    $sqldata = "SELECT * FROM complaint INNER JOIN user ON userid = iduser where idofcomplaintrecord='$idofcomplaintrecord'";
    $resultdata = mysqli_query($db,$sqldata);
    $rowdata = mysqli_fetch_array($resultdata);   
    
    $day1 = $rowdata["complaintrecord"];
    $day2 = date("Y-m-d");
    $sqlhari="SELECT TIMESTAMPDIFF(DAY, '$day1', '$day2') as 'totalhari'";
    $resulthari = mysqli_query($db,$sqlhari);
    $totalhari = mysqli_fetch_array($resulthari);
    $hari = $totalhari["totalhari"];
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
    <script type="text/javascript" src="assets/js2/bootstrap-datepicker.js"></script>
    <script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/149125/pdf.combined.js'></script>
   <script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0/angular.min.js'></script> 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="assets/js1/pagination.js"></script>
    <script>
    $(document).ready(function()
     {
       $("#tab").pagination({
       items: 2,
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
            <br>  
            <?php
                $totalproses=0;
                $sqlproses = "SELECT * FROM tindakanpenanganan INNER JOIN user ON userid = iduser where idofcomplaintrecord='$idofcomplaintrecord'";
                $resultproses = mysqli_query($db,$sqlproses);
                $resultcount = mysqli_query($db,$sqlproses);
                $resultpetugas = mysqli_query($db,$sqlproses);
            ?>
              <div class="row">
                 <div class="col-md-8 col-sm-12 col-xs-12">                     
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Detail Pengaduan
                        </div>
                        <div class="panel-body">
                            <h3><?php echo $rowdata['complainttitle']?></h3>

                            <h4>USER PELAPOR:</h4>
                            <i style="color: black;" class="fa fa-user" ></i>[<?php echo $rowdata['usercomplaint']?>]
                            <h4>DETAIL URAIAN PENGADUAN</h4>
                            <?php echo $rowdata['complaintinformation']?>
                            <br>
                            <?php
                            while($rowcount = mysqli_fetch_array($resultcount))
                            {
                                  $totalproses++;   
                            }
                            echo '<h4>TINDAKAN PENANGANAN PENGADUAN (Terdapat '.$totalproses.' Proses Penanganan)</h4>';
                            echo '<div class="contents">';
                                while($rowproses = mysqli_fetch_array($resultproses))
                                {
                                    
                                    echo '<div class="alert alert-info">
                                    <h5><strong>'.$rowproses["tanggal"].' || '.$rowproses["username"].' ['.$rowproses["userid"].']</strong></h5>
                                    <span style="font-weight: bold;">Keterangan Penangan</span><br>
                                    <span>'.$rowproses["keterangan"].'</span><br><br>
                                    <span style="font-weight: bold;">Penanganan Lanjutan</span><br>
                                    <i style="color: black;" class="fa fa-map-marker" ></i>&nbsp<span>'.$rowproses["tujuan"].'</span>
                                    ';
                                    if ($rowdata['status']=="onprogress") {
                                        echo '<a href="hapustindakanpenanganan.php?id='.$rowproses["idpenanganan"].'&idofcomplaintrecord='.$idofcomplaintrecord.'" class="btn btn-danger pull-right" onclick="return confirmHapusIni()">Hapus Proses Ini</a>';
                                    }
                                    echo '</div>';
                                }
                            echo '</div>';
                            ?>
                            
                            
                        </div>
                    </div>            
                    </div>


                    <div class="col-md-4 col-sm-12 col-xs-12">                       
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tindakan Lanjutan
                        </div>
                        <div class="panel-body text-center">
                        <?php
                            if($rowdata['status']=="onprogress"){
                                if($rowdata['userid']==$_SESSION['iduser']){
                                    echo '<a href="complaintselesai.php?idofcomplaintrecord='.$idofcomplaintrecord.'&uid='.$rowdata['userid'].'&totalhari='.$hari.'" class="btn btn-primary" onclick="return confirmSelesai()">Selesai</a>
                                            <a href="editacomplaint.php?idofcomplaintrecord='.$idofcomplaintrecord.'" class="btn btn-primary " >Edit</a>
                                            <a href="hapuscomplaint.php?idofcomplaintrecord='.$idofcomplaintrecord.'&uid='.$rowdata['userid'].'" class="btn btn-danger " onclick="return confirmHapus()">Hapus</a>';
                                }
                                else{
                                    echo "---";
                                }
                                
                            }
                            else{
                                echo '<span>Pengaduan ini sudah berstatus CLOSED tidak dapat di edit atau proses lagi</span>';
                            }
                        ?>
                        
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Reminder
                        </div>
                        <div class="panel-body">
                        <form method="POST" action="nexmo/example.php?<?php echo 'idofcomplaintrecord='.$idofcomplaintrecord.'&status='.$rowdata["status"];?>" enctype="multipart/form-data">
                            <span>Nomor Tujuan</span>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-phone" ></i></span>
                                <input name="nomortujuan" class="form-control" />
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                        </div>
                    </div>
                    <?php
                        if($rowdata['status']=="onprogress"){
                    
                        echo '<div class="panel panel-default">
                        <div class="panel-heading">
                            Tindakan Lanjutan
                        </div>
                        <div class="panel-body">
                        <form method="POST" action="proseslanjutan.php?idofcomplaintrecord='.$idofcomplaintrecord.'" enctype="multipart/form-data">
                            <span>Proses Dilanjutkan Ke</span>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-inbox" ></i></span> 
                                <input  class="form-control" type="text" name="lanjutan" id="autocomplete-dynamic" style="width: 100%; border-width: 1px;"/>
                            </div>
                            <span><i>Ketikan 2 huruf misalnya ja</i></span><br>
                            <span>Keterangan Lanjutan</span>
                            <div class="form-group input-group">
                            <textarea class="form-control" cols="40" rows="4" name="keterangan"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" onclick="return confirmLanjut()">Lanjut</button>
                        </form>
                        </div>
                    </div>';   

                    
                    }

                    
                    ?>
                                      
                    </div>
              </div>      
               <!-- The Timeline -->
               <div class="row">
                   <div class="col-md-8 col-sm-12 col-xs-12">                     
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Image/PDF Viewer
                        </div>
                        <div class="panel-body">
                        <?php
                        
                        $filegambar=$rowdata['photo'];
                        if ($filegambar==null) {
                            echo "<h4 class='text-center'>--- Tidak ada file tersedia ---</h4>";
                        }
                        else{
                        $info = pathinfo($filegambar);            //mendapatkan isi dari database dan membacanya
                        $exten=$info['extension'];
                            
                        if($exten=="jpg"||$exten=="png"||$exten=="jpeg"){
                            echo '<img src="assets/img/user/images/'.$idofcomplaintrecord.'/'.$filegambar.'" style="width: 100%"> ';
                        }
                        else if($exten=="pdf"){
                            ?>
                            <div ng-app="pdfApp">
                                  <div ng-controller="pdfCtrl">
                                        <pdf-viewer></pdf-viewer>
                                        <a href="" ng-click="viewClaim('assets/img/user/images/<?php echo $idofcomplaintrecord."/".$filegambar?>')">View PDF</a><br><br>
                                        <button ng-click="page('prev')">Prev</button>
                                        <span>{{pageNum}}/{{pageCount}}</span>
                                        <button ng-click="page('next')">Next</button>
                                        <?php include('pdfviewer.php'); ?>
                                  </div>
                            </div> 
                    <?php
                        }
                    }
                        ?>

                          
                        </div>
                    </div>            
                    </div>

                    <div class="col-md-4 col-sm-12 col-xs-12">                    
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Description List
                        </div>
                        <div class="panel-body">
                        <span>Pengaduan Dicatat Oleh</span><br>
                        <i style="color: black;" class="fa fa-pencil-square" ></i>&nbsp<span>ID : <?php echo $rowdata['idofcomplaintrecord']?></span><br>
                        <i style="color: black;" class="fa fa-user" ></i>&nbsp<span>[<?php echo $rowdata['userid']?>] <?php echo $rowdata['username']?></span><br>
                        <i style="color: black;" class="fa fa-flag" ></i>&nbsp<span><?php echo $rowdata['divisi']?></span><br>
                        <i style="color: black;" class="fa fa-clock-o" ></i>&nbsp<span>Tanggal aduan[<?php echo $rowdata['complaintdate']?>]</span><br>
                        <i style="color: black;" class="fa fa-pencil-square" ></i>&nbsp<span>Tanggal catat[<?php echo $rowdata['complaintrecord']?>]</span><br>
                        <hr>
                        <i style="color: black;" class="fa fa-pencil-square" ></i>&nbsp<span>Di buka sebanyak [ <?php echo $rowdata['opencount']?> ] kali</span><br>
                        <i style="color: black;" class="fa fa-pencil-square" ></i>&nbsp<span>Tindak Lanjutan <?php echo $totalproses?> kali</span><br>
                        <hr>
                        <?php
                        $rowpetugas = mysqli_fetch_array($resultpetugas);
                            if ($rowpetugas['userid']==$_SESSION['iduser']) {
                                echo "<span>Petugas Terlibat Penanganan</span>";
                            }
                            else{
                                echo "<span>Petugas Tidak Terlibat Penanganan</span>";
                            }
                        ?>
                        
                        </div>
                    </div>  
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Status Pengaduan
                        </div>
                        <div class="panel-body text-center">
                        <?php
                            if($rowdata['status']=="onprogress"){
                                echo "<h4>Dalam Proses Penanganan</h4>";
                            }
                            else{
                                echo "<h4>DISELESAIKAN ".$rowdata['datefinished']."</h4>";
                            }
                        ?>
                        </div>
                    </div> 
                    
                    

                    </div>
               </div>

               <div class="row">
                   <div class="col-md-8 col-sm-12 col-xs-12">                     
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Audio/Video Viewer
                        </div>
                        <div class="panel-body">
                        <?php
                            $filevideo=$rowdata['video'];
                        if ($filevideo==null) {
                            echo "<h4 class='text-center'>--- Tidak ada file tersedia ---</h4>";
                        }
                        else{
                            $info1 = pathinfo($filevideo);            //mendapatkan isi dari database dan membacanya
                            $extenvid=$info1['extension'];
  
                            if($extenvid=="mp4"){
                                echo '<video width="100%" controls>
                              <source src="assets/img/user/video/'.$idofcomplaintrecord.'/'.$filevideo.'" type="video/mp4"></video>';
                            }
                            else if($extenvid=="avi"){
                                echo '<video width="100%" controls>
                              <source src="assets/img/user/video/'.$idofcomplaintrecord.'/'.$filevideo.'" type="video/avi">
                              </video>';
                            }
                            else if($extenvid=="mpeg4"){
                                echo '<video width="100%" controls>
                              <source src="assets/img/user/video/'.$idofcomplaintrecord.'/'.$filevideo.'" type="video/mpeg4">
                              </video>';
                            }
                            else if($extenvid=="flash"){
                                echo '<video width="100%" controls>
                              <source src="assets/img/user/video/'.$idofcomplaintrecord.'/'.$filevideo.'" type="video/flash">
                              </video>';
                            }
                            else if($extenvid=="mp3"){
                                echo '<audio controls>
                              <source src="assets/img/user/video/'.$idofcomplaintrecord.'/'.$filevideo.'" type="audio/mpeg">
                            </audio>';
                            }
                            else if($extenvid=="wav"){
                                echo '<audio controls>
                              <source src="assets/img/user/video/'.$idofcomplaintrecord.'/'.$filevideo.'" type="audio/wav">
                            </audio>';
                            }
                        }
                        ?>
                             
                        </div>
                    </div>            
                    </div>

                    <div class="col-md-4 col-sm-12 col-xs-12"> 

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Proses Penyelesaian Pengaduan
                            </div>
                            <div class="panel-body text-center">
                            <?php
                            
                                if($rowdata['status']=="onprogress"){
                                    echo "<h2>".$hari." Hari</h2></br>";
                                    echo "<span>Terhitung sejak ".$rowdata["complaintrecord"];
                                }
                                else{
                                    echo "<h2>".$rowdata['totalhari']." Hari</h2></br>";
                                    echo "<span>Terhitung sejak ".$rowdata["complaintrecord"];
                                }
                            ?>
                            </div>
                        </div> 

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Goto Timeline View
                            </div>
                            <div class="panel-body text-center">
                            <span><a href="listcomplaint2.php?idofcomplaintrecord=<?php echo $idofcomplaintrecord; ?>"><button> Timeline View</button></a></span>
                            </div>
                        </div>
                    </div>

                </div>

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

    <script type="text/javascript" src="assets/js2/jquery.mockjax.js"></script>
    <script type="text/javascript" src="assets/js2/jquery.autocomplete.js"></script>
    <script type="text/javascript" src="assets/js2/countries.js"></script>
    <script type="text/javascript" src="assets/js2/demo.js"></script>
    <script type="text/javascript" src="assets/js1/customjs.js"></script>

</body>
</html>