<?php 
require_once ('query.inc.php'); 
# teacher.createtask..php 

date_default_timezone_set('Asia/Manila');
$date_Today = date("Y-m-d");

// echo $date_Today;

# --- isEmpty Functions --- #
    function emptyEssayTask($grading, $moduleSection, $taskname, $tasktype, $subtype, $datecreated, $datedeadline, $time, $maxscore, $maxattempts, $allowlate){
        if(empty($grading) ||
            !is_numeric($moduleSection) ||
            empty($taskname) ||
            // empty($taskcontent) ||
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

    function emptyWithAnswerTask($grading, $moduleSection, $taskname, $questionitems, $tasktype, $subtype, $datecreated, $datedeadline, $time, $maxattempts, $allowlate){
        if(
            empty($grading) ||
            !is_numeric($moduleSection) ||
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
        if(empty($questioner) || empty($answerselect) || empty($choiceA) || empty($choiceB) || empty($choiceC) || empty($choiceD)){
            $result = true;
        } else{
            $result = false;
        }

        return $result;

    } 

    function emptyInputIdentification($identificationAnswer, $identificationQuestion){
        if(empty($identificationAnswer) || empty($identificationQuestion)){
            $result = true;
        } else{
            $result = false;

        }
        return $result;
    }

    function emptyInputTrueOrFalse($trueOrFalseQuestion, $trueOrFalseAnswer){
        if(empty($trueOrFalseQuestion) || $trueOrFalseAnswer == "" ){
            $result = true;
        } else{
            $result = false;

        }
        return $result;
    }

    function emptyEssayContent($questionContent){
        if(empty($questionContent)){
            return true;
        }else{
            return false;
        }
    }

    function validateDate($date, $format = 'm-d-Y'){
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }
# --- isEmpty Functions --- end #

# --- Exists Functions --- #
function teacherSubjectExist2($conn, $subjectId, $sectionId, $teacherId){
    $selectSubject = "SELECT * FROM (((subject_list_tbl INNER JOIN section_tbl ON subject_list_tbl.fk_section_id = section_tbl.section_id) INNER JOIN gradelevel_tbl ON gradelevel_tbl.grade_level_id = section_tbl.fk_grade_level_id) INNER JOIN subject_tbl ON subject_tbl.subject_id = subject_list_tbl.fk_subject_id) WHERE subject_list_tbl.fk_teacher_id = $teacherId and subject_list_tbl.subject_list_id = $subjectId AND subject_list_tbl.fk_section_id = $sectionId";
    $row = mysqli_query($conn, $selectSubject);
    return $result = mysqli_fetch_assoc($row); 
}
function teacherSubjectExist($conn, $subjectId, $sectionId, $teacherId){
    // $selectSubject = "SELECT * FROM (((subject_list_tbl INNER JOIN section_tbl ON subject_list_tbl.fk_section_id = section_tbl.section_id) INNER JOIN gradelevel_tbl ON gradelevel_tbl.grade_level_id = section_tbl.fk_grade_level_id) INNER JOIN subject_tbl ON subject_tbl.subject_id = subject_list_tbl.fk_subject_id) WHERE subject_list_tbl.fk_teacher_id = $teacherId and subject_tbl.subject_id = $subjectId AND subject_list_tbl.fk_section_id = 1";
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

function essayContentExist($conn, $taskListId, $questionContent){
    $selectQuestionContent = "SELECT * FROM question_tbl WHERE fk_task_list_id = ? AND question_name = ?;";

    # prepare the statement
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $selectQuestionContent)){
        header ('location: ../Main_Project/teacher/teacher.createquestioner.php?error=selectstmtfailed');
        exit();
    }

    # binding user input
    mysqli_stmt_bind_param($stmt, "is", $taskListId, $questionContent);
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

function essayFileExist($conn, $taskListId, $filename){
    $selectQuestionContent = "SELECT * FROM question_tbl WHERE fk_task_list_id = ? AND question_filename = ?;";

    # prepare the statement
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $selectQuestionContent)){
        header ('location: ../Main_Project/teacher/teacher.createquestioner.php?error=selectstmtfailed');
        exit();
    }

    # binding user input
    mysqli_stmt_bind_param($stmt, "is", $taskListId, $filename);
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

function getQuestionName($conn, $questionId){
    $selectQuestionName = "SELECT * FROM question_tbl WHERE question_id = ?";

    # prepare the statement
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $selectQuestionName)){
        header ('location: ../Main_Project/teacher/teacher.createquestioner.php?error=selectstmtfailed');
        exit();
    }

    # binding user input
    mysqli_stmt_bind_param($stmt, "i", $questionId);
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

function moduleNameExist($conn, $moduleSectionName, $gradingId, $subjectId){
    #query
    $selectModuleSectionName = "SELECT * FROM module_section_tbl where module_section_name = ? and fk_grading_id  = ? and fk_subject_list_id = ?;";

    # start the preapred statement
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $selectModuleSectionName)){
        header ('location: ../Main_Project/teacher/teacher.createtask.php?error=selectstmtfailed');
        exit();
    }
    
    # binding user input
    mysqli_stmt_bind_param($stmt, "sii", $moduleSectionName, $gradingId, $subjectId);
    mysqli_stmt_execute($stmt);

    # save result
    $resultData = mysqli_stmt_get_result($stmt);

    # check if theres returned data
    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    } else{
        return false;
    }

    # close the statement
    mysqli_stmt_close($stmt);
}

function getModuleName($conn, $id){
    $sql = "SELECT * FROM module_section_tbl where module_section_id = '$id'";
    $row = mysqli_query($conn, $sql);
    return $result = mysqli_fetch_assoc($row); 
}
# --- Exists Functions --- end #


# --- Create Functions --- #
    function createTask($conn, $subjectId, $grading, $moduleSection, $taskname, $questionitems, $tasktype, $subtype, $datecreated, $datedeadline, $time_created, $time, $maxattempts, $allowlate){
        
        $sqlInsertTask = "INSERT INTO `task_list_tbl` (`fk_subject_list_id`, `fk_grading_id`, `fk_module_section_id`, `task_name`, `question_item`, `fk_task_type`, `sub_type`, `date_created`, `date_deadline`, `time_created`, `time_limit`, `max_attempts`, `submission_choice`) 
            VALUES ('$subjectId', '$grading', '$moduleSection', '$taskname', '$questionitems', '$tasktype', '$subtype', '$datecreated', '$datedeadline', '$time_created', '$time', '$maxattempts', '$allowlate')";
        
        mysqli_query($conn, $sqlInsertTask);

        echo 'success';
    }

    function createNoQuestion($conn, $subjectId, $grading, $moduleSection, $taskname, $tasktype, $subtype, $datecreated, $datedeadline, $time_created, $time, $maxscore, $maxattempts, $allowlate){

        // I need to capture the subject ID
        $sqlInsertTask = "INSERT INTO `task_list_tbl` (`fk_subject_list_id`, `fk_grading_id`, `fk_module_section_id`, `task_name`, `fk_task_type`, `sub_type`, `date_created`, `time_created`, `date_deadline`, `time_limit`, `max_score`, `max_attempts`, `submission_choice`) 
            VALUES ('$subjectId', '$grading', '$moduleSection', '$taskname', '$tasktype', '$subtype', '$datecreated', '$time_created', '$datedeadline', '$time', '$maxscore', '$maxattempts', '$allowlate')";
        
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

    function createEssayContent($conn, $taskListId, $questionContent, $filename, $filepath){
        $insertQuestion = "INSERT INTO `question_tbl`(`fk_task_list_id`, `question_name`, `question_filename`, `question_filepath`) VALUES (?, ?, ?, ?);";
        # start the prepared statement
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $insertQuestion)){
            header ('location: ../Main_Project/teacher/teacher.createEssay.php?error=stmtfailed');
            return false;
            exit();
        } 

        # binding user input
        mysqli_stmt_bind_param($stmt, "isss", $taskListId, $questionContent, $filename, $filepath);    
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return true;
    }
    
    function createEssayContentNoFile($conn, $taskListId, $questionContent){
        $insertQuestion = "INSERT INTO `question_tbl`(`fk_task_list_id`, `question_name`) VALUES (?, ?);";
        # start the prepared statement
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $insertQuestion)){
            header ('location: ../Main_Project/teacher/teacher.createEssay.php?error=stmtfailed');
            return false;
            exit();
        } 

        # binding user input
        mysqli_stmt_bind_param($stmt, "is", $taskListId, $questionContent);    
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return true;
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

    function createModuleSection($conn, $moduleSectionName, $moduleSectionDesc, $subjectId, $gradingId){
        $sql = "INSERT INTO module_section_tbl (module_section_name, module_section_desc, fk_subject_list_id, fk_grading_id) VALUES ('$moduleSectionName', '$moduleSectionDesc', $subjectId, $gradingId)";
        
        $resultScore = $conn->query($sql);

        $id = mysqli_insert_id($conn);

        return $id;
    
    }
    
    function saveEssayScore($conn, $score, $submissionId){
        $saveScore = "UPDATE `submission_tbl` SET `score`='$score' WHERE submission_id = $submissionId";
        // $resultScore = mysqli_query($conn, $saveScore);
        $resultScore = $conn->query($saveScore);
    
        $id = mysqli_insert_id($conn);
    
        return $id;
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
        $updateQuestion  = "UPDATE question_tbl SET question_name = '$questioner' WHERE question_id = {$questionerId}";
        mysqli_query($conn, $updateQuestion);
    }

    function  updateAnswerKey($conn, $answerId, $answerselect){
        $updateQuestion  = "UPDATE `answer_tbl` SET `answer_key` =  {$answerselect} WHERE answer_id = {$answerId}";
        mysqli_query($conn, $updateQuestion);
    }

    function updateTrueOrFalseAnswer($conn, $answerID, $answer){
        echo $answerID;
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
        $updateQuestion  = "UPDATE `question_tbl` SET `question_name` = '$questioner'WHERE question_id = {$questionerId}";
        mysqli_query($conn, $updateQuestion);
    }

    function  updateIdentificationAnswer($conn, $answerId, $answerselect){
        $updateQuestion  = "UPDATE `answer_tbl` SET `answer_key` =  '$answerselect' WHERE answer_id = {$answerId}";
        mysqli_query($conn, $updateQuestion);
    } 

    function updateEssayQuestion($conn, $questionerId, $questioner, $filename, $filepath){
        $updateQuestion  = "UPDATE `question_tbl` SET `question_name` = '$questioner', `question_filename` = '$filename', `question_filepath` = '$filepath' WHERE question_id = {$questionerId}";
        mysqli_query($conn, $updateQuestion);
    }

    function updateTaskGiven($conn, $isGiven,  $taskId){
        $updateTaskGiven  = "UPDATE `task_list_tbl` SET `given` =  '$isGiven' WHERE task_list_id = {$taskId}";
        mysqli_query($conn, $updateTaskGiven);
    }

    function updateTaskQuestionCount($conn, $taskId, $questionNumber){
        $updateTaskQuestionCount  = "UPDATE `task_list_tbl` SET `question_item` =  '$questionNumber' WHERE task_list_id = {$taskId}";
        mysqli_query($conn, $updateTaskQuestionCount);
    }

    function updateModuleSection($conn, $moduleSectionId, $moduleSectionName, $moduleSectionDesc){
        $sql  = "UPDATE `module_section_tbl` SET `module_section_name`='$moduleSectionName',`module_section_desc`='$moduleSectionDesc' WHERE module_section_id = {$moduleSectionId}";
        mysqli_query($conn, $sql);
    }

    function updateTaskMultipleChoice($conn, $taskId, $taskname, $datedeadline, $timelimit, $maxattempts, $submissionchoice){
        $updateTaskGiven  = "UPDATE `task_list_tbl` SET `task_name` =  '$taskname', `date_deadline` =  '$datedeadline', `time_limit` =  '$timelimit', `max_attempts` =  '$maxattempts', `submission_choice` = '$submissionchoice' WHERE task_list_id = {$taskId}";
        mysqli_query($conn, $updateTaskGiven);
    }

    function updateTaskEssay($conn, $taskId, $taskname, $datedeadline, $timelimit, $maxattempts, $maxscore, $submissionchoice){
        $updateTaskGiven  = "UPDATE `task_list_tbl` SET `task_name` =  '$taskname', `date_deadline` =  '$datedeadline', `time_limit` =  '$timelimit', `max_attempts` =  '$maxattempts', `max_score` =  '$maxscore', `submission_choice` = '$submissionchoice' WHERE task_list_id = {$taskId}";
        mysqli_query($conn, $updateTaskGiven);
    }
# --- Update Functions --- end #


#region --- Retrieve ---#
function getScore($conn, $taskId, $studentId){
    $scoreQuery = "SELECT * FROM submission_tbl where attempt = ( SELECT MAX(attempt) FROM submitted_answer_tbl ) and fk_task_list_id = $taskId and fk_student_id = $studentId";
    $scoreRow = mysqli_query($conn, $scoreQuery);
    return $studentAnswer = mysqli_fetch_assoc($scoreRow); 
}



function getModuleSection($conn, $subjectId, $gradingId){
    $selectModuleSectionPerGrading = "SELECT * FROM module_section_tbl WHERE (fk_grading_id = $gradingId AND fk_subject_list_id = $subjectId)";
    $resultModuleSection =  $conn->query($selectModuleSectionPerGrading) or die ($mysqli->error);
    return $resultModuleSection;
}

function getTasks($conn, $subjectId, $teacherId){
    $selectTaskListStudentsSection = "SELECT * FROM ((subject_list_tbl INNER JOIN task_list_tbl ON subject_list_tbl.subject_list_id = task_list_tbl.fk_subject_list_id)) WHERE subject_list_id = $subjectId and fk_teacher_id = $teacherId";
    $resultTaskList =  $conn->query($selectTaskListStudentsSection) or die ($mysqli->error);
    return $resultTaskList;
}

function getSubjectToGradeCount($conn, $subjectId){
    $selectSubjectToGradeCount = 
        "SELECT COUNT(*) as NotChecked_COUNT, subject_list_tbl.subject_list_name
        FROM task_list_tbl 
        RIGHT JOIN submission_tbl ON submission_tbl.fk_task_list_id = task_list_tbl.task_list_id
        LEFT JOIN subject_list_tbl ON subject_list_tbl.subject_list_id = task_list_tbl.fk_subject_list_id
        WHERE task_list_tbl.sub_type = 3 AND score IS NULL and subject_list_tbl.subject_list_id = $subjectId";
        $result = mysqli_query($conn, $selectSubjectToGradeCount);
        return $studentAnswer = mysqli_fetch_assoc($result);
}

function getTaskCountNotGraded($conn, $subjectId){
    $sql = 
    "SELECT task_list_tbl.task_list_id, task_list_tbl.task_name, COUNT(*) as not_graded_count 
    FROM task_list_tbl 
    left JOIN submission_tbl ON task_list_tbl.task_list_id = submission_tbl.fk_task_list_id 
    WHERE submission_tbl.score is null 
    AND task_list_tbl.fk_subject_list_id = $subjectId 
    GROUP BY task_list_tbl.task_list_id";
    $result =  $conn->query($sql) or die ($mysqli->error);
    return $result;

}
function getMaxAttempt2($conn, $taskId, $studentId){
    $sql = "SELECT MAX(attempt) FROM submission_tbl where fk_task_list_id = $taskId and fk_student_id = $studentId";
    $resultQuery = mysqli_query($conn, $sql);
    // return mysqli_fetch_assoc($result);
    $result = '';
    if($row = mysqli_fetch_array($resultQuery)){
        $result = $row;
    }else{
        $result = "No data";
    }
    return $result;

}

function getMaxAttempt($conn, $taskId, $studentId){
    $sql = "SELECT MAX(attempt) FROM submitted_answer_tbl where fk_task_list_id = $taskId and fk_student_id = $studentId";
    $attemptRow = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($attemptRow);
    return $result['MAX(attempt)'];
}

function getMaxScore($conn, $taskId, $maxAttempt, $studentId){
    $scoreQuery = "SELECT * FROM submission_tbl where attempt = $maxAttempt and fk_task_list_id = $taskId and fk_student_id = $studentId";
    $scoreRow = mysqli_query($conn, $scoreQuery);
    return $studentAnswer = mysqli_fetch_assoc($scoreRow);

   
}

function getCurrentTask($conn, $taskId){
    #query
    $selectTaskName = "SELECT * FROM task_list_tbl where task_list_id = ?;";

    # start the preapred statement
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $selectTaskName)){
        header ('location: ../Main_Project/student/student.task.php?error=tasknotexist');
        exit();
    }
    
    # binding user input
    mysqli_stmt_bind_param($stmt, "i", $taskId);
    mysqli_stmt_execute($stmt);

    # save result
    $resultData = mysqli_stmt_get_result($stmt);

    # check if theres returned data
    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    } else{
        return false;
    }

    # close the statement
    mysqli_stmt_close($stmt);
}

function getChoicesRow($conn, $quesionId){
    $query = "SELECT * FROM choices_tbl WHERE fk_question_id = $quesionId";
    $choices = mysqli_query($conn,$query);
    return $choices;
}

function getSubmittedAnswerRow($conn,$taskId, $studentId, $maxAttempt){
    $submittedQuery = "SELECT * FROM submitted_answer_tbl WHERE attempt = $maxAttempt AND fk_task_list_id = $taskId and fk_student_id = $studentId";
    return $submittedAnswers = mysqli_query($conn,$submittedQuery);
}

function getQuestionById($conn, $questionId){
    $questionQuery = "SELECT * FROM question_tbl WHERE question_id = '$questionId'";
    $questionRow = mysqli_query($conn,$questionQuery);
    $currentQuestion = mysqli_fetch_assoc($questionRow); 
    return $currentQuestion;
}

function getCorrectAnswerIdentification($conn, $questionId){
    $sql = "SELECT * from answer_tbl where fk_question_id = $questionId";
    $correctAnswer = mysqli_query($conn,$sql);
    return $result = mysqli_fetch_assoc($correctAnswer); 
}

function getAttempts($conn, $taskId, $studentId){
    $sql = 
    "SELECT * FROM submission_tbl 
    LEFT JOIN task_list_tbl 
    ON submission_tbl.fk_task_list_id = task_list_tbl.task_list_id
    where fk_task_list_id = $taskId 
    and fk_student_id = $studentId";
    $resultTaskList =  $conn->query($sql) or die ($mysqli->error);
    return $resultTaskList;
}

function getScore2($conn, $taskId, $maxAttempt, $studentId){
    $sql = "SELECT * FROM submission_tbl where attempt = $maxAttempt and fk_task_list_id = $taskId and fk_student_id = $studentId";
    $resultQuery = mysqli_query($conn, $sql);
    // return mysqli_fetch_assoc($result);
    if($row = mysqli_fetch_array($resultQuery)){
        return $row;
    }else{
        return false;
    }

}

function getTasksPerGrading($conn, $subjectId, $gradingId){
    $selectTeacherTasksPerGrading = "SELECT * FROM task_list_tbl WHERE (fk_grading_id = $gradingId AND fk_subject_list_id = $subjectId)";
    $resultTasksPerGrading =  $conn->query($selectTeacherTasksPerGrading) or die ($mysqli->error);
    return $resultTasksPerGrading;
}

function getSubjectStudents($conn){
    $selectStudentsSubjectSection = "SELECT * FROM student_tbl";
    $result =  $conn->query($selectStudentsSubjectSection) or die ($mysqli->error);
    return $result;

}

function getStudentSubnmissionList($conn, $taskId){
    $selectTeacherTasksPerGrading = 
    "SELECT Count(*) as myCount, student_tbl.student_name as student, student_tbl.student_id as id
    FROM student_tbl 
    right JOIN submission_tbl ON submission_tbl.fk_student_id = student_tbl.student_id 
    WHERE submission_tbl.score is null 
    AND fk_task_list_id = $taskId
    GROUP BY student_tbl.student_id";
    $resultTasksPerGrading =  $conn->query($selectTeacherTasksPerGrading) or die ($mysqli->error);
    return $resultTasksPerGrading;
}
function getStudent($conn, $studentId){
    $selectStudentsSubjectSection = "SELECT * FROM student_tbl WHERE student_id = $studentId";
    $row = mysqli_query($conn, $selectStudentsSubjectSection);
    return $result = mysqli_fetch_assoc($row); 
}

function getSubjectStudentsProgress($conn, $sectionId, $subjectId){
    // $sql = "SELECT COUNT(DISTINCT fk_task_list_id) AS Task_Completed, student_tbl.student_name AS student_name, student_tbl.student_date_enrolled AS student_date_enrolled FROM student_tbl LEFT JOIN submission_tbl ON submission_tbl.fk_student_id = student_tbl.student_id  GROUP BY student_tbl.student_id";
    $sql = "SELECT COUNT(DISTINCT fk_task_list_id) AS Task_Completed, student_tbl.student_name AS student_name, student_tbl.student_date_enrolled AS student_date_enrolled, student_tbl.student_id AS student_id
    FROM student_tbl 
    LEFT JOIN submission_tbl ON submission_tbl.fk_student_id = student_tbl.student_id
    LEFT JOIN student_subjects_tbl ON student_subjects_tbl.fk_student_id = student_tbl.student_id
    WHERE student_tbl.fk_section_id = $sectionId 
    AND student_subjects_tbl.fk_subject_list_id = $subjectId
    GROUP BY student_tbl.student_id";
    $result =  $conn->query($sql) or die ($mysqli->error);
    
    return $result;
}

function getSubjectsStudentList($conn, $sectionId, $subjectId){
    // $sql = "SELECT *
    // FROM student_tbl 
    // LEFT JOIN student_subjects_tbl ON student_subjects_tbl.fk_student_id = student_tbl.student_id
    // WHERE student_tbl.fk_section_id = $sectionId 
    // AND student_subjects_tbl.fk_subject_list_id = $subjectId
    // GROUP BY student_tbl.student_id";
    
    $sql = "SELECT * from student_tbl 
    left join student_subjects_tbl ON student_subjects_tbl.fk_student_id = student_tbl.student_id
    left join subject_list_tbl ON subject_list_tbl.subject_list_id = student_subjects_tbl.fk_subject_list_id
    left join section_tbl ON subject_list_tbl.fk_section_id = section_tbl.section_id
    where student_subjects_tbl.fk_subject_list_id = $subjectId
    AND section_tbl.section_id = $sectionId
    GROUP by student_tbl.student_id";
    $result =  $conn->query($sql) or die ($mysqli->error);
    return $result;
}

function getFileSize($size){
    $kb_size = $size / 1024;
    $format_size = number_format($kb_size, 2) ; //. ' KB'
    return $format_size;
}

function getSubmittedWithFile(){
    
}

function checkTotalTaskCount($conn, $subjectId){
    $queryTaskCount = "SELECT * FROM task_list_tbl where fk_subject_list_id = $subjectId";
    if($total_task = mysqli_num_rows(mysqli_query($conn,$queryTaskCount))){
        return $total_task;
    } else {
        return 0;
    }
}

function checkTaskCountPerGrading($conn, $subjectListId, $grading){
    $queryTaskCount = "SELECT * FROM task_list_tbl where fk_subject_list_id = $subjectListId and fk_grading_id = $grading";
    if($total_task = mysqli_num_rows(mysqli_query($conn,$queryTaskCount))){
        return $total_task;
    } else {
        return 0;
    }
}



#endregion --- Retrieve --- end #
