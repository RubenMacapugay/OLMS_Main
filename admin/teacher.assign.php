<?php
include('security.php');
//session_start();

include('includes/header.php');
include('includes/navbar.php');
?>


<!-- Modal for Adding Teacher's Account -->
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Profile Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="code.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="fname_teacher" class="form-control" placeholder="Enter Full Name">
                    </div>
                    <div class="form-group">
                        <label>ID</label>
                        <input type="text" name="id_teacher" class="form-control checking_email" placeholder="Enter ID">
                        <small class="error_email" style="color: red;"></small>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="pw_teacher" class="form-control" placeholder="Enter Password">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirmpw_teacher" class="form-control" placeholder="Confirm Password">
                    </div>
                    <!-- <input type="hidden" name="usertype" value="admin"> -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="regbtn_teacher" class="btn btn-primary">Add</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal for Editing Teacher's Account -->
<div class="modal fade" id="editTeacherModal" tabindex="-1" role="dialog" aria-labelledby="editTeacherModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Teacher's Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <form action="code.php" method="POST">
                    <input type="hidden" name="edit_teacher_id" id="edit_teacher_id" class="edit_teacher_id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="edit_fname_teacher" id="edit_fname_teacher" class="form-control edit_fname_teacher" placeholder="Enter Full Name">
                        </div>
                        <div class="form-group">
                            <label>ID</label>
                            <input type="text" name="edit_id_teacher" id="edit_id_teacher" class="form-control checking_email edit_id_teacher" placeholder="Enter ID">
                            <small class="error_email" style="color: red;"></small>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="edit_pw_teacher" id="edit_pw_teacher" class="form-control edit_pw_teacher" placeholder="Enter Password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="edtbtn_teacher" class="btn btn-primary" id="modalEdtbtn_teacher" >Update</button>
                    </div>
                </form>
        </div>
    </div>
</div>

<!-- Modal for Deleting Teachers Account -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Delete</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="code.php" method="post">
                <input type="hidden" name="delete_teacher_id" id="delete_teacher_id" class="delete_teacher_id" value="<?php echo $row['teacher_id'] ?>">
                <div class="modal-body">
                    <p>Are you sure you want to delete this?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" name="delete_teacher_btn" class="btn btn-primary" id="modalDltbtn_teacher">Yes</button>
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
                    <div class="mt-3 font-weight-bold text-primary">
                        Assign Subjects
                    </div>
                </div>
                <!-- <div class="p-2">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                        Add Teacher's Account
                    </button>
                </div> -->
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

                $query = "SELECT * FROM teacher_tbl";
                $query_run = mysqli_query($connection, $query);
                ?>
                <table class="table table-striped" id="datatable" width="100%" celspacing="0">
                    <thead>
                        <tr>
                            <!--<th>ID</th>-->
                            <th>Teacher's name</th>
                            <th>Subject Handled</th>
                            <th>Section Handled</th>
                            <!-- <th>User Type</th> -->
                            <th>Action</th>
                            <!-- <th>DELETE</th> -->
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                        ?>

                                <tr>
                                    <td><?php echo $row['teacher_name']; ?></td>
                                    <td><?php echo $row['teacher_number']; ?></td>
                                    <td><?php echo $row['teacher_password']; ?></td>
                                    <td>
                                        <div class="d-flex align-items-start">
                                            <!-- Edit Teacher's Account -->
                                            <span class="d-none" id="teacherId"><?php echo $row['teacher_id']; ?></span>
                                            <span class="d-none" id="teacherName"><?php echo $row['teacher_name']; ?></span>
                                            <span class="d-none" id="teacherNum"><?php echo $row['teacher_number']; ?></span>
                                            <span class="d-none" id="teacherPass"><?php echo $row['teacher_password']; ?></span>

                                            <i class="fa-regular fa-pen-to-square text-primary editTeacherModal me-2" type="button"></i>

                                            <!-- Delete Teacher's account -->
                                            <span class="d-none" id="deleteTeacherId"><?php echo $row['teacher_id']; ?></span>
                                            <i class="fa-solid fa-trash text-danger me-2 deleteTeacherModal" type="button"></i>
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
        $(document).on('click', '.editTeacherModal', function() {
            // var moduleTaskGradingId = $(this).closest('div').find('#moduleGradingId').text();
            // var moduleTaskId = $(this).closest('div').find('#moduleTaskId').text();
            // var moduleTaskName = $(this).closest('div').find('#moduleTaskName').text();
            // var moduleTaskDesc = $(this).closest('div').find('#moduleTaskDesc').text();

            var modalTeacherId = $(this).closest('div').find('#teacherId').text();
            var modalTeacherName = $(this).closest('div').find('#teacherName').text();
            var modalTeacherNum = $(this).closest('div').find('#teacherNum').text();
            var modalTeacherPass = $(this).closest('div').find('#teacherPass').text();


            $('#editTeacherModal').modal('show'); // load modal
            $('.edit_teacher_id').val(modalTeacherId);
            $('.edit_fname_teacher').val(modalTeacherName);
            $('.edit_id_teacher').val(modalTeacherNum);
            $('.edit_pw_teacher').val(modalTeacherPass);
        });
    });

    $(document).ready(function() {
        $(document).on('click', '.deleteTeacherModal', function() {

            var DeleteTeacherId = $(this).closest('div').find('#deleteTeacherId').text();



            $('#confirmDeleteModal').modal('show'); // load modal
            $('.delete_teacher_id').val(DeleteTeacherId);
        });
    });
</script>

<?php include('includes/footer.php'); ?>