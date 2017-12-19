<?php
   include('session.php');
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

    <script src="assets/js1/Chart.bundle.js"></script>

    <script type="text/javascript" src="assets/js/dropzone.js"></script>
    <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
    <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">

    <!-- <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script> -->
    <script src="//tinymce.cachefly.net/4.3/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
    
    <link rel="stylesheet" type="text/css" href="assets/css/datepicker.css">
    <script type="text/javascript" src="assets/js2/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js2/bootstrap-datepicker.js"></script>
    <style type="text/css">
        
        #datepicker > span:hover{
            cursor: pointer;
        }
    </style>

    
</head>
<body>
    <div id="wrapper">

        <nav class="navbar navbar-default navbar-cls-top navbar-fixed-top" role="navigation" style="margin-bottom: 0;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">BPJSTK DCIS SYSTEM</a> 
            </div>
        </nav>   
                      <!-- /. NAV TOP  -->
            <nav class="navbar-default navbar-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="main-menu">
                    <li class="text-center">
                    <?php
                    $imageprofile=$rowuser['image'];
                        if($imageprofile==null){
                            echo '<img src="assets/img/find_user.png" class="user-image img-responsive"/>';
                        }
                        else{
                            echo '<img src="assets/img/user/profile/'.$_SESSION["iduser"].'/'.$imageprofile.'" class="user-image img-responsive"/>';
                        }
                    ?>  
                        
                        <h4 style="color: yellow; margin-top: -20px;"><?php echo $_SESSION["iduser"]; ?></h4>
                        <p style="color: black; margin-top: -20px;"><?php echo $_SESSION["username"]; ?></p>                       
                    </li>
        
                    
                    <li>
                        <a  href="index.php"><i class="fa fa-dashboard fa-2x"></i> Dashboard</a>
                    </li>
                    <li>
                        <a  href="reportbymonth.php"><i class="fa fa-bar-chart fa-2x"></i> Report by Month</a>
                    </li>
                    <?php
                        if($rowuser['lokasi']=="kapu"){
                            echo '<li>
                        <a class="active-menu" href="recordacomplaint.php"><i class="fa fa-file fa-2x"></i> Record a Complaint</a>
                    </li>';
                        }
                        else{
                            echo '';
                        }
                    ?>
                    
                    <li>
                        <a   href="listcomplaint.php"><i class="fa fa-list fa-2x"></i> List Complaint</a>
                    </li>   
                    <li  >
                        <a  href="printreport.php"><i class="fa fa-print fa-2x"></i> Print Report</a>
                    </li>
                    <li  >
                        <a  href="profile.php"><i class="fa fa-chain fa-2x"></i> Profile Setting</a>
                    </li>
                    <li>
                        <a href="logout.php" onclick="return logout()"><i class="fa fa-sign-out fa-2x"></i>Logout</a> 
                    </li>
                              
                    </ul>
               
            </div>
            
        </nav>
        <!-- /. NAV SIDE  -->
        <?php
            $tanggal=date('YmdHms');
        ?>
        <div id="page-wrapper" >
            <div id="page-inner">
               <div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Detail Complaint Record
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    
                                    <form name="formRecord" method="POST" action="recordacomplaintprocess.php" enctype="multipart/form-data" onsubmit="return validateForm()">
                                        
                                            <label for="disabledSelect">User Input (ID)</label>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon"><i class="fa fa-user" ></i></span>
                                                <input name="userinput" class="form-control" value="<?php echo $_SESSION['username']; ?>" readonly>
                                            </div>
                                            <label for="disabledSelect">ID of Complaint Record</label>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon"><i class="fa fa-tag" ></i></span>
                                                <input name="idcomplaint" class="form-control" value="<?php echo 'DP'.$_SESSION['iduser'].''.$tanggal; ?>" readonly>
                                            </div>
                                        
                                       
                                        <label>User Complaint <span id="errorUser"></span></label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-group" ></i></span>
                                            <input name="usercomplaint" class="form-control"/>
                                        </div>
                                        <label>Number of Complaint Letter <span id="errorNumber"></span></label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope-square" ></i></span>
                                            <input name="numbercomplaint" class="form-control" />
                                        </div>
                                        <label>Complaint Date</label>
                                        
                                        <div id="datepicker" class="form-group input-group date" data-date-format="yyyy-mm-dd">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            <input class="form-control" type="text" name="complaintdate">
                                        </div>
                                        <script type="text/javascript">
                                            $(function(){
                                                $("#datepicker").datepicker({
                                                    autoclose: true,
                                                    todayHighlight: true
                                                }).datepicker('update', new Date());
                                            });
                                        </script>
                                        
                                        <label>Complaint Title <span id="errorComplaint"></span></label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag" ></i></span>
                                            <input name="complainttitle" class="form-control" />
                                        </div>
                                        <label>Complaint Received by : <span id="errorReceived"></label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-inbox" ></i></span> 
                                            <input  class="form-control" type="text" name="complaintreceived" id="autocomplete-dynamic" style="width: 100%; border-width: 1px;"/>
                                        </div>
                                        <p class="help-block" style="margin-top: -20px;"><i>Ketikan 2 huruf misalnya ja'</i></p>
                                        <label>Complaint Media</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-share-alt" ></i></span>
                                            <select name="complaintmedia" class="form-control">
                                                <option value="Mobile Phone (Voice Call)">Mobile Phone (Voice Call)</option>
                                                <option value="Mobile Phone (Text Message)">Mobile Phone (Text Message)</option>
                                                <option value="Social Network (Path)">Social Network (Path)</option>
                                                <option value="Website BPJSTK">Website BPJSTK</option>
                                                <option value="coorperate Email">coorperate Email</option>
                                                <option value="Call Center 1500910">Call Center 1500910</option>
                                                <option value="Office Call 021-520 7797">Office Call 021-520 7797</option>
                                                <option value="Media Forum Online (SINDO News)">Media Forum Online (SINDO News)</option>
                                                <option value="Media Forum Online (Kaskus)">Media Forum Online (Kaskus)</option>
                                                <option value="Customer Care (Kantor Pusat)">Customer Care (Kantor Pusat)</option>
                                                <option value="Surat Langsung Kantor Pusat">Surat Langsung Kantor Pusat</option>
                                                <option value="MEDIA CETAK (KORAN, TABLOID, MAJALAH)">MEDIA CETAK (KORAN, TABLOID, MAJALAH)</option>
                                                <option value="Social Network (Whatsapp)">Social Network (Whatsapp)</option>
                                                <option value="Social Network (Instagram)">Social Network (Instagram)</option>
                                                <option value="Social Network (Facebook)">Social Network (Facebook)</option>
                                                <option value="Social Network (Twitter)">Social Network (Twitter)</option>
                                                <option value="Social Network (G+ Google Plus)">Social Network (G+ Google Plus)</option>
                                                <option value="Social Network (Youtube)">Social Network (Youtube)</option>
                                                <option value="Social Network (Line)">Social Network (Line)</option>
                                                <option value="Social Network (BBM Blackberry Messenger)">Social Network (BBM Blackberry Messenger)</option>
                                            </select>
                                        </div>
                                        <label>Complaint Type</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tasks" ></i></span>
                                            <select name="complainttype" class="form-control">
                                                <option value="JP1.Permintaan Informasi (INQUIRY)">JP1.Permintaan Informasi (INQUIRY)</option>
                                                <option value="JP2.Permintaan (REQUEST)">JP2.Permintaan (REQUEST)</option>
                                                <option value="JP3.Kritik dan Saran (Voice of Customer)">JP3.Kritik dan Saran (Voice of Customer)</option>
                                                <option value="JP4.Pengaduan Ringan (Voice of Customer)">JP4.Pengaduan Ringan (Voice of Customer)</option>
                                                <option value="JP5.Pengaduan Serius (Voice of Customer)">JP5.Pengaduan Serius (Voice of Customer)</option>
                                            </select>
                                        </div>    
                                    <br />                      
                                </div>
                                
                                <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Complaint Information <span id="errorInformation"></label>
                                            <textarea name="complaintinformation" cols="100" rows="15"></textarea>  
                                        </div>
                                        <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Image Upload</label>
                                                <input id="img-input" onchange="imgTypeValidation()" name="image" type="file" class="dropzone" accept="image/jpeg, image/png, application/pdf" />
                                                <p style="margin-top: -10px;" class="help-block"><i>(png, jpg, jpeg, pdf)</i></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Video Upload</label>
                                                <input id="vid-input" onchange="vidTypeValidation()" name="video" type="file" class="dropzone" accept="video/*, audio/*" />
                                                <p style="margin-top: -10px;" class="help-block"><i>video [avi, mpeg4, flash, mp4] audio [mp3, wav]</i></p>
                                            </div>
                                        </div>
                                        </div>
                                        <script>
                        
                                            function imgTypeValidation() {
                                                var fileType = document.getElementById('img-input').files[0].type;
                                                if (fileType === "image/png" || fileType === "image/jpg" || fileType === "image/bmp" || fileType === "image/jpeg" || fileType === "application/pdf") {
                                                }
                                                else {
                                                document.getElementById('img-input').value = "";
                                                  alert("format file tidak valid!");
                                                  
                                                }
                                            }

                                            function vidTypeValidation() {
                                                var fileType = document.getElementById('vid-input').files[0].type;
                                                fileType = fileType.substring(0, 6);
                                                var accept = "video/"
                                                if (fileType === accept) {
                                                }
                                                else {
                                                document.getElementById('vid-input').value = "";
                                                  alert("format file tidak valid!");
                                                }
                                            }
                                        </script>
                                    
                                </div>
                                    <button style="margin-left: 3px; margin-right: 5px;" type="reset" class="btn btn-default pull-right">Cancel</button>
                                    <button type="submit" class="btn btn-primary pull-right"">Record Complaint</button>
                                </form>    
                            </div>
                        </div>
                    </div>
                     <!-- End Form Elements -->
                </div>
            </div>
                <!-- /. ROW  -->

    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
    <!-- <script type="text/javascript" src="assets/js2/jquery-1.8.2.min.js"></script> -->
    <script type="text/javascript" src="assets/js2/jquery.mockjax.js"></script>
    <script type="text/javascript" src="assets/js2/jquery.autocomplete.js"></script>
    <script type="text/javascript" src="assets/js2/countries.js"></script>
    <script type="text/javascript" src="assets/js2/demo.js"></script>
    <script type="text/javascript" src="assets/js1/customjs.js"></script>

</body>
</html>
