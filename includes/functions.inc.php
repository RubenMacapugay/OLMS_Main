<?php session_start(); ?>

<?php 

$sql_student = "SELECT * FROM  student_tbl where student_number = ?;";
$sql_student_id = "SELECT * FROM  student_tbl where student_id = ?;";
$sql_parent_id = "SELECT * FROM  parent_tbl where parent_id = ?;";
$sql_teacher = "SELECT * FROM  teacher_tbl where teacher_number = ?;";
$sql_parent = "SELECT * FROM  parent_tbl where parent_number = ?;";
$sql_parent_child = "SELECT * FROM  parent_tbl where fk_student_id = ?;";


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

function getUser($conn, $sql, $id) {
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
    mysqli_stmt_bind_param($stmt, "i", $id);
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

function getStudentsMommy($conn, $studentId){
    $submittedQuery = "SELECT * from parent_tbl where fk_student_id = $studentId";
    $submittedAnswers = mysqli_query($conn,$submittedQuery);
    return $submittedAnswewrRow = mysqli_fetch_assoc($submittedAnswers);
}

function getMommysChild($conn, $studentId){
    $submittedQuery = "SELECT * from student_tbl where student = $studentId";
    $submittedAnswers = mysqli_query($conn,$submittedQuery);
    return $submittedAnswewrRow = mysqli_fetch_assoc($submittedAnswers);
}


# Login
//log in validation
function emptyInputLogin($username, $pwd){
    if(empty($username) || empty($pwd)){
        return true;
    }
    else{
        return false;
    }
}
 
//login account
function loginStudent($conn, $sql, $username, $pwd){
    $uidExists = uidExist($conn, $sql, $username);
    $studentId = $uidExists['student_id'];
    
    //get the parent name
    $parentDetail = getStudentsMommy($conn, $studentId);
    
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
        $_SESSION["userType"] = "Parent";
        
        
        $_SESSION["parent_name"] = $parentDetail["parent_name"];
        echo $_SESSION["parent_name"];
        
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

function loginParent($conn, $sqlParent, $sqlStudent, $username, $pwd){
    
    $uidExists = uidExist($conn, $sqlParent, $username);
    
    // get child
    // re-login if theres no such user in database
    if($uidExists === false){
        header("location: ../login.php?error=usernotfound");
        exit();
    }
    
    $studentExists = getUser($conn, $sqlStudent, $uidExists['fk_student_id']);
    
    // password from database
    $password = $uidExists["parent_password"];
    if($password  !== $pwd){
        header("location: ../login.php?error=wrongpassword");
        //exit();
    }
    else if($password  === $pwd){
        $_SESSION["student_id"] = $studentExists["student_id"];
        $_SESSION["student_name"] = $uidExists["parent_name"];
        $_SESSION["student_number"] = $uidExists["parent_name"];
        $_SESSION["userType"] = "Parent";
        
        $_SESSION["my_child"] = $studentExists["student_name"];
        header("location: ../Main_Project/student/student.php");
        exit();
    }
    


}
