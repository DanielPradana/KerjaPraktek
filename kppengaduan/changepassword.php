<?php
include('session.php');
require_once("database.php");

$uid = $_SESSION['iduser'];
$oldpassword = $_POST['old_password'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if($password!=$confirm_password){
	echo "<SCRIPT type='text/javascript'>
        alert('Password Cannot be Change!');
        window.location.replace(\"profile.php\");
    	</SCRIPT>";
	
}
else if (!cek_oldPassword($uid, $oldpassword)){
	echo "<SCRIPT type='text/javascript'>
        alert('Old Password Wrong!');
        window.location.replace(\"profile.php\");
    	</SCRIPT>";
}

else{
	change_password($uid, $password);
	header("Location: profile.php");
}
	
?>