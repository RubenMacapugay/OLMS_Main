<?php 
session_start();

if(isset($_POST['submitSubjectId'])){
    $subjectId = $_POST['subject_list_id'];
    $_SESSION['subjectId'] = $subjectId;
    echo "success";
    //header("location: assets/header.view.php");
    header("location: student.subjects.php");
}