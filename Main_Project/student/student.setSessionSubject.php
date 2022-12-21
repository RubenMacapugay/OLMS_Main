<?php 
session_start();

if(isset($_POST['submitSubjectId'])){
    $subjectId = $_POST['subject_list_id'];
    $sectionId = $_POST['section_id'];
    $tab = $_POST['tab'];
    
    $_SESSION['subjectId'] = $subjectId;
    
    
    if(isset($_POST['tab'])){
        header("location: assets/header.view.php");
        header("location: student.subjects.php?tab=$tab");
        exit();
    }
    echo "success";
    //header("location: assets/header.view.php");
    header("location: student.subjects.php");
}