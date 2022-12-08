<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OLMS - Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- Custom fonts for this template-->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="admin/img/HFA-Logo.png">
    <script src="admin/vendor/jquery-1.9.1.min.js"></script>
    <link href="admin/vendor/jGrowl/jquery.jgrowl.css" rel="stylesheet" media="screen" />

</head>

<body>
    <!-- <div class="container mt-5 d-flex   justify-content-center">

        <form action="includes/login.inc.php" method="post" class="d-flex flex-column">
            <h1>Log in</h1>
            <input class="mt-3" type="text" placeholder="Student number" name="usernumber">
            <input class="mt-3" type="password" placeholder="Password" name="password">
            <button class="mt-3" type="submit" name="submit">login</button>


        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script> -->

    <body class="bg-gradient-primary">

        <?php
        session_start();

        $username = 'lolol';
        $userTeacher = 'tch';
        $userStudent = 'std';
        // echo $userIndicator = substr($username, 0, 4);
        // echo strlen($userIndicator);
        # Login student/teacher

        ?>

        <div class="container">

            <!-- Outer Row -->
            <div class="row justify-content-center my-lg-3">

                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <img src="admin/img/HFA-Logo.png" alt="Logo" width="50" height="50">
                                        <h1 class="h3 text-gray-900 mb-4 mt-4">Oblates Learning Management System</h1>
                                        <form action="includes/login.inc.php" method="POST" class="user">
                                            <div class="form-group">
                                                <h5>Login Page</h5>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user" id="user_login" name="user_login" placeholder="User ID" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user" id="user_password" name="user_password" placeholder="Password" required>
                                            </div>

                                            <button type="submit" data-placement="bottom" title="Click Here to Login" class="btn btn-primary btn-user btn-block" id="login" name="login_btn">
                                                Login
                                            </button>

                                            <?php
                                            # Error message
                                            if (isset($_GET["error"])) {
                                                if ($_GET["error"] == "emptyinput") {
                                                    echo '<p>Missing Fields!</p>';
                                                } else if ($_GET["error"] == "usernotfound") {
                                                    echo '<p>Theres no such user!</p>';
                                                } else if ($_GET["error"] == "wronglogin") {
                                                    echo '<p>Incorrect login!</p>';
                                                }
                                            }
                                            ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>


        <!-- Bootstrap core JavaScript-->


        <script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="admin/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="admin/js/sb-admin-2.min.js"></script>

        <script src="admin/vendor/jGrowl/jquery.jgrowl.js"></script>
        <script>
            $(function() {
                $('.tooltip').tooltip();
                $('.tooltip-left').tooltip({
                    placement: 'left'
                });
                $('.tooltip-right').tooltip({
                    placement: 'right'
                });
                $('.tooltip-top').tooltip({
                    placement: 'top'
                });
                $('.tooltip-bottom').tooltip({
                    placement: 'bottom'
                });
                $('.popover-left').popover({
                    placement: 'left',
                    trigger: 'hover'
                });
                $('.popover-right').popover({
                    placement: 'right',
                    trigger: 'hover'
                });
                $('.popover-top').popover({
                    placement: 'top',
                    trigger: 'hover'
                });
                $('.popover-bottom').popover({
                    placement: 'bottom',
                    trigger: 'hover'
                });
                $('.notification').click(function() {
                    var $id = $(this).attr('id');
                    switch ($id) {
                        case 'notification-sticky':
                            $.jGrowl("Stick this!", {
                                sticky: true
                            });
                            break;
                        case 'notification-header':
                            $.jGrowl("A message with a header", {
                                header: 'Important'
                            });
                            break;
                        default:
                            $.jGrowl("Hello world!");
                            break;
                    }
                });
            });
        </script>

    </body>
</body>

</html>