<?php 
function questionerExist($conn, $questioner){
    $selectQuestionName = "SELECT * FROM question_tbl WHERE question_name = ?;";

    # prepare the statement
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $selectQuestionName)){
        header ('location: ../Main_Project/teacher/teacher.createquestioner.php?error=selectstmtfailed');
        exit();
    }

    # binding user input
    mysqli_stmt_bind_param($stmt, "s", $questioner);
    mysqli_stmt_execute($stmt);

    # save the data to variable then return the data or false
    $resultData = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($resultData)){
        return $row["question_id"];
    } else{
        $result = false;
        return $result;
    }
        
}
