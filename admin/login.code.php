<?php
//include('security.php');
$connection = mysqli_connect('localhost', 'root', '', 'olms_hfa') or die(mysqli_error());
session_start();


$username = $_POST['admin_login'];
$password = $_POST['admin_password'];
/* admin */
    $query = "SELECT * FROM admin_acc WHERE admin_username='$username' AND admin_password='$password'";
    $result = mysqli_query($connection,$query)or die(mysqli_error());
    $row = mysqli_fetch_array($result);
    $num_row = mysqli_num_rows($result);
    

if( $num_row > 0 ) { 
$_SESSION['id']=$row['id'];
echo 'true';	
}else{ 
        echo 'false';
}	

?>
