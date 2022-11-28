<?php
include('security.php'); 
//session_start();

include('includes/header.php'); 
include('includes/navbar.php');
?>


<!-- Modal for Registration -->
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
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
                <label> Username </label>
                <input type="text" name="username_teacher" class="form-control" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email_teacher" class="form-control checking_email" placeholder="Enter Email">
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
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="regbtn_teacher" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>



<div class="container-fluid">
    

    <!--DataTables Example-->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="m-0 font-weight-bold text-primary">Teacher Profile
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                Add Teacher Profile 
            </button> 
            </div>
        </div>
    </div>
    
    <div class="card-body">
        <?php
            if(isset($_SESSION['success']) && $_SESSION['success'] !='')
            {
                echo '<h2 class = "bg-primary text-white p-2">'.$_SESSION['success'].'</h2>';
                unset($_SESSION['success']);
            }

            if(isset($_SESSION['status']) && $_SESSION['status'] !='')
            {
                echo '<h2 class = "bg-danger text-white p-2">'.$_SESSION['status'].'</h2>';
                unset($_SESSION['status']);
            }
        ?>
        <div class="table-responsive">
            
        <?php
            $connection = mysqli_connect("localhost", "root", "", "db_olms");

            $query = "SELECT * FROM reg_teacher";
            $query_run = mysqli_query($connection, $query);
        ?>
            <table class="table table-bordered" id="datatable" width="100%" celspacing="0">
                <thead>
                    <tr>
                        <!--<th>ID</th>-->
                        <th>Username</th>
                        <th>Email</th>
                        <th>Password</th>
                        <!-- <th>User Type</th> -->
                        <th>EDIT</th>
                        <th>DELETE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(mysqli_num_rows($query_run) > 0)
                    {
                        while($row = mysqli_fetch_assoc($query_run))
                        {
                            ?>

                        <tr>
                            <!--<td><?php //echo $row['id'];?></td>-->
                            <td><?php echo $row['username'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['password'];?></td>
                            <!-- <td><?php //echo $row['usertype'];?></td> -->
                            <td>
                                <form action="reg_edit_teacher.php" method = "post">
                                    <input type="hidden" name="edit_teacher_id" value = "<?php echo $row['id'];?>">
                                    <button type = "submit" name = "edit_teacher_btn" class = "btn btn-success">EDIT</button>
                                </form>
                                
                            </td>
                            <td>
                                <form action="code.php" method = "POST">
                                    <input type="hidden" name = "delete_teacher_id" value = "<?php echo $row['id']?>">
                                    <button type = "submit" name = "delete_teacher_btn" class = "btn btn-danger">DELETE</button>
                                </form>
                                
                            </td>
                        </tr>
                        <?php            
                        }
                    }
                    else
                    {
                        echo "No Record Found";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    
</div>



<?php
include('includes/script.php');
include('includes/footer.php');
?>