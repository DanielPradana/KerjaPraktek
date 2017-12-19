<?php
include('session.php');
require_once("database.php");
if(isset($_GET['idofcomplaintrecord'])&isset($_GET['uid'])&isset($_GET['totalhari'])){
    $idofcomplaintrecord=$_GET['idofcomplaintrecord'];
    $uid=$_GET['uid'];
    $totalhari=$_GET['totalhari'];
}
	$status = "selesai";
	$hitung = 0;
	$tahun = date("Y");
	$bulan = date("m");
	$nowdate = date("Y-m-d");
    $sqldata = "SELECT * FROM report where userid='$uid' AND tahun='$tahun' AND bulan='$bulan'";
    $resultdata = mysqli_query($db,$sqldata);
    while($rowdata=mysqli_fetch_array($resultdata)){
    	$complaintfinished=$rowdata['complaintfinished']+1;
    	$complaintonprogress=$rowdata['complaintonprogress'];
    	$hitung++;
    }
	if ($hitung>0) {
		update_finished($complaintfinished, $uid, $bulan, $tahun);
		update_complaintstatus($idofcomplaintrecord, $status, $nowdate, $totalhari);
	    if($complaintonprogress==null||$complaintonprogress==0){
	    	$bulan-=1;
	    	$sql1 = "SELECT * FROM report where userid='$uid' AND tahun='$tahun' AND bulan='$bulan'";
    		$resultonprogress = mysqli_query($db,$sql1);
    		$rowdataonprogress=mysqli_fetch_array($resultonprogress);
    		if ($rowdataonprogress['complaintonprogress']==null||$rowdataonprogress['complaintonprogress']==0) {
    			$tahun-=0001;
    			$bulan=12;
		    	$sql2 = "SELECT * FROM report where userid='$uid' AND tahun='$tahun' AND bulan='$bulan'";
	    		$resultonprogress2 = mysqli_query($db,$sql2);
	    		$rowdataonprogress2=mysqli_fetch_array($resultonprogress2);
	    		$complaintonprogress1=$rowdataonprogress2['complaintonprogress']-1;
	    		update_onprogress($complaintonprogress1, $uid, $bulan, $tahun);
    		}
    		else{
    			$complaintonprogress1=$rowdataonprogress['complaintonprogress']-1;
    			update_onprogress($complaintonprogress1, $uid, $bulan, $tahun);
    		}
	    }
	    else{
	    	$complaintonprogress-=1;
	    	update_onprogress($complaintonprogress, $uid, $bulan, $tahun);
	    }
	}
	else{
		tambah_complaintfinished($complaintfinished, $tahun, $bulan, $uid);
		update_complaintstatus($idofcomplaintrecord, $status, $nowdate, $totalhari);
	    if($complaintonprogress==null||$complaintonprogress==0){
	    	$bulan-=1;
	    	$sql1 = "SELECT * FROM report where userid='$uid' AND tahun='$tahun' AND bulan='$bulan'";
    		$resultonprogress = mysqli_query($db,$sql1);
    		$rowdataonprogress=mysqli_fetch_array($resultonprogress);
    		if ($rowdataonprogress['complaintonprogress']==null||$rowdataonprogress['complaintonprogress']==0) {
    			$tahun-=0001;
    			$bulan=12;
		    	$sql2 = "SELECT * FROM report where userid='$uid' AND tahun='$tahun' AND bulan='$bulan'";
	    		$resultonprogress2 = mysqli_query($db,$sql2);
	    		$rowdataonprogress2=mysqli_fetch_array($resultonprogress2);
	    		$complaintonprogress1=$rowdataonprogress2['complaintonprogress']-1;
	    		update_onprogress($complaintonprogress1, $uid, $bulan, $tahun);
    		}
    		else{
    			$complaintonprogress1=$rowdataonprogress['complaintonprogress']-1;
    			update_onprogress($complaintonprogress1, $uid, $bulan, $tahun);
    		}
	    }
	    else{
	    	$complaintonprogress-=1;
	    	update_onprogress($complaintonprogress, $uid, $bulan, $tahun);
	    }
	}

    
    header("Location: listcomplaint.php");

?>