<?php
	include('session.php');
	require_once("database.php");
	
	$idcomplaint = $_POST['idcomplaint'];
	$usercomplaint = $_POST['usercomplaint'];
	$numbercomplaint = $_POST['numbercomplaint'];
	$complaintdate = $_POST['complaintdate'];
	$complaintrecord = date('Y-m-d');
	$complainttitle = $_POST['complainttitle'];
	$complaintreceived = $_POST['complaintreceived'];
	$complaintmedia = $_POST['complaintmedia'];
	$complainttype = $_POST['complainttype'];
	$complaintinformation = $_POST['complaintinformation'];
	$uid = $_SESSION['iduser'];
	
	$dirimage = "assets/img/user/images/".$idcomplaint."/";
	if(!is_dir($dirimage)){
		mkdir($dirimage,"0777",true);
		$filenameimage=$_FILES['image']['name'];
		move_uploaded_file($_FILES["image"]["tmp_name"], $dirimage."".$filenameimage);
	}
	else{
		$filenameimage=$_FILES['image']['name'];
		move_uploaded_file($_FILES["image"]["tmp_name"], $dirimage."".$filenameimage);
	}
		
	$dirvideo = "assets/img/user/video/".$idcomplaint."/";
	if(!is_dir($dirvideo)){
		mkdir($dirvideo,"0777",true);
		$filenamevideo=$_FILES['video']['name'];
		move_uploaded_file($_FILES["video"]["tmp_name"], $dirvideo."".$filenamevideo);
	}
	else{
		$filenamevideo=$_FILES['video']['name'];
		move_uploaded_file($_FILES["video"]["tmp_name"], $dirvideo."".$filenamevideo);
	}

	if($usercomplaint==null||$numbercomplaint==null||$complainttitle==null||$complaintinformation==null){
		header("Location: listcomplaint1.php?idofcomplaintrecord=$idcomplaint");
	}
	else{
		$sql2 = "SELECT * FROM complaint WHERE idofcomplaintrecord = '$idcomplaint'";
	    $result2 = mysqli_query($db,$sql2);
	    $row2 = mysqli_fetch_array($result2);
		if ($filenameimage==null) {
			$filenameimage=$row2['photo'];
		}
		else{
			$filenameimage=$filenameimage;
		}
		if ($filenamevideo==null) {
			$filenamevideo=$row2['video'];
		}
		else{
			$filenamevideo=$filenamevideo;
		}
		

	edit_record($idcomplaint, $usercomplaint, $numbercomplaint, $complaintdate, $complaintrecord, $complainttitle, $complaintreceived, $complaintmedia, $complainttype, $complaintinformation, $filenameimage, $filenamevideo);
	header("Location: listcomplaint1.php?idofcomplaintrecord=$idcomplaint");
	}
?>