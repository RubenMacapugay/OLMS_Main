<?php
include('security.php');
//session_start();

include('includes/header.php');
include('includes/navbar.php');
?>

<!-- Restore Modal-->
<div class="modal fade" id="restoreDataModal" tabindex="-1" aria-labelledby="restoreDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="uploadModalLabel">Upload Files</h1>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="#" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    <div class="form-group">
                        <label>File Name</label>
                        <input type="text" name="file_name" class="form-control" placeholder="Subject Name" required>
                    </div>
                    <div class="form-group">
                        <label>Upload Files</label>
                        <input type="file" name="file_upload" id="fileInput" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="btnUpload" class="btn btn-primary">Upload</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Backup Modal-->
<div class="modal fade" id="backupModal" tabindex="-1" role="dialog" aria-labelledby="backupModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Backup Database?</h5>
                <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Do you want to backup this database?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                <form action="#" method="POST">

                    <button type="submit" name="logout_btn" class="btn btn-primary">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <!--DataTables Example-->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex">
                <div class="mt-3 p-2 flex-grow-1">
                    <div class="font-weight-bold text-primary">
                        Database Table List
                    </div>
                </div>
                <div class="p-2">
                    <button class="btn btn-primary m-3" data-toggle="modal" data-target="#backupModal">Backup Database</button>
                </div>
                <div class="p-2">
                    <button class="btn btn-primary m-3" data-toggle="modal" data-target="#restoreDataModal">Restore Database</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?php
                $connection = mysqli_connect("localhost", "root", "", "olms_hfa");

                // $query = "SELECT * FROM student_tbl";
                // $query_run = mysqli_query($connection, $query);
                $showtables = mysqli_query($connection, "SHOW TABLES FROM olms_hfa");
                ?>
                <table class="table table-striped" id="datatable" width="100%" celspacing="0">
                    <thead>
                        <tr>
                            <!--<th>ID</th>-->
                            <th>Table Name</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        if (mysqli_num_rows($showtables) > 0) {
                            while ($table = mysqli_fetch_array($showtables)) {
                        ?>
                                <tr>
                                    <td><?php echo ($table[0]) ?></td>
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