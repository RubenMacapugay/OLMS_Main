<?php session_start();

if(isset($_POST['submitSubjectId'])){
    $subjectId = $_POST['subject_list_id'];
    $sectionId = $_POST['section_id'];
    $_SESSION['subjectId'] = $subjectId;
    $_SESSION['section_id'] = $sectionId;
    echo $_SESSION['subjectId']." success";
    header("location: assets/header.view.php");
    header("location: teacher.subject.php");
}