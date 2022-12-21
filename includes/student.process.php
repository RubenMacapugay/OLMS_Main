<?php session_start(); ?>
<?php 
require_once 'dbh.inc.php';
require_once 'student.function.inc.php';
?>


<?php
//For first question, score will not be there.
if(!isset($_SESSION['score'])){
    $_SESSION['score'] = 0;
}

//redirect to student.task
if(isset($_POST["submitTaskDetails"])){
    // set session here and send this to 
    $_SESSION["task_id"] = $_POST["task_id"];
    $_SESSION["task_type"] = $_POST["task_type"];

    if(!isset($_SESSION['questionCount'])){
        $_SESSION['questionCount'] = 1;
    }

    // echo $_SESSION["task_id"]."<br>";
    // echo $_SESSION["task_type"];
    header("location: ../Main_Project/student/assets/header.view.php"); 
    header("location: ../Main_Project/student/student.task.php");
}

if(isset($_POST['nextQuestion'])){
    $studentId = $_SESSION['student_id'];
    $taskId = $_POST['task_id'];
 	$questionId = $_POST['questionId'];
    $selected_choice = $_POST['choice'];

    // checking if theres no selected radio button
    if($selected_choice == ""){
        header("location: ../Main_Project/student/student.multipleChoice.php?questionId=". $questionId ."&taskId=". $taskId."&msg=missinganswer");
        exit();
    }
    //increment questionCount
    $_SESSION['questionCount'] = $_SESSION['questionCount'] + 1 ;

    //We need total question in process file too
    $total_questions = totalQuestionMultiple($conn, $taskId);

    //Determine the correct choice for current question
    $row = correctAnswer($conn, $questionId);
    $correct_choice = $row['choices_id'];
    
    //print_r($correct_choice);

    // //Increase the score if selected cohice is correct
    if($selected_choice == $correct_choice){
        $_SESSION['score'] = $_SESSION['score'] + 1;
    }

    // save the answer to retrieve when i come back on these question
    $submittedCount = checkSubmittedCount ($conn, $studentId, $taskId);
    $currentAttempt = $submittedCount + 1;
    saveCurrentAnswer($conn,$selected_choice, $currentAttempt, $questionId, $taskId, $studentId);

    // Redirect to next question or final score page
    if($_SESSION['questionCounter'] == $total_questions){
        //save score to variable
        $taskScore = $_SESSION['score'];

        //get the task name
        $taskExists = getTaskName($conn, $taskId);
        $taskName = $taskExists['task_name'];

        //check if theres already submitted task and return the number of rows
        $submittedCount = checkSubmittedCount ($conn, $studentId, $taskId);
        $attempt = $submittedCount + 1;
        $submitted = 'Yes';

        // save the score
        $id = saveScore($conn, $taskName, $taskScore, $attempt, $studentId, $submitted, $taskId);
        $submissionId = $id;

        updateCurrentSubmissionId($conn, $taskId, $attempt, $submissionId);
        
        header("LOCATION: ../Main_Project/student/student.taskresult.php?msg=result&&taskId=$taskId");

    }else{
        $_SESSION['questionCounter'] = $_SESSION['questionCounter'] + 1;

        $row = firstQuestion($conn, $questionId, $taskId);
        header("location: ../Main_Project/student/student.multipleChoice.php?questionId=". $row['question_id']."&taskId=". $taskId);
    }

}


if(isset($_POST['nextIdentificationQuestion'])){
    $studentId = $_SESSION['student_id'];
    $taskId = $_POST['task_id'];
 	$questionId = $_POST['questionId'];
    $identificationAnswer = $_POST['identificationanswer'];

    //check if theres no answer
    if($identificationAnswer == ""){
        header("location: ../Main_Project/student/student.identification.php?questionId=". $questionId ."&taskId=". $taskId."&msg=missinganswer");
        exit();
    }

    //increment questionCount
    $_SESSION['questionCount'] = $_SESSION['questionCount'] + 1 ;

    //We need total question in process file too
    $total_questions = totalQuestionMultiple($conn, $taskId);
    
    //Determine the correct answer for current question
    $answerRow = correctIdentificationAnswer($conn, $questionId);
    $correct_answer = $answerRow['answer_key'];

    //Increase the score if selected cohice is correct
    if($identificationAnswer == $correct_answer){
        $_SESSION['score'] = $_SESSION['score'] + 1;
    }
    
    // to submitted_answer_tbl 
    $submittedCount = checkSubmittedCount ($conn, $studentId, $taskId);
    $currentAttempt = $submittedCount + 1;
    saveCurrentAnswerIdentification($conn, $identificationAnswer, $currentAttempt, $questionId, $taskId, $studentId);

    // Redirect to next question or final score page
    if($_SESSION['questionCounter'] == $total_questions){
        //save score to variable
        $taskScore = $_SESSION['score'];
        
        //get the task name
        $taskExists = getTaskName($conn, $taskId);
        $taskName = $taskExists['task_name'];

        //check if theres already submitted task and return the number of rows
        $submittedCount = checkSubmittedCount ($conn, $studentId, $taskId);
        $attempt = $submittedCount + 1;
        $submitted = 'Yes';

        // save score to submission_tbl
        $id = saveScore($conn, $taskName, $taskScore, $attempt, $studentId, $submitted, $taskId);
        $submissionId = $id;

        updateCurrentSubmissionId($conn, $taskId, $attempt, $submissionId);

        header("LOCATION: ../Main_Project/student/student.taskresult.php?msg=result&&questionId=$questionId&&taskId=$taskId");
    }else{
        $_SESSION['questionCounter'] = $_SESSION['questionCounter'] + 1;
        $nextQuery= mysqli_query($conn, "SELECT * FROM question_tbl WHERE question_id > $questionId order by question_id ASC");
        if($row = mysqli_fetch_array($nextQuery));
        header("location: ../Main_Project/student/student.identification.php?questionId=". $row['question_id']."&taskId=". $taskId);
    }

}


if(isset($_POST['nextTrueOrFalseQuestion'])){
    $studentId = $_SESSION['student_id'];
    $taskId = $_POST['task_id'];
 	$questionId = $_POST['questionId'];
    $selected_choice = $_POST['choice'];

   
    if($selected_choice == ""){
        header("location: ../Main_Project/student/student.trueorfalse.php?questionId=". $questionId ."&taskId=". $taskId."&msg=missinganswer");
        exit();
    }

    //increment questionCount
    $_SESSION['questionCount'] = $_SESSION['questionCount'] + 1 ;

    //We need total question in process file too
    $total_questions = totalQuestion($conn, $taskId);

    $row = correctTruOrFalseAnswer($conn, $questionId);
    $correct_answer = $row['answer_key'];

    if($selected_choice == $correct_answer){
        $_SESSION['score'] = $_SESSION['score'] + 1;
    }

    // to submitted_answer_tbl 
    $submittedCount = checkSubmittedCount ($conn, $studentId, $taskId);
    $currentAttempt = $submittedCount + 1;
    saveCurrentTrueOrFalseAnswer($conn, $selected_choice, $currentAttempt, $questionId, $taskId, $studentId);

    if($_SESSION['questionCounter'] == $total_questions){
        //save score to variable
        $taskScore = $_SESSION['score'];

        //get the task name
        $taskExists = getTaskName($conn, $taskId);
        $taskName = $taskExists['task_name'];

        //check if theres already submitted task and return the number of rows
        $submittedCount = checkSubmittedCount ($conn, $studentId, $taskId);
        $attempt = $submittedCount + 1;
        $submitted = 'Yes';
        
        $id = saveScore($conn, $taskName, $taskScore, $attempt, $studentId, $submitted, $taskId);
        $submissionId = $id;

        updateCurrentSubmissionId($conn, $taskId, $attempt, $submissionId);

        header("LOCATION: ../Main_Project/student/student.taskresult.php?msg=result&&taskId=$taskId");
    }else{
        $_SESSION['questionCounter'] = $_SESSION['questionCounter'] + 1;

        $row = firstQuestion($conn, $questionId, $taskId);
        header("location: ../Main_Project/student/student.trueorfalse.php?questionId=". $row['question_id']."&taskId=". $taskId);
    }

}


## GLOBAL 
if(isset($_POST['submitAnswerCancel'])){
    $taskId = $_POST['task_id'];
    deleteSubmittedAnswer($conn);
    header("location: ../Main_Project/student/student.subjects.php");
}