<?php
include('config.php');
$data="";
            $sql4 = "SELECT * FROM complaint";
                    $result4 = mysqli_query($db,$sql4);
                    $countz = mysqli_num_rows($result4);
                    while($row4 = mysqli_fetch_array($result4)){
                    	$data .='
                        <li><div class="alert alert-info">
                        <span style="font-weight: bold;">Complaint Title : </span>
                        <span>'.$row4["complainttitle"].'<br>
                        <span style="font-weight: bold;">Keterangan Penangan : </span>
                        <span>'.$row4["status"].'</span><br>
                        <span style="font-weight: bold;">Complaint Received By : </span>
                        <i style="color: black;" ></i>&nbsp<span>'.$row4["complaintreceivedby"].'</span>
                        </li>';
                    }

                    $con = 3;

                    $data = array(
                      'data'	=> $data,
                      'counting' => $countz, 
                    );

                    echo json_encode($data);
                    
            ?>