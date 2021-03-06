<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Solid Waste Collection Management System-CI</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url().'assets/css/style.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/vendor/fontawesome-free/css/all.min.css' ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url().'assets/css/sb-admin-2.min.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/bootstrap.min.css' ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/jquery-ui.min.css'?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <!-- Datatables-->
	<link rel="stylesheet" href="<?php echo base_url().'assets/vendor/fullcalendar/main.css'?>">
	<link rel="stylesheet" href="<?php echo base_url().'assets/vendor/bootstrap-select/css/bootstrap-select.min.css'?>">
    <link href="<?php echo base_url().'assets/vendor/datatables/dataTables.bootstrap4.min.css' ?>" rel="stylesheet">


    <link rel="stylesheet" href="<?php echo base_url().'assets/css/ol.css' ?>">

    <style>
      .map{
        height: 400px;
        width: 100%;
      }
    </style>
    <script src="<?php echo base_url().'assets/js/ol.js'?>"></script>
</head>
