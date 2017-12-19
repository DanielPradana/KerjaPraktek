<?php  
include('session.php');
$tanggalawal=null;
$tanggalakhir=null;
$petugas=null;
$complainttype=null;
if(isset($_GET['tanggalawal'])&&isset($_GET['tanggalakhir'])&&isset($_GET['petugas'])&&isset($_GET['complainttype'])){
$tanggalawal = $_GET['tanggalawal'];
$tanggalakhir = $_GET['tanggalakhir'];
$petugas = $_GET['petugas'];
$complainttype = $_GET['complainttype'];


$numb = 1;
$output = '';
if ($tanggalawal==null&&$tanggalakhir==null&&$petugas==null&&$complainttype==null) {
    $sqllist = "SELECT * FROM user INNER JOIN complaint ON iduser = userid";
}
else{
    $sqllist = "SELECT * FROM user INNER JOIN complaint ON iduser = userid WHERE complaintrecord>='$tanggalawal' AND complaintrecord<='$tanggalakhir' AND userid='$petugas' AND complainttype='$complainttype'";
}
$resultlist = mysqli_query($db,$sqllist);
                                        
 if(mysqli_num_rows($resultlist) > 0)
 {
  $output .= '
   <table class="table" border=1>  
                    <tr>  
                        <th>No</th>
                        <th>Petugas</th>
                        <th>Sumber Pengaduan</th>
                        <th>Tanggal Pengaduan</th>
                        <th>Tanggal Catat</th>
                        <th>Media Pengaduan</th>
                        <th>Pengaduan</th>
                        <th>Status</th>
                        <th>Proses(Hari)</th> 
                    </tr>';
  while($rowlist = mysqli_fetch_array($resultlist))
  {
  	$day1 = $rowlist["complaintrecord"];
    $day2 = date("Y-m-d");
    $sqlhari="SELECT TIMESTAMPDIFF(DAY, '$day1', '$day2') as 'totalhari'";
    $resulthari = mysqli_query($db,$sqlhari);
    $totalhari = mysqli_fetch_array($resulthari);
    $hari = $totalhari["totalhari"];
   $output .= '
    	<tr>  
            <td>'.$numb.'</td>
            <td>'.$rowlist["username"].'</td>
            <td>'.$rowlist["divisi"].'</td>
            <td>'.$rowlist["complaintdate"].'</td>
            <td>'.$rowlist["complaintrecord"].'</td>
            <td>'.$rowlist["complaintmedia"].'</td>
            <td>'.$rowlist["complainttitle"].'</td>
            <td style="background-color: #2ecc71; color: white">'.$rowlist["status"].'</td>
            <td>'.$hari.'</td>
        </tr>
   ';
   $numb++;
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
 }
}
?>