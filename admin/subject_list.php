<?php
include('security.php');
//session_start();

include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container-fluid">
    <!--DataTables Example-->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex">
                <div class="p-2 flex-grow-1">
                    <div class="font-weight-bold text-primary">
                        Student List
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <?php
                $connection = mysqli_connect("localhost", "root", "", "olms_hfa");

                $query = "SELECT * FROM subject_tbl";
                $query_run = mysqli_query($connection, $query);
                ?>
                <table class="table table-striped" id="datatable" width="100%" celspacing="0">
                    <thead>
                        <tr>
                            <!--<th>ID</th>-->
                            <th>Subject ID</th>
                            <th>Subject Name</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                        ?>

                                <tr>
                                    <td><?php echo $row['subject_id']; ?></td>
                                    <td><?php echo $row['subject_name']; ?></td>    
                                </tr>
                        <?php
                            }
                        } else {
                            echo "No Record Found";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>