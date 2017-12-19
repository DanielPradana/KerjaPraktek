<?php

	include ( "src/NexmoMessage.php" );
	if(isset($_GET['idofcomplaintrecord'])&&isset($_GET['status'])){
        $idofcomplaintrecord=$_GET['idofcomplaintrecord'];
        $status=$_GET['status'];
    }
	$nomor=$_POST['nomortujuan'];

	/**
	 * To send a text message.
	 *
	 */

	// Step 1: Declare new NexmoMessage.
	$nexmo_sms = new NexmoMessage('ecf33a18', '126fef72fe6a5788');

	// Step 2: Use sendText( $to, $from, $message ) method to send a message. 
	$info = $nexmo_sms->sendText( $nomor, 'MyApp', 'Status Pengaduan dengan ID '.$idofcomplaintrecord.' '.$status);

	// Step 3: Display an overview of the message
	echo $nexmo_sms->displayOverview($info);

	// Done!
	

?>