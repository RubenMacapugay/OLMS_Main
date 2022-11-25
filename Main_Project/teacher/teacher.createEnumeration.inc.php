<?php 
session_start();
include ('../../includes/dbh.inc.php');
require_once 'teacher.enumerationfunction.inc.php';
//print_r($_POST);
//$id = 1;
if(isset($_POST["questioner"])){
    $questioner = $_POST["questioner"];
    // session teacher.createtask.inc.php
    $taskId = $_SESSION["task_id"];
    $insertQuestion = "INSERT INTO question_tbl (question_name, fk_task_list_id) VALUES ('$questioner','$taskId')";

    mysqli_query($conn, $insertQuestion);
    
    $_SESSION['questionCounter'] = $_SESSION['questionCounter'] + 1;
    //$_SESSION["question_name"] = $questioner;

    foreach($_POST['answer_key'] as $key => $value){
        $questionId = questionerExist($conn, $questioner);
        $insertAnswer = "INSERT INTO answer_tbl (fk_question_id, answer_key) VALUES ('$questionId','$value')";
        mysqli_query($conn, $insertAnswer);

    }
    //unset($_SESSION["question_name"]);
    echo 'Question insert successfully!';

}





