<?php
   session_start();
   $uid = null;
   
   if(isset($_GET['uid'])){
   	$uid = $_GET['uid'];	
   
   }

   if($uid != null){
	   	session_destroy(); 
		header("Location: login.php?uid=$uid");	
	   }
	   else{
		session_destroy(); 
		header("Location: login.php");	
	   }
   
?>