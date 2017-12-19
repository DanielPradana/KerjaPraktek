<?php
//include database configuration file
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
   }

//get records from database
if ($tanggalawal==null&&$tanggalakhir==null&&$petugas==null&&$complainttype==null) {
    $sqllist = "SELECT * FROM user INNER JOIN complaint ON iduser = userid";
}
else{
    $sqllist = "SELECT * FROM user INNER JOIN complaint ON iduser = userid WHERE complaintrecord>='$tanggalawal' AND complaintrecord<='$tanggalakhir' AND userid='$petugas' AND complainttype='$complainttype'";
}

    $resultlist = mysqli_query($db,$sqllist);

    $delimiter = ",";
    $filename = "printreport.csv";
    
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    //set column headers
    $fields = array('No', 'Petugas', 'Sumber Pengaduan', 'Tanggal Pengaduan', 'Tanggal Catat', 'Media Pengaduan', 'Pengaduan', 'Status', 'Proses(Hari)');
    fputcsv($f, $fields, $delimiter);
    
    //output each row of the data, format line as csv and write to file pointer
    $numb = 1;
    while($rowlist = mysqli_fetch_array($resultlist)){
        $day1 = $rowlist["complaintrecord"];
        $day2 = date("Y-m-d");
        $sqlhari="SELECT TIMESTAMPDIFF(DAY, '$day1', '$day2') as 'totalhari'";
        $resulthari = mysqli_query($db,$sqlhari);
        $totalhari = mysqli_fetch_array($resulthari);
        $hari = $totalhari["totalhari"];
        $lineData = array($numb, $rowlist["username"], $rowlist["divisi"], $rowlist["complaintdate"], $rowlist["complaintrecord"], $rowlist["complaintmedia"], $rowlist["complainttitle"], $rowlist["status"], $hari);
        fputcsv($f, $lineData, $delimiter);
        $numb++;
    }
    
    //move back to beginning of file
    fseek($f, 0);
    
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    //output all remaining data on a file pointer
    fpassthru($f);

exit;

?>