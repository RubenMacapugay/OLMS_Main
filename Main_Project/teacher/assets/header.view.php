<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OLMS - Teacher Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="../css/master.css" rel="stylesheet">
    <link href="../css/maincontent.css" rel="stylesheet">
    <link href="../css/teacher_maincontent.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;1,200;1,700&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/72c32f013b.js" crossorigin="anonymous"></script>

    <link rel="icon" type="image/x-icon" href="images/HFA-Logo.png">
</head>

<body>
    <!-- includes location -->
    <?php require_once('../../includes/dbh.inc.php') ?>
    <?php require_once('../../includes/query.inc.php') ?>
    <?php require_once('../../includes/teacher.function.inc.php') ?>
    <?php # require_once('../../includes/teacherfunction.inc.php') ?>
    <?php 
    // set gradingRow variable
    require '../../includes/teacherDropdown.inc.php';
    $gradings = loadModuleSection();
    // echo $_SESSION['subjectId'];

    // setting default date
    date_default_timezone_set('Asia/Manila');
    $date_Today = date("Y-m-d");
    
    
    if(!isset($_SESSION['teacher_id']) || isset($_SESSION['student_id'])){
        echo 'lost teacher';
        header ("location: ../../includes/logout.inc.php");
    } 
    
    $teacherId = $_SESSION['teacher_id'];
    
    
    
    ?>


    <div class="container-fluid" id="header">
        
        <div class="row">
        <?php
           
        ?>
            <nav class="navbar navbar-expand-md navbar-top">
                <div class="container-fluid ms-5">
                    <!-- Left -->
                    <img src="images/HFA-Logo.png" alt="Logo" width="40" height="40">
                    <a href="teacher.php" class="navbar-brand fs-3 page-title">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTop"
                        aria-controls="navbarTop" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!-- Right -->
                    <div class="collapse navbar-collapse" id="navbarTop">
                        <ul class="navbar-nav ms-auto me-0">
                            <li class="nav-item">
                                <a href="teacher.announcement.php" class="nav-link"><i
                                        class="fa-solid fa-bullhorn"></i></a>
                            </li>
                            <li class="nab-item">
                                <a href="teacher.calendar.php" class="nav-link"><i
                                        class="fa-regular fa-calendar"></i></a>
                            </li>
                            <li class="nav-item">
                                <?php  if(isset($_SESSION['teacher_id'])){ ?>
                                <a href="" class="nav-link">
                                    <?php echo 'Welcome, '.$_SESSION['teacher_name']; ?>
                                </a>
                                <?php } ?>
                            </li>
                            <li class="nav-item dropdown">

                                <a href="" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false"></a>
                                <ul class="dropdown-menu  dropdown-menu-end">

                                    <li><a href="teacher.profile.php" class="dropdown-item">profile</a></li>
                                    <?php 
                                if(isset($_SESSION['teacher_id'])){
                                    echo "<li><a href='../../includes/logout.inc.php' class='dropdown-item'>logout</a></li>";
                                } else {
                                    echo "<li><a href='#' class='dropdown-item'>login</a></li>";
                                }
                                ?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>