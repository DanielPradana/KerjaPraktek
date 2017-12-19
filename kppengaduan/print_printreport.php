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
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BPJS</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

   <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />

   <script src="assets/js1/Chart.bundle.js"></script>

    <link rel="stylesheet" type="text/css" href="assets/css/datepicker.css">
    <script type="text/javascript" src="assets/js2/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js2/bootstrap-datepicker.js"></script>
    <style type="text/css">
        
        #datepicker > span:hover{
            cursor: pointer;
        }
        #datepicker2 > span:hover{
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Hasil Pencarian
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $numb = 1;
                                        if ($tanggalawal==null&&$tanggalakhir==null&&$petugas==null&&$complainttype==null) {
                                            $sqllist = "SELECT * FROM user INNER JOIN complaint ON iduser = userid";
                                        }
                                        else{
                                            $sqllist = "SELECT * FROM user INNER JOIN complaint ON iduser = userid WHERE complaintrecord>='$tanggalawal' AND complaintrecord<='$tanggalakhir' AND userid='$petugas' AND complainttype='$complainttype'";
                                        }
                                        
                                        $resultlist = mysqli_query($db,$sqllist);
                                        while($rowlist = mysqli_fetch_array($resultlist))
                                        {

                                            $day1 = $rowlist["complaintrecord"];
                                            $day2 = date("Y-m-d");
                                            $sqlhari="SELECT TIMESTAMPDIFF(DAY, '$day1', '$day2') as 'totalhari'";
                                            $resulthari = mysqli_query($db,$sqlhari);
                                            $totalhari = mysqli_fetch_array($resulthari);
                                            $hari = $totalhari["totalhari"];
                                            echo '<tr class="gradeA">
                                            <td>'.$numb.'</td>
                                            <td>'.$rowlist["username"].'</td>
                                            <td>'.$rowlist["divisi"].'</td>
                                            <td>'.$rowlist["complaintdate"].'</td>
                                            <td>'.$rowlist["complaintrecord"].'</td>
                                            <td>'.$rowlist["complaintmedia"].'</td>
                                            <td>'.$rowlist["complainttitle"].'</td>
                                            <td style="background-color: #2ecc71; color: white">'.$rowlist["status"].'</td>
                                            <td>'.$hari.'</td>
                                        </tr>';
                                        $numb++;
                                        }
                                    ?>
                                        
                                       
                                        
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <!-- /. ROW  -->
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <!-- <script src="assets/js/jquery-1.10.2.js"></script> -->
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   <script>
        window.load = print_d();
        function print_d(){
            window.print();
        }
    </script>
</body>
</html>