	<!DOCTYPE html>
	<html lang="en">
	<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Vel Tech - Ticket Generation System</title>
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="../assets/css/jquery-ui.css">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" href="../vendor/jquery-validation/demo/css/screen.css"/>
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">
    <!-- Custom CSS -->
    <!-- Custom Fonts -->
     <link rel="stylesheet" href="../vendor/multiple-select-master/multiple-select.css" />
    <!-- jQuery -->
    <link rel="stylesheet" type="text/css" href="../vendor/datetimepicker-master/jquery.datetimepicker.css"/>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- jQuery Validation -->
    <script src="../vendor/jquery-validation/dist/jquery.validate.js"></script>
    <script src="../vendor/jquery-validation/dist/additional-methods.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <script src="../vendor1/datatables/jquery.dataTables.js"></script>
    <script src="../vendor1/datatables/dataTables.bootstrap4.js"></script>
    <script type="text/javascript">
        function logout(){
            $.ajax({
                url : '../config/logout.php',
                type : 'post',
                success : function(res){
                    if(res=='true'){
                        window.location = '../';
                    }
                }
            });
        }
        function check_login(){
            $.ajax({
                url : '../config/check_login.php',
                type : 'post',
                success : function(res){
                    if(res=='true'){
                        window.location = '../';
                    }
                }
            });
        }
        $(document).ready(function(){
            $(".rotate").click(function(){
               $(this).toggleClass("down")  ; 
           });
        });
        //setInterval(function(){check_login();},300);
    </script>
</head>
<?php
session_start();
?>
    <body>
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom:0; background-color:#c9503d;">
                <div class="navbar-header navigation-top-bar col-md-12" style="padding:0;">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="clearfix"></div>
                    <div class="col-md-2" style="padding:0;">
                        <a class="navbar-brand" href="../" style="padding:3px 10px;"><img src="../assets/images/vel-tech.jpg" style="padding-top:0px;height:50px;">  <!-- <img src="../assets/images/logo.png" style="padding-top:0px"> --></a>
                        <div  style="font-size:28px;color:#cc1212;line-height:1.5"><i id="hidShowPan" style="cursor:pointer;vertical-align:bottom;" class="fa fa-arrows-alt rotate"></i></div>
                    </div>
                    <div class="col-md-6 navbar-brand" style="padding:0;text-align: right;margin-top:-10px;">
                    <h2 style="color:white;">VEL TECH - TICKET GENERATION SYSTEM</h2>
                        <!-- <a class="navbar-brand"  style="width: 100%;"> <img style="text-align:center;padding-left:320px !important;" src="../assets/images/Logo_78x40.png"> </a> -->
                    </div> 
                    <ul class="nav navbar-top-links navbar-right">
                        <img src="../assets/images/logo.png" style="padding-top:0px;height:50px;"> 
                        <span style="color: white;font-weight: bold"><?php echo ($_SESSION['username'])?$_SESSION['username']:''; ?></span>
                        <li class="dropdown" >
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="background-color: #cc1212;">
                                <i class="fa fa-user fa-fw" style="vertical-align:bottom;Padding-top:10px;"></i> <i class="fa fa-caret-down" style="vertical-align:bottom;Padding-top:10px;color:white;"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="javascript:void(0);" onclick="loadData('Users/userProfileList.php');"><i class="fa fa-user fa-fw"></i> User Profile</a>
                                </li>
                              <!--    <li><a href="javascript:void(0);"><i class="fa fa-gear fa-fw"></i> Settings</a>-->
                                </li>
                                <li class="divider"></li>
                                <li><a href="javascript:void(0);" onclick="logout();"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                                </li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <span style="padding-right:20px;"><!-- <img src="../assets/images/phc-new.jpg" style="vertical-align:bottom;Padding-bottom:6px;"> --></span>
                    </ul>
                    <!-- /.dropdown -->
                </div>
                <!-- /.navbar-header -->
                
                <!-- /.navbar-top-links -->
                <?php 
                include "leftPanel.php"; 
                ?>
            </nav>
