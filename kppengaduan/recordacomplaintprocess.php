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
	$status = "onprogress";
	$uid = $_SESSION['iduser'];
	$hitung = 0;
	$tahun = date("Y");
	$bulan = date("m");


	$sqldata = "SELECT * FROM report where userid='$uid' AND tahun='$tahun' AND bulan='$bulan'";
    $resultdata = mysqli_query($db,$sqldata);
    while($rowdata=mysqli_fetch_array($resultdata)){
    	$complaintonprogress=$rowdata['complaintonprogress'];
    	$hitung++;
    }

	
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
		header("Location: recordacomplaint.php");
	}
	else{
	
		if ($hitung>0) {
			$complaintonprogress+=1;
			update_onprogress($complaintonprogress, $uid, $bulan, $tahun);
			add_record($uid, $idcomplaint, $usercomplaint, $numbercomplaint, $complaintdate, $complaintrecord, $complainttitle, $complaintreceived, $complaintmedia, $complainttype, $complaintinformation, $filenameimage, $filenamevideo, $status);
		}
		else{
			$complaintonprogress+=1;
			tambah_onprogress($complaintonprogress, $tahun, $bulan, $uid);
			add_record($uid, $idcomplaint, $usercomplaint, $numbercomplaint, $complaintdate, $complaintrecord, $complainttitle, $complaintreceived, $complaintmedia, $complainttype, $complaintinformation, $filenameimage, $filenamevideo, $status);
		}
	}
	header("Location: recordacomplaint.php");
	
?>