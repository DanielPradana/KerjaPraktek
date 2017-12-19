<?php
   include("config.php");
   session_start();
   $uid = null;
   if(isset($_GET['uid'])){
    $uid = $_GET['uid'];
    }  
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myid = mysqli_real_escape_string($db,$_POST['id']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT * FROM user WHERE iduser = '$myid' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $count = mysqli_num_rows($result);
      $row = mysqli_fetch_array($result);
      $myusername=$row['username'];
      // If result matched $myusername and $mypassword, table row must be 1 row
        
      if($count == 1) {
        $_SESSION["iduser"] = $myid;
        $_SESSION["password"] = $mypassword;
        $_SESSION['username'] = $myusername;
        session_regenerate_id(true);
        if (!headers_sent()) header("Location: index.php"); 
         $_SESSION['last_login_timestamp'] = time();
         header("location: index.php");
      }else {
         echo "<script language='javascript'>\n";
         echo "alert('Your Login Name or Password is invalid')";
         echo "</script>\n";
      }
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
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.1/css/font-awesome.css" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Arimo:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    
    <link href='https://fonts.googleapis.com/css?family=Stint+Ultra+Condensed' rel='stylesheet' type='text/css'>
</head>
<body>

 <div class="signform">

   <!-- left side will be in the top at 640px screen-->
<div class="left">
<div class="bts">
 <h1> <strong>DCIS System</strong> </h1>  
    
        <p style="vertical-align: bottom; text-align: center; position: relative;">Direktorat Pelayanan</p>
</div>
</div>
<!-- end left side -->
  
  <!-- right side will be in the bottom at 640px screen-->
<div class="right">

  <div class="panel-heading">
                        <h3 style="margin-left: -15px;"> Login System </h3>  
                            </div>
                            <div class="panel-login">
                                <form role="form" action='' method='POST'>
                                       <br />
                                        <label>ID</label>
                                        <div class="form-group input-group1">
                                     
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input name="id" type="text" class="form-control1" placeholder="Your ID " value="<?php echo $uid ?>" />
                                        </div>
                                        <label>Password</label><br>
                                        <div class="form-group input-group1">
                                        
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input name="password" type="password" class="form-control1"  placeholder="Your Password" />
                                        </div>
                                                                     
                                     <input style="width: 70px;" type = "submit" value = "Login" class="btn btn-primary ">
                                     
                                                                        
                                </form>
                                
                            </div>

</div>
  <!-- end left side -->
</div>

     <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
   
</body>
</html>
