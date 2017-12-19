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

   <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />

   <script src="assets/js1/Chart.bundle.js"></script>

    <style>
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
                        <a  class="active-menu" href="listcomplaint.php"><i class="fa fa-list fa-2x"></i> List Complaint</a>
                    </li>   
                    <li  >
                        <a href="printreport.php"><i class="fa fa-print fa-2x"></i> Print Report</a>
                    </li>
                    <li  >
                        <a href="profile.php"><i class="fa fa-chain fa-2x"></i> Profile Setting</a>
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
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             List of Complaint
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>User</th>
                                            <th>Complaint Received</th>
                                            <th>Complaint ID</th>
                                            <th>Complaint Date</th>
                                            <th>Complaint Record</th>
                                            <th>Complaint Media</th>
                                            <th>Complaint About</th>
                                            <th>Number of Complaint Letter</th>
                                            <th>Status</th>
                                            <th>Progress</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $numb = 1;
                                        $sqllist = "SELECT * FROM user INNER JOIN complaint ON iduser = userid";
                                        $resultlist = mysqli_query($db,$sqllist);
                                        while($rowlist = mysqli_fetch_array($resultlist))
                                        {

                                            $day1 = $rowlist["complaintrecord"];
                                            $day2 = date("Y-m-d");
                                            $sqlhari="SELECT TIMESTAMPDIFF(DAY, '$day1', '$day2') as 'totalhari'";
                                            $resulthari = mysqli_query($db,$sqlhari);
                                            $totalhari = mysqli_fetch_array($resulthari);
                                            $hari = $totalhari["totalhari"];
                                            echo '<tr class="gradeA">
                                            <td>'.$numb.'</td>
                                            <td>'.$rowlist["username"].'</td>
                                            <td><a href="opencount.php?idofcomplaintrecord='.$rowlist["idofcomplaintrecord"].'">'.$rowlist["idofcomplaintrecord"].'</a></td>
                                            <td>'.$rowlist["divisi"].'</td>
                                            <td>'.$rowlist["complaintdate"].'</td>
                                            <td>'.$rowlist["complaintrecord"].'</td>
                                            <td>'.$rowlist["complaintmedia"].'</td>
                                            <td>'.$rowlist["complainttitle"].'</td>
                                            <td>'.$rowlist["numberofcomplaintrecord"].'</td>';
                                            if($rowlist["status"]=="onprogress"){
                                                echo '<td style="background-color: #cadf31; color: white">'.$rowlist["status"].'</td>';
                                            }
                                            else{
                                                echo '<td style="background-color: #2ecc71; color: white">'.$rowlist["status"].'</td>';
                                            }
                                            echo '<td>'.$hari.'</td>
                                                </tr>';
                       
                                        $numb++;
                                        }
                                    ?>
                                        
                                              
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <!-- /. ROW  -->



        </div>
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
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
