<?php

# Answer
function correctAnswer($conn, $questionId){
    $query = "SELECT * FROM choices_tbl WHERE fk_question_id = $questionId AND is_correct = 1";
    $result = mysqli_query($conn,$query);

    if($row = mysqli_fetch_assoc($result)){
        return $row;
    } else{
        return false;
    }

}

function correctTruOrFalseAnswer($conn, $questionId){
    $query = "SELECT * FROM answer_tbl WHERE fk_question_id = $questionId";
    $result = mysqli_query($conn,$query);

    if($row = mysqli_fetch_assoc($result)){
        return $row;
    } else{
        return false;
    }
}

function correctIdentificationAnswer($conn, $questionId){
    $queryAnswer = "SELECT * FROM answer_tbl WHERE fk_question_id = $questionId";
	$answer = mysqli_query($conn,$queryAnswer);
    return $answerRow = mysqli_fetch_assoc($answer);
}


# Question
function totalQuestionMultiple($conn, $taskId){
    $queryTotalQuestion = "SELECT * FROM question_tbl where fk_task_list_id = $taskId";
    return $total_questions = mysqli_num_rows(mysqli_query($conn,$queryTotalQuestion));
}

function totalQuestion($conn, $taskId){
    $queryTotalQuestion = "SELECT * FROM question_tbl where fk_task_list_id = $taskId";
    return $total_questions = mysqli_num_rows(mysqli_query($conn,$queryTotalQuestion));
}

function firstQuestion($conn, $questionId, $taskId){
    $result = '';
    $nextQuery= mysqli_query($conn, "SELECT * FROM question_tbl WHERE question_id > $questionId AND fk_task_list_id = $taskId order by question_id ASC");
    if($row = mysqli_fetch_array($nextQuery)){
        $result = $row;
    }else{
        $result = false;
    }
    return $result;
}


# Retrieve or Select

#region
// function getCurrentSubmittedAnswerAttemptRow($conn,$taskId, $studentId){
//     $submittedQuery = "SELECT * FROM submitted_answer_tbl WHERE attempt = ( SELECT MAX(attempt) FROM submitted_answer_tbl ) AND fk_task_list_id = $taskId and fk_student_id = $studentId";
//     return $submittedAnswers = mysqli_query($conn,$submittedQuery);
    
// }
#endregion

function getTaskName($conn, $taskId){
    #query
    $selectTaskName = "SELECT * FROM task_list_tbl where task_list_id = ?;";

    # start the preapred statement
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $selectTaskName)){
        header ('location: ../Main_Project/student/teacher.multipleChoice.php?error=selectstmtfailed');
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
        $result = false; 
        return false;
    }

    # close the statement
    mysqli_stmt_close($stmt);
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

function checkSubmittedCount($conn, $studentId, $taskId){
    $queryTotalQuestion = "SELECT * FROM submission_tbl where fk_student_id = $studentId and fk_task_list_id = $taskId";
    if($total_questions = mysqli_num_rows(mysqli_query($conn,$queryTotalQuestion))){
        return $total_questions;
    } else {
        return 0;
    }
}

function checkTaskCountPerGrading($conn, $subjectListId, $grading){
    $queryTaskCount = "SELECT * FROM task_list_tbl where fk_subject_list_id = $subjectListId and fk_grading_id = $grading and given = 'Yes'";
    if($total_task = mysqli_num_rows(mysqli_query($conn,$queryTaskCount))){
        return $total_task;
    } else {
        return 0;
    }
}

function getMaxAttempt($conn, $taskId, $studentId){
    $sql = "SELECT MAX(attempt) FROM submitted_answer_tbl where fk_task_list_id = $taskId and fk_student_id = $studentId";
    $attemptRow = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($attemptRow);
    return $result['MAX(attempt)'];
}

function getScore($conn, $taskId, $maxAttempt, $studentId){
    $scoreQuery = "SELECT * FROM submission_tbl where attempt = $maxAttempt and fk_task_list_id = $taskId and fk_student_id = $studentId";
    $scoreRow = mysqli_query($conn, $scoreQuery);
    return $studentAnswer = mysqli_fetch_assoc($scoreRow);
   
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

function getModuleSection($conn, $subjectId, $gradingId){
    $selectModuleSectionFirstGrading = "SELECT * FROM module_section_tbl WHERE (fk_grading_id = $gradingId AND fk_subject_list_id = $subjectId)";
    $resultModuleSectionFirstGrading =  $conn->query($selectModuleSectionFirstGrading) or die ($mysqli->error);
    return $resultModuleSectionFirstGrading;
}

function getTasksPerGrading($conn, $studentId, $subjectId, $gradingId, $moduleSectionId){
    $selectStudentTasksFirstGrading = "SELECT * FROM task_list_tbl LEFT JOIN submission_tbl ON submission_tbl.fk_task_list_id = task_list_tbl.task_list_id AND submission_tbl.fk_student_id = $studentId AND task_list_tbl.fk_subject_list_id = $subjectId AND submission_tbl.attempt = (SELECT MAX(attempt) FROM submitted_answer_tbl) WHERE task_list_tbl.fk_grading_id = $gradingId and task_list_tbl.fk_module_section_id = $moduleSectionId";
    $resultTasksFirstGrading =  $conn->query($selectStudentTasksFirstGrading) or die ($mysqli->error); 
    return $resultTasksFirstGrading;
}

function getSubjectToDoCount($conn, $subjectId, $studentId){
    $sql = 
    "SELECT COUNT(*) as NotChecked_COUNT, subject_list_tbl.subject_list_name, submission_tbl.fk_student_id
    FROM task_list_tbl 
    RIGHT JOIN submission_tbl ON submission_tbl.fk_task_list_id = task_list_tbl.task_list_id
    LEFT JOIN subject_list_tbl ON subject_list_tbl.subject_list_id = task_list_tbl.fk_subject_list_id
    WHERE task_list_tbl.sub_type = 3 AND score IS NULL and subject_list_tbl.subject_list_id = $subjectId and submission_tbl.fk_student_id = $studentId";
    $result = mysqli_query($conn, $sql);
    return $studentAnswer = mysqli_fetch_assoc($result);

}



function getCurrentAttemptAnswer($conn, $taskId){
    $submittedQuery = "SELECT * FROM submitted_answer_tbl WHERE attempt = ( SELECT MAX(attempt) FROM submitted_answer_tbl ) AND fk_task_list_id = $taskId";
    $submittedAnswers = mysqli_query($conn,$submittedQuery);
    return $submittedAnswewrRow = mysqli_fetch_assoc($submittedAnswers);
}

function getQuestionById($conn, $questionId){
    $questionQuery = "SELECT * FROM question_tbl WHERE question_id = '$questionId'";
    $questionRow = mysqli_query($conn,$questionQuery);
    $currentQuestion = mysqli_fetch_assoc($questionRow); 
    return $currentQuestion;
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

function getCurrentSubmissionIdRow($conn, $taskId, $studentId){
    $submittedQuery = "SELECT * FROM submission_tbl WHERE attempt = ( SELECT MAX(attempt) FROM submission_tbl ) AND fk_task_list_id = $taskId and fk_student_id = $studentId";
    $submittedAnswers = mysqli_query($conn,$submittedQuery);

    if($result = mysqli_fetch_assoc($submittedAnswers)){
       return $result; 
    } else {
        return false;
    }
     
}

function getCorrectAnswerIdentification($conn, $questionId){
    $sql = "SELECT * from answer_tbl where fk_question_id = $questionId";
    $correctAnswer = mysqli_query($conn,$sql);
    return $result = mysqli_fetch_assoc($correctAnswer); 
}

function getSubjectData($conn, $studentId, $subjectId){
    $selectStudentSubjects = "SELECT section_tbl.section_name, section_tbl.section_id, subject_tbl.subject_name, subject_list_tbl.subject_list_name, gradelevel_tbl.grade_level_name FROM ((((subject_list_tbl INNER JOIN section_tbl ON subject_list_tbl.fk_section_id = section_tbl.section_id)  INNER JOIN student_subjects_tbl ON student_subjects_tbl.fk_subject_list_id = subject_list_tbl.subject_list_id) INNER JOIN gradelevel_tbl ON gradelevel_tbl.grade_level_id = section_tbl.fk_grade_level_id) INNER JOIN subject_tbl ON subject_tbl.subject_id = student_subjects_tbl.fk_subject_list_id) WHERE student_subjects_tbl.fk_student_id = $studentId and subject_tbl.subject_id = $subjectId";
    $correctAnswer = mysqli_query($conn, $selectStudentSubjects);
    return $result = mysqli_fetch_assoc($correctAnswer); 
}

function getFileSize($size){
    $kb_size = $size / 1024;
    $format_size = number_format($kb_size, 2) ; //. ' KB'
    return $format_size;
}



# Create/Insert
function saveCurrentAnswer($conn, $selected_choice, $currentAttempt, $questionId, $taskId, $studentId){
    $insertCurrentAnswer = "INSERT INTO submitted_answer_tbl (submitted_answer_choice, attempt, fk_question_id, fk_task_list_id, fk_student_id) values ($selected_choice, $currentAttempt, $questionId, $taskId, $studentId)";
    $currentSubmittedAnswer = mysqli_query($conn, $insertCurrentAnswer);
}

function saveCurrentAnswerIdentification($conn, $identificationAnswer, $currentAttempt, $questionId, $taskId, $studentId){
    $insertCurrentAnswer = "INSERT INTO submitted_answer_tbl (submitted_answer_key, attempt, fk_question_id, fk_task_list_id, fk_student_id) values ('$identificationAnswer', $currentAttempt, $questionId, $taskId, $studentId)";
    $currentSubmittedAnswer = mysqli_query($conn, $insertCurrentAnswer);
}

function saveCurrentTrueOrFalseAnswer($conn, $selected_choice, $currentAttempt, $questionId, $taskId, $studentId){
    if($selected_choice == "True"){
        $insertCurrentAnswer = "INSERT INTO submitted_answer_tbl (submitted_answer_key, attempt, fk_question_id, fk_task_list_id, fk_student_id) values ('True', $currentAttempt, $questionId, $taskId, $studentId)";
        mysqli_query($conn, $insertCurrentAnswer);
    }else if($selected_choice == "False"){
        $insertCurrentAnswer = "INSERT INTO submitted_answer_tbl (submitted_answer_key, attempt, fk_question_id, fk_task_list_id, fk_student_id) values ('False', $currentAttempt, $questionId, $taskId, $studentId)";
        mysqli_query($conn, $insertCurrentAnswer);
    }
}

function saveEssayAnswer($conn, $questionAnswer, $currentAttempt, $questionId, $taskId, $studentId, $filename, $filepath){
    $insertCurrentAnswer = "INSERT INTO submitted_answer_tbl (submitted_answer_key, attempt, fk_question_id, fk_task_list_id, fk_student_id, submitted_filename, submitted_filepath) values ('$questionAnswer', $currentAttempt, $questionId, $taskId, $studentId, '$filename', '$filepath')";
    $currentSubmittedAnswer = mysqli_query($conn, $insertCurrentAnswer);
}

function saveEssayAnswerNoFile($conn, $questionAnswer, $currentAttempt, $questionId, $taskId, $studentId){
    $insertCurrentAnswer = "INSERT INTO submitted_answer_tbl (submitted_answer_key, attempt, fk_question_id, fk_task_list_id, fk_student_id) values ('$questionAnswer', $currentAttempt, $questionId, $taskId, $studentId)";
    $currentSubmittedAnswer = mysqli_query($conn, $insertCurrentAnswer);
}

function saveScore($conn, $taskName, $taskScore, $attempt, $studentId, $submitted, $taskId, $date_Today, $current_time){
    $saveScore = "INSERT INTO submission_tbl (submission_name, score, attempt, fk_student_id, submitted, fk_task_list_id, submission_date, submission_time) values ('$taskName', '$taskScore', '$attempt', '$studentId', '$submitted', '$taskId', '$date_Today', '$current_time')";
    // $resultScore = mysqli_query($conn, $saveScore);
    $resultScore = $conn->query($saveScore);

    $id = mysqli_insert_id($conn);

    return $id;
}

function saveEssayNoScore($conn, $taskName, $attempt, $studentId, $submitted, $taskId, $date_Today, $current_time){
    $saveScore = "INSERT INTO submission_tbl (submission_name, attempt, fk_student_id, submitted, fk_task_list_id, submission_date, submission_time) values ('$taskName', '$attempt', '$studentId', '$submitted', '$taskId', '$date_Today', '$current_time')";
    // $resultScore = mysqli_query($conn, $saveScore);
    $resultScore = $conn->query($saveScore);

    $id = mysqli_insert_id($conn);

    return $id;
}

# Update 
function updateCurrentSubmissionId($conn, $taskId, $attempt, $submissionTblId, ){
    $updateQuery = "UPDATE submitted_answer_tbl SET fk_submission_tbl_id = '$submissionTblId' where fk_task_list_id = '$taskId' and attempt = '$attempt'";
    $resultScore = mysqli_query($conn, $updateQuery);
}

function updateTaskGiven($conn, $isGiven,  $taskId){
    $updateTaskGiven  = "UPDATE `task_list_tbl` SET `given` =  '$isGiven' WHERE task_list_id = {$taskId}";
    mysqli_query($conn, $updateTaskGiven);
}

# Delete 
function deleteSubmittedAnswer($conn){
    $sql = "DELETE FROM submitted_answer_tbl WHERE fk_submission_tbl_id is null";
    $resultScore = mysqli_query($conn, $sql);
    unset($_SESSION['questionCount']);
}

# boolean
function isDeadline($date_Today, $endDate, $newTaskTimeFormat){
    if( (($date_Today == $endDate) && (time() >= strtotime($newTaskTimeFormat))) ||
        ($date_Today > $endDate)){
        # echo $rowFirstGrading['task_name'].'Time na<br>';
        return true;
    }else{
        return false;
    }
}

function isNearDeadline($date_Today, $endDate, $newTaskTimeFormat){
    if( (($date_Today == $endDate) && (time() <= strtotime($newTaskTimeFormat))) ||
        ($date_Today < $endDate)){
        # echo $rowFirstGrading['task_name'].'Time na<br>';
        return true;
    }else{
        return false;
    }
}

function isGiven($value){
    if($value == "Yes"){
        return true;
    }else if ($value == ""){
        return false;
    }else{
        return false;
    }
}

function isAttemptReached($taskMaxAttempt, $maxAttempt){
    if($taskMaxAttempt > $maxAttempt){
        return true;
    }else{
        return false;
    }
}

