<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en" >
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CARE::FEEDBACK</title>
    <link rel="icon" href="<?php echo base_url(); ?>assets/images/fav.png">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/angular-material.min.css"> <!-- 1.1.0 --->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/materialize.min.css"  media="screen,projection"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/demo.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/material-dashboard23cd.css?v=1.2.1">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/cardtable.css" media="only screen and (max-device-width: 480px)" >
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.css">
	<link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.rawgit.com/codekraft-studio/angular-page-loader/master/dist/angular-page-loader.css">
	
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/angular.min.js"></script> <!-- 1.5.5 --->
    <script src="<?php echo base_url(); ?>assets/js/angular-ui-router.min.js"></script> <!-- 1.0.0-rc.1 --->
    <script src="<?php echo base_url(); ?>assets/js/angular-animate.min.js"></script> <!-- 1.5.5 --->
    <script src="<?php echo base_url(); ?>assets/js/angular-aria.min.js"></script> <!-- 1.5.5 --->
    <script src="<?php echo base_url(); ?>assets/js/angular-messages.min.js"></script> <!--  1.5.5  -->
    <script src='<?php echo base_url(); ?>assets/js/angular-material.js'></script> <!--  1.5.5  -->
    <script src="<?php echo base_url(); ?>assets/js/angular-cookie.js"></script>

    <!--<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-sanitize.js"></script> -->

    <script src='<?php echo base_url(); ?>assets/js/excelExport/alasql.min.js'></script>
    <script src='<?php echo base_url(); ?>assets/js/excelExport/xlsx.core.min.js'></script>

    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
    <!--<script src="<?php /*echo base_url(); */?>assets/js/material-dashboard23cd.js?v=1.2.1"></script>-->
    <script src="<?php echo base_url(); ?>assets/js/material.min.js" type="text/javascript"></script>
    <!--<script src="http://demos.creative-tim.com/material-dashboard-pro/assets/js/jquery.tagsinput.js"></script>-->
    <script src="<?php echo base_url(); ?>assets/js/progress-bar.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/paging-dist.min.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/codekraft-studio/angular-page-loader/master/dist/angular-page-loader.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/controllers/app.js"></script>
    <script src="<?php echo base_url(); ?>assets/controllers/config.js"></script>
    <script src="<?php echo base_url(); ?>assets/controllers/mainController.js"></script>
    <script src="<?php echo base_url(); ?>assets/controllers/regController.js"></script>
    <script src="<?php echo base_url(); ?>assets/controllers/reportController.js"></script>
    <script src="<?php echo base_url(); ?>assets/controllers/adminController.js"></script>
    <script src="<?php echo base_url(); ?>assets/controllers/loginController.js"></script>


    <script src="<?php echo base_url(); ?>assets/factory/base_factory.js"></script>
    <script src="<?php echo base_url(); ?>assets/factory/multiexcel-factory.js"></script>
    <!--<script src="<?php /*echo base_url(); */?>assets/directives/base_directives.js"></script>-->

</head>

<body ng-app="noe" class="style-3" ng-cloak >
<page-loader flag="isLoading" ></page-loader>
<div class="row">
    <div ui-view></div>	  
</div>
</body>
</html>

<script src="<?php echo base_url(); ?>assets/js/charts/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/charts/data.js"></script>


