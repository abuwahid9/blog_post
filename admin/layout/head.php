<?php
session_start();

if (!isset($_SESSION['id']) && $_SESSION['is_logined'] == false) {
    header('location:index.php');
}
$filepath = dirname(__FILE__);
include $filepath . "/../config/data_base.php";
include $filepath . "/../healper/healper.php";
// include $filepath. "healper/healper.php";
date_default_timezone_set('Asia/Dhaka');
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MAIN PENAL | <?php echo ucfirst($title);?></title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"> -->
    <link href="vendor/dropify/dist/css/dropify.min.css" rel="stylesheet">
    <!-- <link href="css/summernote/summernote.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="vendor/summernote-0.8.18-dist/summernote.min.css">    
    <!-- <link href="vendor/select2-develop/dist/css/select2.min.css" rel="stylesheet"> -->
    <link href="css/select/select2.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .dropify-wrapper .dropify-message p {
            margin: 5px 0 0;
            font-size: 16px !important;
        }
    </style>
</head>

<body id="page-top">