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

   <script src="assets/js1/Chart.bundle.js"></script>

    <style>
    </style>
</head>
<body>
<?php 
    $uid = $_SESSION['iduser'];
    $sql = "SELECT * FROM user WHERE iduser = '$uid'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result);
?>
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
                        <a   href="listcomplaint.php"><i class="fa fa-list fa-2x"></i> List Complaint</a>
                    </li>   
                    <li  >
                        <a  href="printreport.php"><i class="fa fa-print fa-2x"></i> Print Report</a>
                    </li>
                    <li  >
                        <a class="active-menu" href="profile.php"><i class="fa fa-chain fa-2x"></i> Profile Setting</a>
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
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Profile
                        </div>
                        <div class="panel-body">
                            <div class="col-md-6 text-center">
                                <?php
                        $imageprofile=$rowuser['image'];
                        if($imageprofile==null){
                            echo '<img src="assets/img/find_user.png" class="user-image img-responsive"/>';
                        }
                        else{
                            echo '<img src="assets/img/user/profile/'.$_SESSION["iduser"].'/'.$imageprofile.'" class="user-image img-responsive img-profile-position"/>';
                        }
                        ?>  
                                <br>
                                <div class="text-left">
                                    <form method="POST" action="replaceimage.php" enctype="multipart/form-data">
                                    <input  name="image" type="file" name="foto" id="foto"><br>
                                    <button type="submit" name="submit" class="btn btn-primary">Replace</button>
                                    </form>    
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                            <form role="form">
                                            <fieldset disabled="disabled">
                                                <div class="form-group">
                                                   <label for="disabledSelect">User ID</label>
                                                  <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $row['iduser']; ?>" disabled /> 
                                                </div>
                                                <div class="form-group">
                                                   <label for="disabledSelect">Username</label>
                                                  <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $row['username']; ?>" disabled />
                                                </div>
                                                <div class="form-group">
                                                   <label for="disabledSelect">Divisi Unit Kerja</label>
                                                  <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $row['divisi']; ?>" disabled />
                                                </div>
                                                <div class="form-group">
                                                   <label for="disabledSelect">Jabatan</label>
                                                  <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $row['jabatan']; ?>" disabled />
                                                </div>
                                            </fieldset>
                                        </form>
                            </div>
                        </div>
                    </div>  

                    <div class="col-md-6 col-sm-12 col-xs-12"> 
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            Detail User
                            </div>
                        <div class="panel-body">
                        <form method="POST" action="updateuserdata.php" enctype="multipart/form-data">
                            <div class="form-group">
                            <label>Username</label>
                            <input class="form-control" name="username" placeholder="<?php echo $row['username']; ?>" />
                            </div>  

                            <div class="form-group">
                            <label>Divisi Unit Kerja</label>
                            <input class="form-control" name="divisi" placeholder="<?php echo $row['divisi']; ?>" />
                            </div> 

                            <div class="form-group">
                            <label>Jabatan</label>
                            <input class="form-control" name="jabatan" placeholder="<?php echo $row['jabatan']; ?>" />
                            </div>
                            <div class="col-md-6"><button type="submit" onclick="return confirmation()" name="submit" class="btn btn-primary">Update Data</button></div>   
                        </form>
                        </div>
                        </div>    
                    
                    </div>

                    <div class="col-md-6 col-sm-12 col-xs-12"> 
                    <script type="text/javascript">
                        var check = function() {
                              if (document.getElementById('password').value ==
                                document.getElementById('confirm_password').value) {
                                document.getElementById('message').style.color = 'green';
                                document.getElementById('message').innerHTML = 'matching';
                              } else {
                                document.getElementById('message').style.color = 'red';
                                document.getElementById('message').innerHTML = 'not matching';
                              }
                        }
                    </script>
                    <form method="POST" action="changepassword.php" enctype="multipart/form-data">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            Change Password
                            </div>
                        <div class="panel-body">
                            <div class="form-group">
                            <label>Type Your Old Password <span id="errorOldpass"></span></label>
                            <input name="old_password" id="old_password" type="Password" class="form-control"/>
                            </div>

                            <div class="form-group">
                            <label>Type Your New Password</label>
                            <input name="password" id="password" type="Password" onkeyup='check();' class="form-control"/>
                            </div>  

                            <div class="form-group">
                            <label>Re-Type Your New Password</label>
                            <input name="confirm_password" id="confirm_password" type="Password" onkeyup='check();' class="form-control"/>
                            </div> 
                            
                            <div class="col-md-6"><button type="submit" name="submit" class="btn btn-primary">Change</button>&nbsp<span id='message'></span></div>
                        </div>
                        </div>    
                    </form>
                    </div>

                </div>
                 <!-- /. ROW  -->
                 <hr />
               
            </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    <script type="text/javascript" src="js/customjs.js"></script>
    <script type="text/javascript" src="assets/js1/customjs.js"></script>
</body>
</html>
