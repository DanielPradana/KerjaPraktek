<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['username'];
   
   $ses_sql = mysqli_query($db,"select * from user where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   
   if(!isset($_SESSION['username'])){
      header("location:login.php");
   }
   else{
   	if((time() - $_SESSION['last_login_timestamp']) > 900) // 900 = 15 * 60  
           {  
                header("location:logout.php");  
           }  
           else  
           {  
                $_SESSION['last_login_timestamp'] = time();    
           }  
   }
   $uid1 = $_SESSION['iduser'];
    $sqluser = "SELECT * FROM user WHERE iduser = '$uid1'";
    $resultuser = mysqli_query($db,$sqluser);
    $rowuser = mysqli_fetch_array($resultuser);
?>