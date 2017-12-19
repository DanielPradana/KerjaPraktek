<?php
	include('session.php');
	require_once("database.php");
	if(isset($_GET['idofcomplaintrecord'])){
        $idofcomplaintrecord=$_GET['idofcomplaintrecord'];
    }
	$uid = $_SESSION['iduser'];
	$tujuan = $_POST['lanjutan'];
	$keterangan = $_POST['keterangan'];
	$tanggal = date("Y-m-d");
	if ($tujuan==null||$keterangan==null) {
		header("Location: listcomplaint1.php?idofcomplaintrecord=$idofcomplaintrecord");
	}
	else{
		tindakan_penanganan($uid, $idofcomplaintrecord, $tujuan, $keterangan, $tanggal);
		header("Location: listcomplaint1.php?idofcomplaintrecord=$idofcomplaintrecord");
	}
	
?>