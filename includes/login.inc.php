<?php  

if(isset($_POST["login_btn"])){
    $username = $_POST["user_login"];
    $pwd = $_POST["user_password"];

    include_once 'dbh.inc.php';
    include_once 'functions.inc.php';
    include_once 'query.inc.php';

    # Error handlers
    if(emptyInputLogin($username, $pwd) !== false){
        header("location: ../login.php?error=emptyinput");
        exit();
    }
    $userTeacher = 'tch';
    $userStudent = 'std';
    $userIndicator = substr($username, 0, 3);
    
    # Login student/teacher
    if($userStudent === $userIndicator){
        loginStudent($conn, $sql_student, $username, $pwd);
    } else if($userTeacher === $userIndicator){
        loginTeacher($conn, $sql_teacher, $username, $pwd);
    }
} 
else{
    header("location: ../login.php");
}
