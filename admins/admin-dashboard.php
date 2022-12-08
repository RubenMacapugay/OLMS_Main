<?php
include('security.php'); 

// session_start();

include('includes/header.php'); 
include('includes/navbar.php');
?>

            

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Students -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">

                                                <?php

                                                    $query = "SELECT student_id FROM student_tbl ORDER BY student_id";
                                                    $query_run = mysqli_query($connection, $query);

                                                    $row = mysqli_num_rows($query_run);

                                                    echo '<h3> Students: '.$row.'</h3>';
                                                ?>
                                          
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Teachers -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">

                                            <?php

                                                $query = "SELECT teacher_id FROM teacher_tbl ORDER BY teacher_id";
                                                $query_run = mysqli_query($connection, $query);

                                                $row = mysqli_num_rows($query_run);

                                                echo '<h3> Teacher: '.$row.'</h3>';
                                            ?>
                                          
                                            </div>
                                        </div>
                                        
                                        <!-- <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Earnings (Annual)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                                        </div> -->
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Subject -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">

                                                <?php

                                                    $query = "SELECT subject_id FROM subject_tbl ORDER BY subject_id";
                                                    $query_run = mysqli_query($connection, $query);

                                                    $row = mysqli_num_rows($query_run);

                                                    echo '<h3> Subjects: '.$row.'</h3>';
                                                ?>
                                          
                                            </div>
                                        </div>
                                        <!-- <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">

                                                <?php

                                                    $query = "SELECT id FROM files ORDER BY id";
                                                    $query_run = mysqli_query($connection, $query);

                                                    $row = mysqli_num_rows($query_run);

                                                    echo '<h3> Files: '.$row.'</h3>';
                                                ?>
                                          
                                            </div>
                                        </div>
                                        <!-- <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pending Requests</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>

            </div>
            <!-- End of Main Content -->

<?php
include('includes/script.php');
include('includes/footer.php');
?>
    

    

