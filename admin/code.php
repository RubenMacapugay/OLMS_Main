<?php
//session_start();
include('security.php');
$connection = mysqli_connect('localhost', 'root', '', 'olms_hfa');

 
// Admin registration
if(isset($_POST['registerbtn']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];

    $email_query = "SELECT * FROM register WHERE email='$email' ";
    $email_query_run = mysqli_query($connection, $email_query);
    if(mysqli_num_rows($email_query_run) > 0)
    {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');  
    }
    else
    {
        if($password === $cpassword)
        {
            $query = "INSERT INTO register (username,email,password) VALUES ('$username','$email','$password')";
            $query_run = mysqli_query($connection, $query);
            
            if($query_run)
            {
                // echo "Saved";
                $_SESSION['status'] = "Admin Profile Added";
                $_SESSION['status_code'] = "success";
                header('Location: register.php');
            }
            else 
            {
                $_SESSION['status'] = "Admin Profile Not Added";
                $_SESSION['status_code'] = "error";
                header('Location: register.php');  
            }
        }
        else 
        {
            $_SESSION['status'] = "Password and Confirm Password Does Not Match";
            $_SESSION['status_code'] = "warning";
            header('Location: register.php');  
        }
    }

}


//Edit Admin Accounts
if(isset($_POST['edit_btn']))
{
    $id = $_POST['edit_id'];

    $query = "SELECT * FROM register WHERE id = '$id' ";
    $query_run = mysqli_query($connection, $query);

}

// Update Admin Accounts
if(isset($_POST['updatebtn']))
{
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];

    $query = "UPDATE register SET username='$username', email='$email', password='$password' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Your Data is Updated";
        header('Location: register.php');
    }
    else
    {
        $_SESSION['status'] = "Your Data is Not updated";
        header('Location: register.php');
    }
}


//Delete Admin Accounts
if(isset($_POST['delete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM register WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Your Data is Delete";
        header('Location: register.php');
    }
    else
    {
        $_SESSION['status'] = "Your Data is not Delete";
        header('Location: register.php');
    }
}



// ----------------------------------------------------------------------------------------------------------------------------

// Teacher Profile Database Code
// Teachers registration
if(isset($_POST['regbtn_teacher']))
{
    $fn_teacher = $_POST['fname_teacher'];
    $id_teacher = $_POST['id_teacher'];
    $pw_teacher = $_POST['pw_teacher'];
    $cpw_teacher = $_POST['confirmpw_teacher'];

    $fname_teacher_query = "SELECT * FROM teacher_tbl WHERE teacher_name = '$fn_teacher'";
    $fname_teacher_query_run = mysqli_query($connection, $fname_teacher_query);
    if(mysqli_num_rows($fname_teacher_query_run) > 0)
    {
        $_SESSION['status'] = "ID already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: teacher.head.php');  
    }
    else
    {
        if($pw_teacher === $cpw_teacher)
        {
            $query = "INSERT INTO teacher_tbl (teacher_name , teacher_number , teacher_password) VALUES ('$fn_teacher','$id_teacher','$pw_teacher')";
            $query_run = mysqli_query($connection, $query);
            
            if($query_run)
            {
                // echo "Saved";
                $_SESSION['status'] = "Teacher Account Added";
                $_SESSION['status_code'] = "success";
                header('Location: teacher.head.php');
            }
            else 
            {
                $_SESSION['status'] = "Teacher Account Not Added";
                $_SESSION['status_code'] = "error";
                header('Location: teacher.head.php');  
            }
        }
        else 
        {
            $_SESSION['status'] = "Password and Confirm Password Does Not Match";
            $_SESSION['status_code'] = "warning";
            header('Location: teacher.head.php');  
        }
    }
}


//Edit Teacher Accounts
if(isset($_POST['edit_teacher_btn']))
{
    $id_teacher = $_POST['edit_teacher_id'];

    $query = "SELECT * FROM reg_teacher WHERE id = '$id_teacher' ";
    $query_run = mysqli_query($connection, $query);
}


// Update Teacher Accounts
if(isset($_POST['edtbtn_teacher']))
{
    $id_teacher = $_POST['edit_teacher_id'];
    $edt_fn_teacher = $_POST['edit_fname_teacher'];
    $edt_id_teacher = $_POST['edit_id_teacher'];
    $edt_pw_teacher = $_POST['edit_pw_teacher'];

    $query = "UPDATE teacher_tbl SET teacher_name = '$edt_fn_teacher', teacher_number = '$edt_id_teacher', teacher_password='$edt_pw_teacher' WHERE teacher_id = '$id_teacher' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Your Data is Updated";
        header('Location: teacher.head.php');
    }
    else
    {
        $_SESSION['status'] = "Your Data is Not updated";
        header('Location: teacher.head.php');
    }
}

//Delete Teacher Accounts
if(isset($_POST['delete_teacher_btn']))
{
    $delete_id_teacher = $_POST['delete_teacher_id'];

    $deletequery = "DELETE FROM teacher_tbl WHERE teacher_id = '$delete_id_teacher'";
    $delete_query_run = mysqli_query($connection, $deletequery);

    if($delete_query_run)
    {
        $_SESSION['success'] = "Your Data is Deleted";
        header('Location: teacher.head.php');
    }
    else
    {
        $_SESSION['status'] = "Your Data is not Deleted";
        header('Location: teacher.head.php');
    }
}


// -----------------------------------------------------------------------------------------------------------------------------
//Admin Login
if(isset($_POST['login_btn']))
{   
    $email_login = $_POST['login_email']; 
    $password_login = $_POST['login_password']; 

    $query = "SELECT * FROM register WHERE email = '$email_login' AND password = '$password_login'";
    $query_run = mysqli_query($connection, $query);

   if(mysqli_fetch_array($query_run))
   //if($query_run)
   {
        $_SESSION['username'] = $email_login;
        header('Location: index.php');
   } 
   else
   {
        $_SESSION['status'] = "Incorrect Password or Email";
        header('Location: ../login2.php');
   }
}



if(isset($_POST['student_login_btn']))
{   
    $email_login = $_POST['login_email']; 
    $password_login = $_POST['login_password']; 

    $query = "SELECT * FROM register WHERE email = '$email_login' AND password = '$password_login'";
    $query_run = mysqli_query($connection, $query);

   if(mysqli_fetch_array($query_run))
   //if($query_run)
   {
        $_SESSION['username'] = $email_login;
        header('Location: index.php');
   } 
   else
   {
        $_SESSION['status'] = "Incorrect Password or Email";
        header('Location: ../login2.php');
   }
}


