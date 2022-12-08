<?php
include('security.php');

include('includes/header.php'); 
include('includes/navbar.php');
?>

<div class="container-fluid">
    <!--DataTales Example-->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Teacher Profile</h6>          
        </div>
        <div class="card-body">

        <?php    
        
        $connection = mysqli_connect("localhost","root","","db_olms");
        if(isset($_POST['edit_teacher_btn']))
        {
            $id = $_POST['edit_teacher_id'];

            $query = "SELECT * FROM reg_teacher WHERE id='$id' ";
            $query_run = mysqli_query($connection, $query);

            foreach($query_run as $row)
            {
            ?>
            <form action="code.php" method="POST">
                <input type="hidden" name="edit_teacher_id" value="<?php echo $row['id']?>">
                
                <div class="form-group">
                    <label> Username </label>
                    <input type="text" name="edit_teacher_un" value="<?php echo $row['username'] ?>" class="form-control"
                        placeholder="Enter Username">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="edit_teacher_email" value="<?php echo $row['email'] ?>" class="form-control"
                        placeholder="Enter Email">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="edit_teacher_pw" value="<?php echo $row['password'] ?>"
                        class="form-control" placeholder="Enter Password">
                </div>
                <!-- <div class="form-group">
                    <label>User Type</label>
                    <select name="" id="">
                        <option value="admin">Admin</option>
                        <option value="client">Admin</option>
                    </select>
                </div> -->
            
                <a href="reg_teacher.php" class = "btn btn-danger">CANCEL</a>
                <button type = "submit" name = "update_teacher_btn" class = "btn btn-primary"> UPDATE</button>
            </form>
            
            <?php
            }
        }
        ?>
            
        </div> 
    </div>
</div>



<?php
include('includes/script.php');
include('includes/footer.php');
?>