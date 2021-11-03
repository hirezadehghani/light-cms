<?php
require_once("./include/config.php");
require_once("./include/db.php");
$query = "SELECT * FROM categories";
$categories = $db->query($query);
?>

<!DOCTYPE html>
<html>

<head>
    <link href="./lib/bootstrap-5.0.0-beta3/css/bootstrap.min.css" rel="stylesheet">
    <script src="./js/fontawesome.js"></script>
    <link href="../css/content-styles.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>HiReza | های رضا</title>
    <link rel="shortcut icon" type="image/ico" href="../img/hireza_favicon.ico"/>
    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="description" content="وبلاگ شخصی رضا دهقانی | آموزش توسعه وب">
    <meta name="keywords" content="آموزش توسعه وب, طراحی وب حرفه ای, مهندس نرم افزار, تجربیات مهندس نرم افزار">
    <meta name="author" content="Reza Dehghani">
    <meta name="color-scheme" content="dark light">
    <!-- meta tags -->
</head>

<body>
    <div class="container-fluid">
        <!-- TOP DATE -->
        <!-- <section class="top-data">
            <div class="row">
                <div class="col-4 text-center">تعداد پست ها</div>
                <div class="col-4 text-center">تعداد اعضای سایت</div>
                <div class="col-4 text-center">تعداد کل بازدیدها</div>
            </div>
        </section>
        <hr /> -->
        <!-- TOP DATE -->
        <div class="row">
            <div class="col-md-3">
                <!-- NAVBAR -->
                <nav class="nav navbar-expand-md flex-column row navbar-light">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse flex-column" id="navbarSupportedContent">
                    <a href="/"><img class="rounded-circle" src="./img/me.jpg" alt="رضا دهقانی"> </a>
                    <a href="/" class="navbar-brand link-dark text-decoration-none">
                        <!-- آیکون سایت -->
                        <span class="fs-4 link-dark text-decoration-none">های رضا</span></a>
                        <a class="nav-link active" aria-current="page" href="./"><i class="fas fa-sticky-note-o fa"></i> همه مطالب</a>
                        <a class="nav-link" href="#"><i class="fas fa-file-text-o fa"></i> رزومه</a>
                        <a class="nav-link" href="#"><i class="fas fa-phone fa"></i> با من تماس بگیر</a>
                        <section class="mt-3">
                            <span>دنبال چی میگردی؟</span>
                            <form action="search.php" method="get">
                                <input name="search" required class="w-100 text-center" type="text" placeholder="اینجا بنویس...">
                                <button type="submit" class="btn btn-primary btn-sm w-100">
                                    <i class="fas fa-link fa"></i>
                                    گشتن در سایت</button>
                                <!-- حالت شب -->
                                <hr />
                                <div class="form-check form-switch">
                                    <input onclick="location.reload();" class="form-check-input display-inline" type="checkbox" id="nightcheck">
                                    <label class="form-check-label" for="nightcheck">
                                        <i class="fas fa-moon-o fa"></i>
                                        فعال کردن حالت شب</label>
                                </div>
                                <!-- حالت شب -->
                            </form>
                        </section>
                    </div>
                </nav>
                <!-- NAVBAR -->
            </div>