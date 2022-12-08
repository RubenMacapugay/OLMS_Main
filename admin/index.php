<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>OLMS - Admin Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="./img/HFA-Logo.png">
    <script src="vendor/jquery-1.9.1.min.js"></script>
    <link href="vendor/jGrowl/jquery.jgrowl.css" rel="stylesheet" media="screen"/>

</head>

<body class="bg-gradient-primary">

    <?php
    session_start();
    ?>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center my-lg-3">

            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <img src="./img/HFA-Logo.png" alt="Logo" width="50" height="50">
                                    <h1 class="h3 text-gray-900 mb-4 mt-4">Oblates Learning Management System</h1>
                                    <form id="admin_login_form" method="POST" class="user">
                                        <div class="form-group">
                                            <h5>Admin Page</h5>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="admin_login" name="admin_login" placeholder="User Account" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="admin_password" name="admin_password" placeholder="Password" required>
                                        </div>

                                        <button type="submit" data-placement="bottom" title="Click Here to Login" class="btn btn-primary btn-user btn-block" id="login" name="login_btn">
                                            Login
                                        </button>

                                        <script type="text/javascript">
                                            $(document).ready(function() {
                                                $('#login').tooltip('show');
                                                $('#login').tooltip('hide');
                                            });
                                        </script>

                                    </form>

                                    <script>
                                        jQuery(document).ready(function() {
                                            jQuery("#admin_login_form").submit(function(e) {
                                                e.preventDefault();
                                                var formData = jQuery(this).serialize();
                                                $.ajax({
                                                    type: "POST",
                                                    url: " login.code.php",
                                                    data: formData,
                                                    success: function(html) {
                                                        if (html == 'true') {
                                                            $.jGrowl("Loading File Please Wait......", {
                                                                sticky: true
                                                            });
                                                            $.jGrowl("Welcome to Oblates Learning Management System", {
                                                                header: 'Access Granted'
                                                            });
                                                            var delay = 2000;
                                                            setTimeout(function() {
                                                                window.location = 'admin-dashboard.php'
                                                            }, delay);
                                                        } else {
                                                            $.jGrowl("Please Check your username and Password", {
                                                                header: 'Login Failed'
                                                            });
                                                        }
                                                    }
                                                });
                                                return false;
                                            });
                                        });
                                    </script>

                                </div>
                            </div>
                            <div class="col-lg-6 d-none d-lg-block bg-admin-login-image"></div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    
    <!-- Bootstrap core JavaScript-->
    
    
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script src="vendor/jGrowl/jquery.jgrowl.js"></script>   
			<script>
				$(function() {
					$('.tooltip').tooltip();	
					$('.tooltip-left').tooltip({ placement: 'left' });	
					$('.tooltip-right').tooltip({ placement: 'right' });	
					$('.tooltip-top').tooltip({ placement: 'top' });	
					$('.tooltip-bottom').tooltip({ placement: 'bottom' });
					$('.popover-left').popover({placement: 'left', trigger: 'hover'});
					$('.popover-right').popover({placement: 'right', trigger: 'hover'});
					$('.popover-top').popover({placement: 'top', trigger: 'hover'});
					$('.popover-bottom').popover({placement: 'bottom', trigger: 'hover'});
					$('.notification').click(function() {
						var $id = $(this).attr('id');
						switch($id) {
							case 'notification-sticky':
								$.jGrowl("Stick this!", { sticky: true });
							break;
							case 'notification-header':
								$.jGrowl("A message with a header", { header: 'Important' });
							break;
							default:
								$.jGrowl("Hello world!");
							break;
						}
					});
				});
			</script>

</body>

</html>