<?php session_start() ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="../css/master.css" rel="stylesheet">
    <link href="../css/maincontent.css" rel="stylesheet">
    <link href="../css/student_maincontent.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;1,200;1,700&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/72c32f013b.js" crossorigin="anonymous"></script>
</head> 

<body>

<?php require_once('../../includes/dbh.inc.php') ?>
<?php 
require_once('../../includes/query.inc.php');
require_once('../../includes/student.function.inc.php');

// setting default date
date_default_timezone_set('Asia/Manila');
?>

<div class="container-fluid" id="header">
    <div class="row">
        <nav class="navbar navbar-expand-md navbar-top">
            <div class="container-fluid">
                <!-- Left -->
                <a href="#" class="navbar-brand fs-3 page-title">Change Title</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTop"
                    aria-controls="navbarTop" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Right -->
                <div class="collapse navbar-collapse" id="navbarTop">
                    <ul class="navbar-nav ms-auto me-0">
                        <li class="nav-item">
                            <a href="student.announcement.php" class="nav-link"><i class="fa-solid fa-bullhorn"></i></a>
                        </li>
                        <li class="nab-item">
                            <a href="student.calendar.php" class="nav-link"><i class="fa-regular fa-calendar"></i></a>
                        </li>
                        <li class="nav-item">
                        <?php  if(isset($_SESSION['student_id'])){ ?>
                            <a href="" class="nav-link">
                                <?php echo 'Welcome, '.$_SESSION['student_name']; ?>
                            </a>
                        <?php } ?>
                        </li>
                        <li class="nav-item dropdown">

                            <a href="" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">User </a>
                            <ul class="dropdown-menu  dropdown-menu-end">
                                
                                <li><a href="student.profile.php" class="dropdown-item">profile</a></li>
                                <?php 
                                if(isset($_SESSION['student_id'])){
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

