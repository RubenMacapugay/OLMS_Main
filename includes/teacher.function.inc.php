<?php 
require_once ('query.inc.php'); 
# teacher.createtask..php 


# --- isEmpty Functions --- #
    function emptyEssayTask($grading, $taskname, $taskcontent, $tasktype, $subtype, $datecreated, $datedeadline, $time, $maxscore, $maxattempts, $allowlate){
        $result;
        if(empty($grading) ||
            empty($taskname) ||
            empty($taskcontent) ||
            !is_numeric($tasktype) ||
            !is_numeric($subtype) || 
            empty($datecreated) || 
            empty($datedeadline) || 
            empty($time) || 
            empty($maxscore) || 
            empty($maxattempts)
        ){
            echo 'walang laman';
            $result = true;
        }else{
            echo 'may laman laman';
            $result = false;
        }
        return $result;
    }

    function emptyWithAnswerTask($grading, $taskname, $questionitems, $tasktype, $subtype, $datecreated, $datedeadline, $time, $maxattempts, $allowlate){
        $result;
        if(
            empty($grading) ||
            empty($taskname) ||
            empty($questionitems) ||
            !is_numeric($tasktype) ||
            !is_numeric($subtype) ||  
            empty($datecreated) ||
            empty($datedeadline) ||
            empty($time) || 
            empty($maxattempts) || 
            empty($allowlate) 
        ) {
            echo 'walang laman';
            $result = true;
        }
        else{
            echo 'may laman laman';

            $result = false;
        }

        // empty($datecreated) 
        // empty($datedeadline) 
        // if(empty($questionitems) ){
        //     echo 'walang laman';
        //     $result = true;
        // }else{
        //     echo 'may laman laman';
        //     $result = false;
        // }
        return $result;
    }

   

    # check question input fields if empty
    function emptyInputQuestion($questioner, $answerselect, $choiceA, $choiceB, $choiceC, $choiceD){
        $result;
        if(empty($questioner) || empty($answerselect) || empty($choiceA) || empty($choiceB) || empty($choiceC) || empty($choiceD)){
            $result = true;
        } else{
            $result = false;
        }

        return $result;

    } 

    function emptyInputIdentification($identificationAnswer, $identificationQuestion){
        $result;
        if(empty($identificationAnswer) || empty($identificationQuestion)){
            $result = true;
        } else{
            $result = false;

        }
        return $result;
    }

    function emptyInputTrueOrFalse($trueOrFalseQuestion, $trueOrFalseAnswer){
        $result;
        if(empty($trueOrFalseQuestion) || $trueOrFalseAnswer == "" ){
            $result = true;
        } else{
            $result = false;

        }
        return $result;
    }

    function validateDate($date, $format = 'm-d-Y')
    {
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }
# --- isEmpty Functions --- end #

# --- Exists Functions --- #
    function teacherSubjectExist($conn, $subjectId, $teacherId){
        $selectSubject = "SELECT * FROM subject_list_tbl where subject_list_id = ? and fk_teacher_id = ?";

        # start the preapred statement
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $selectSubject)){
            header ('location: ../Main_Project/teacher/teacher.subject.php?error=selectstmtfailed');
            exit();
        }
        
        # binding user input
        mysqli_stmt_bind_param($stmt, "ii", $subjectId, $teacherId);
        mysqli_stmt_execute($stmt);

        # save result
        $resultData = mysqli_stmt_get_result($stmt);

        # check if theres returned data
        if($row = mysqli_fetch_assoc($resultData)){
            return $row;
        } else{
            $result = false; 
            return false;
        }

        # close the statement
        mysqli_stmt_close($stmt);
    }

    function tasknameExist($conn, $taskname, $subjectId){
        #query
        $selectTaskName = "SELECT * FROM task_list_tbl where task_name = ? and fk_subject_list_id = ?;";

        # start the preapred statement
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $selectTaskName)){
            header ('location: ../Main_Project/teacher/teacher.createtask.php?error=selectstmtfailed');
            exit();
        }
        
        # binding user input
        mysqli_stmt_bind_param($stmt, "si", $taskname, $subjectId);
        mysqli_stmt_execute($stmt);

        # save result
        $resultData = mysqli_stmt_get_result($stmt);

        # check if theres returned data
        if($row = mysqli_fetch_assoc($resultData)){
            return $row;
        } else{
            $result = false; 
            return false;
        }

        # close the statement
        mysqli_stmt_close($stmt);
    }

    function taskExists($conn, $taskId){
        $selectTask = "SELECT * FROM task_list_tbl where task_list_id = ?;";

        # start the preapred statement
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $selectTask)){
            header ('location: ../Main_Project/teacher/teacher.createtask.php?error=selectstmtfailed');
            exit();
        }
        
        # binding user input
        mysqli_stmt_bind_param($stmt, "s", $taskId);
        mysqli_stmt_execute($stmt);

        # save result
        $resultData = mysqli_stmt_get_result($stmt);

        # check if theres returned data
        if($row = mysqli_fetch_assoc($resultData)){
            return $row;
        } else{
            $result = false; 
            return false;
        }

        # close the statement
        mysqli_stmt_close($stmt);
    }

    function questionerExist($conn, $taskListId, $questioner){
        $selectQuestionName = "SELECT * FROM question_tbl WHERE fk_task_list_id = ? AND question_name = ?;";

        # prepare the statement
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $selectQuestionName)){
            header ('location: ../Main_Project/teacher/teacher.createquestioner.php?error=selectstmtfailed');
            exit();
        }

        # binding user input
        mysqli_stmt_bind_param($stmt, "is", $taskListId, $questioner);
        mysqli_stmt_execute($stmt);

        # save the data to variable then return the data or false
        $resultData = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($resultData)){
            return $row;
        } else{
            $result = false;
            return $result;
        }
            
    }
# --- Exists Functions --- end #


# --- Create Functions --- #
    function createTask($conn, $subjectId, $grading, $taskname, $questionitems, $tasktype, $subtype, $datecreated, $datedeadline, $time, $maxattempts, $allowlate){
        
        $sqlInsertTask = "INSERT INTO `task_list_tbl` (`fk_subject_list_id`, `fk_grading_id`, `task_name`, `question_item`, `fk_task_type`, `sub_type`, `date_created`, `date_deadline`, `time_limit`, `max_attempts`, `submission_choice`) 
            VALUES ('$subjectId', '$grading', '$taskname', '$questionitems', '$tasktype', '$subtype', '$datecreated', '$datedeadline', '$time', '$maxattempts', '$allowlate')";
        
        mysqli_query($conn, $sqlInsertTask);

        echo 'success';
    }

    function createNoQuestion($conn, $subjectId, $grading, $taskname, $taskcontent, $tasktype, $subtype, $datecreated, $datedeadline, $time, $maxscore, $maxattempts, $allowlate){

        // I need to capture the subject ID
        $sqlInsertTask = "INSERT INTO `task_list_tbl` (`fk_subject_list_id`, `fk_grading_id`, `task_name`, `task_content`, `fk_task_type`, `sub_type`, `date_created`, `date_deadline`, `time_limit`, `max_score`, `max_attempts`, `submission_choice`) 
            VALUES ('$subjectId', '$grading', '$taskname', '$taskcontent', '$tasktype', '$subtype', '$datecreated', '$datedeadline', '$time', '$maxscore', '$maxattempts', '$allowlate')";
        
        mysqli_query($conn, $sqlInsertTask);
        
    }

    # create task question
    function createQuestion($conn, $taskListId, $questioner, $questionNumber){
        
        $insertQuestion = "INSERT INTO `question_tbl`(`fk_task_list_id`, `question_name`, `question_number`) VALUES (?, ?, ?);";
        # start the prepared statement
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $insertQuestion)){
            header ('location: ../Main_Project/teacher/teacher.createtask.php?error=stmtfailed');
            exit();
        } 

        # binding user input
        mysqli_stmt_bind_param($stmt, "iss", $taskListId, $questioner, $questionNumber);    
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    function createAnswer($conn, $questionerId, $answerselect){
        $insertAnswer = "INSERT INTO `answer_tbl`(`answer_key`, `fk_question_id`) VALUES (?, ?);";
        # start the prepared statement
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $insertAnswer)){
            header ('location: ../Main_Project/teacher/teacher.createtask.php?error=answerstmtfailed');
            exit();
        } 

        # binding user input
        mysqli_stmt_bind_param($stmt, "si", $answerselect, $questionerId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    function createChoices($conn, $questionerId, $choices, $choiceIsCorrect) {
        $insertChoices = "INSERT INTO `choices_tbl`(`choices_name`, `fk_question_id`, `is_correct`) VALUES (?, ?, ?);";
        # start the prepared statement
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $insertChoices)){
            header ('location: ../Main_Project/teacher/teacher.createtask.php?error=choicesstmtfailed');
            exit();
        }

        # binding user input
        mysqli_stmt_bind_param($stmt, "sii", $choices, $questionerId, $choiceIsCorrect);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
# --- Create Functions --- end #


# --- Delete Functions --- #
    function deleteQuestion($conn, $questionId){
        $sql = "DELETE FROM `question_tbl` WHERE `question_id` = ?;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)){
            header ('location: ../Main_Project/teacher/teacher.createtask.php?error=deletefailed');
            exit();
        }

        # binding user input
        mysqli_stmt_bind_param($stmt, "i", $questionId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    function deleteAllQuestion($conn, $taskId){
        $sql = "DELETE FROM `question_tbl` WHERE `taskId` = ?;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)){
            header ('location: ../Main_Project/teacher/teacher.createtask.php?error=deletefailed');
            exit();
        }

        # binding user input
        mysqli_stmt_bind_param($stmt, "i", $taskId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    function deleteAnswer($conn, $questionId){
        $sql = "DELETE FROM `answer_tbl` WHERE `fk_question_id` = ?;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)){
            header ('location: ../Main_Project/teacher/teacher.createtask.php?error=deletefailed');
            exit();
        }

        # binding user input
        mysqli_stmt_bind_param($stmt, "i", $questionId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    function deleteChoices($conn, $questionId){
        $sql = "DELETE FROM `choices_tbl` WHERE `fk_question_id` = ?;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)){
            header ('location: ../Main_Project/teacher/teacher.createtask.php?error=deletefailed');
            exit();
        }

        # binding user input
        mysqli_stmt_bind_param($stmt, "i", $questionId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    function deleteTask($conn, $taskListId){
        $sql = "DELETE FROM `task_list_tbl` WHERE `task_list_id` = ?;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)){
            header ('location: ../Main_Project/teacher/teacher.createtask.php?error=deletefailed');
            exit();
        }

        # binding user input
        mysqli_stmt_bind_param($stmt, "i", $taskListId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
# --- Delete Functions --- end #


# --- Update Functions --- #
    function updateQuestion($conn, $questionerId, $questioner){
        $updateQuestion  = "UPDATE question_tbl SET question_name='$questioner' WHERE question_id = {$questionerId}";
        mysqli_query($conn, $updateQuestion);
    }

    function  updateAnswerKey($conn, $answerId, $answerselect){
        $updateQuestion  = "UPDATE `answer_tbl` SET `answer_key` =  {$answerselect} WHERE answer_id = {$answerId}";
        mysqli_query($conn, $updateQuestion);
    }

    function updateTrueOrFalseAnswer($conn, $answerID, $answer){
        $newAnswer;
        if($answer == "True"){
            $updateQuestion  = "UPDATE answer_tbl SET answer_key = 'True'  WHERE answer_id = $answerID";
            mysqli_query($conn, $updateQuestion);
        }else if($answer == "False"){
            $updateQuestion  = "UPDATE answer_tbl SET answer_key = 'False'  WHERE answer_id = $answerID";
            mysqli_query($conn, $updateQuestion);
        }
        
    }

    function updateChoices($conn, $choiceId, $choice, $choiceIsCorrect){
        $updateQuestion  = "UPDATE `choices_tbl` SET `choices_name` =  '$choice', `is_correct` =  '$choiceIsCorrect'  WHERE choices_id = {$choiceId}";
        mysqli_query($conn, $updateQuestion);
    }

    function updateIdentificationQuestion($conn, $questionerId, $questioner){
        $updateQuestion  = "UPDATE `question_tbl` SET `question_name` =  '$questioner'WHERE question_id = {$questionerId}";
        mysqli_query($conn, $updateQuestion);
    }

    function  updateIdentificationAnswer($conn, $answerId, $answerselect){
        $updateQuestion  = "UPDATE `answer_tbl` SET `answer_key` =  '$answerselect' WHERE answer_id = {$answerId}";
        mysqli_query($conn, $updateQuestion);
    } 

    function updateTaskGiven($conn, $isGiven,  $taskId){
        $updateTaskGiven  = "UPDATE `task_list_tbl` SET `given` =  '$isGiven' WHERE task_list_id = {$taskId}";
        mysqli_query($conn, $updateTaskGiven);
    }
# --- Update Functions --- end #


# All
function getScore($conn, $taskId, $studentId){
    $scoreQuery = "SELECT * FROM submission_tbl where attempt = ( SELECT MAX(attempt) FROM submitted_answer_tbl ) and fk_task_list_id = $taskId and fk_student_id = $studentId";
    $scoreRow = mysqli_query($conn, $scoreQuery);
    return $studentAnswer = mysqli_fetch_assoc($scoreRow); 
}

function checkTaskCountPerGrading($conn, $subjectListId, $grading){
    $queryTaskCount = "SELECT * FROM task_list_tbl where fk_subject_list_id = $subjectListId and fk_grading_id = $grading";
    if($total_task = mysqli_num_rows(mysqli_query($conn,$queryTaskCount))){
        return $total_task;
    } else {
        return 0;
    }
}
