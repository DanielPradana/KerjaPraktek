<?php
include('session.php');
require_once("database.php");
	if(isset($_GET['idofcomplaintrecord'])&isset($_GET['uid'])){
        $idofcomplaintrecord=$_GET['idofcomplaintrecord'];
        $uid=$_GET['uid'];
    }
    $hitung = 0;
	$tahun = date("Y");
	$bulan = date("m");
    $sqldata = "SELECT * FROM report where userid='$uid' AND tahun='$tahun' AND bulan='$bulan'";
    $resultdata = mysqli_query($db,$sqldata);
    while($rowdata=mysqli_fetch_array($resultdata)){
    	$complaintdelete=$rowdata['complaintdelete'];
    	$complaintonprogress=$rowdata['complaintonprogress'];
    	$hitung++;
    }
	if ($hitung>0) {
		$complaintdelete+=1;
		update_complaintdelete($complaintdelete, $uid, $bulan, $tahun);
		delete_complaint($idofcomplaintrecord);
	    delete_pengananan_complaint($idofcomplaintrecord);
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
	    		update_onprogress($complaintonprogress1, $uid, $uid, $bulan, $tahun);
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
		$complaintdelete+=1;
		tambah_complaintdelete($complaintdelete, $tahun, $bulan, $uid);
		delete_complaint($idofcomplaintrecord);
	    delete_pengananan_complaint($idofcomplaintrecord);
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
	    		update_onprogress($complaintonprogress1, $uid);
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