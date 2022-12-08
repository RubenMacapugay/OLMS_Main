<?php
//session_start();
include('security.php');
$connection = mysqli_connect('localhost', 'root', '', 'db_olms');

 
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
    $un_teacher = $_POST['username_teacher'];
    $email_teacher = $_POST['email_teacher'];
    $pw_teacher = $_POST['pw_teacher'];
    $cpw_teacher = $_POST['confirmpw_teacher'];

    $email_teacher_query = "SELECT * FROM reg_teacher WHERE email='$email_teacher' ";
    $email_teacher_query_run = mysqli_query($connection, $email_teacher_query);
    if(mysqli_num_rows($email_teacher_query_run) > 0)
    {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: reg_teacher.php');  
    }
    else
    {
        if($pw_teacher === $cpw_teacher)
        {
            $query = "INSERT INTO reg_teacher (username,email,password) VALUES ('$un_teacher','$email_teacher','$pw_teacher')";
            $query_run = mysqli_query($connection, $query);
            
            if($query_run)
            {
                // echo "Saved";
                $_SESSION['status'] = "Teacher Profile Added";
                $_SESSION['status_code'] = "success";
                header('Location: reg_teacher.php');
            }
            else 
            {
                $_SESSION['status'] = "Teacher Profile Not Added";
                $_SESSION['status_code'] = "error";
                header('Location: reg_teacher.php');  
            }
        }
        else 
        {
            $_SESSION['status'] = "Password and Confirm Password Does Not Match";
            $_SESSION['status_code'] = "warning";
            header('Location: reg_teacher.php');  
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
if(isset($_POST['update_teacher_btn']))
{
    $id_teacher = $_POST['edit_teacher_id'];
    $un_teacher = $_POST['edit_teacher_un'];
    $email_teacher = $_POST['edit_teacher_email'];
    $pw_teacher = $_POST['edit_teacher_pw'];

    $query = "UPDATE reg_teacher SET username='$un_teacher', email='$email_teacher', password='$pw_teacher' WHERE id='$id_teacher' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Your Data is Updated";
        header('Location: reg_teacher.php');
    }
    else
    {
        $_SESSION['status'] = "Your Data is Not updated";
        header('Location: reg_teacher.php');
    }
}

//Delete Teacher Accounts
if(isset($_POST['delete_teacher_btn']))
{
    $id_teacher = $_POST['delete_teacher_id'];

    $query = "DELETE FROM reg_teacher WHERE id='$id_teacher' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['success'] = "Your Data is Delete";
        header('Location: reg_teacher.php');
    }
    else
    {
        $_SESSION['status'] = "Your Data is not Delete";
        header('Location: reg_teacher.php');
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


