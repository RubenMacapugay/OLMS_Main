<?php
include('security.php');
//session_start();

include('includes/header.php');
include('includes/navbar.php');
?>

<!-- Modal for Editing Student Account -->
<div class="modal fade" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="editStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Teacher's Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="code.php" method="POST">
                <input type="hidden" name="edit_student_id" id="edit_student_id" class="edit_student_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label>ID</label>
                        <input type="text" name="edit_id_student" id="edit_id_student" class="form-control checking_email edit_id_student" placeholder="Enter ID">
                        <small class="error_email" style="color: red;"></small>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="edit_pw_student" id="edit_pw_student" class="form-control edit_pw_student" placeholder="Enter Password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edtbtn_student" class="btn btn-primary" id="modalEdtbtn_student">Change</button>
                </div>
            </form>
        </div>
    </div>
</div>

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

        <?php
            if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
                echo '<h2 class = "bg-primary text-white p-2">' . $_SESSION['success'] . '</h2>';
                unset($_SESSION['success']);
            }

            if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                echo '<h2 class = "bg-danger text-white p-2">' . $_SESSION['status'] . '</h2>';
                unset($_SESSION['status']);
            }
            ?>

            <div class="table-responsive">
                <?php
                $connection = mysqli_connect("localhost", "root", "", "olms_hfa");

                $query = "SELECT * FROM student_tbl";
                $query_run = mysqli_query($connection, $query);
                ?>
                <table class="table table-striped" id="datatable" width="100%" celspacing="0">
                    <thead>
                        <tr>
                            <!--<th>ID</th>-->
                            <th>Name</th>
                            <th>Section</th>
                            <th>User ID</th>
                            <th>Password</th>
                            <th>Date Enrolled</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                        ?>

                                <tr>
                                    <td><?php echo $row['student_name']; ?></td>
                                    <td><?php echo $row['fk_section_id']; ?></td>
                                    <td><?php echo $row['student_number']; ?></td>
                                    <td><?php echo $row['student_password']; ?></td>
                                    <td><?php echo $row['student_date_enrolled']; ?></td>
                                    <td>
                                        <div class="d-flex align-items-start">
                                            <!-- Edit Student Account -->
                                            <span class="d-none" id="studentId"><?php echo $row['student_id']; ?></span>
                                            <span class="d-none" id="studentNum"><?php echo $row['student_number']; ?></span>
                                            <span class="d-none" id="studentPass"><?php echo $row['student_password']; ?></span>

                                            <i class="fa-regular fa-pen-to-square text-primary editStudentModal me-2" type="button"></i>
                                        </div>
                                    </td>
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

<script type="text/javascript">
    // script for updating  module_section
    $(document).ready(function() {
        $(document).on('click', '.editStudentModal', function() {
            var modalStudentId = $(this).closest('div').find('#studentId').text();
            var modalStudentNum = $(this).closest('div').find('#studentNum').text();
            var modalStudentPw = $(this).closest('div').find('#studentPass').text();


            $('#editStudentModal').modal('show'); // load modal
            $('.edit_student_id').val(modalStudentId);
            $('.edit_id_student').val(modalStudentNum);
            $('.edit_pw_student').val(modalStudentPw);
        });
    });
</script>
<?php include('includes/footer.php'); ?>