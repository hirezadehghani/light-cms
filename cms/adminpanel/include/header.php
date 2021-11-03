<?php
require_once("./include/connect.php");
session_start();
if(!isset($_SESSION['email'])){
    header("Location:login.php?err_msg=لطفا ابتدا وارد سیستم شوید");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <meta name="robots" content="noindex, nofollow">    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="author" content="Reza Dehghani">
    <link href="../lib/bootstrap-5.0.0-beta3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/ico" href="../../img/hireza_favicon.ico"/>
    <script src="../js/fontawesome.js"></script>
    <link rel="stylesheet" href="css/admin.css">
    <title>Hi Reza admin panel</title>
</head>
<body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-sm-2 mr-0" href="../index.php" target="_blank">
            <i class="fas fa-home" style="color: #fff;"></i>
            Hireza.ir</a>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="logout.php">خروج <i class="fas fa-sign-out fa" style="color: #fff;"></i></a>
            </li>
        </ul>
    </nav>