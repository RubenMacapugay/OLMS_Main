<?php session_start(); ?>

<?php 
//check if user from database
function uidExist($conn, $sql, $username) {
    #create sql statement 
    //runs into the database without input from user
    //$sql = "SELECT * FROM  student_tbl where student_number = ?;";

    #start prepare statement
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header ("location: ../login.php?error=stmtfailed");
        exit();
    } 

    #passing data from the user
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
    
}

# Login
//log in validation
function emptyInputLogin($username, $pwd){
    $result;
    if(empty($username) || empty($pwd)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}
 
//login account
function loginStudent($conn, $sql, $username, $pwd){
    $uidExists = uidExist($conn, $sql, $username);
    // re-login if theres no such user in database
    if($uidExists === false){
        header("location: ../login.php?error=usernotfound");
        exit();
    }

    // password from database
    $password = $uidExists["student_password"];
    if( $password  !== $pwd){
        header("location: ../login.php?error=wrongpassword");
        //exit();
    }
    else if($password  === $pwd){
        $_SESSION["student_id"] = $uidExists["student_id"];
        $_SESSION["student_name"] = $uidExists["student_name"];
        $_SESSION["student_number"] = $uidExists["student_number"];
        header("location: ../Main_Project/student/student.php");
        exit();
    }
}

function loginTeacher($conn, $sql, $username, $pwd){
    $uidExists = uidExist($conn, $sql, $username);
    // re-login if theres no such user in database
    if($uidExists === false){
        header("location: ../login.php?error=usernotfound");
        exit();
    }

    // password from database
    $password = $uidExists["teacher_password"];
    if( $password  !== $pwd){
        header("location: ../login.php?error=wrongpassword");
        //exit();
    }
    else if($password  === $pwd){
        $_SESSION["teacher_id"] = $uidExists["teacher_id"];
        $_SESSION["teacher_name"] = $uidExists["teacher_name"];
        $_SESSION["teacher_number"] = $uidExists["teacher_number"];
        header("location: ../Main_Project/teacher/teacher.php");
        exit();
    }
}
