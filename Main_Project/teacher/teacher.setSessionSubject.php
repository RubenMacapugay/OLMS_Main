<?php session_start();

if(isset($_POST['submitSubjectId'])){
    $subjectId = $_POST['subject_list_id'];
    $sectionId = $_POST['section_id'];
    $tab = $_POST['tab'];
    $_SESSION['subjectId'] = $subjectId;
    $_SESSION['section_id'] = $sectionId;
           
    if(isset($_POST['tab'])){
        header("location: assets/header.view.php");
        header("location: teacher.subject.php?tab=$tab");
        exit();
    }
    
    header("location: assets/header.view.php");
    header("location: teacher.subject.php");
    exit();
}
