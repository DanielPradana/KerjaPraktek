<?php
	include('session.php');
	require_once("database.php");
   if(isset($_GET['idofcomplaintrecord'])){
        $idofcomplaintrecord=$_GET['idofcomplaintrecord'];
    }
    $sqldata = "SELECT * FROM complaint where idofcomplaintrecord='$idofcomplaintrecord'";
    $resultdata = mysqli_query($db,$sqldata);
    $rowdata = mysqli_fetch_array($resultdata);
    $count=$rowdata['opencount']+1;          
    updatecount($idofcomplaintrecord, $count);
    header("Location: listcomplaint1.php?idofcomplaintrecord=$idofcomplaintrecord");
?>