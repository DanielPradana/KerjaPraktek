<?php
include('session.php');
	require_once("database.php");
	$uid = $_SESSION['iduser'];
	$username = $_POST['username'];
	$divisi = $_POST['divisi'];
	$jabatan = $_POST['jabatan'];	
	update_datauser($uid, $username, $divisi, $jabatan);
	header("Location: logout.php");
?>