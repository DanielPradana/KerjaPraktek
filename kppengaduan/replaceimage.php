<?php
include('session.php');
require_once("database.php");

$uid = $_SESSION['iduser'];
$dirimage = "assets/img/user/profile/".$uid."/";
	if(!is_dir($dirimage)){
		mkdir($dirimage,"0777",true);
		$filenameimage=$_FILES['image']['name'];
		move_uploaded_file($_FILES["image"]["tmp_name"], $dirimage."".$filenameimage);
	}
	else{
		$filenameimage=$_FILES['image']['name'];
		move_uploaded_file($_FILES["image"]["tmp_name"], $dirimage."".$filenameimage);
	}

	update_imageprofile($uid, $filenameimage);
	header("Location: profile.php");
?>