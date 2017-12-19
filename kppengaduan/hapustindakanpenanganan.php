<?php
include('session.php');
require_once("database.php");
	if(isset($_GET['id'])&&isset($_GET['idofcomplaintrecord'])){
        $idpenanganan=$_GET['id'];
        $idofcomplaintrecord=$_GET['idofcomplaintrecord'];
    }
    delete_penanganan($idpenanganan);
    header("Location: listcomplaint1.php?idofcomplaintrecord=$idofcomplaintrecord");
?>