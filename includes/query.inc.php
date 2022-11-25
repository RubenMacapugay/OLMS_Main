<?php


# Login 
$sql_student = "SELECT * FROM  student_tbl where student_number = ?;";
$sql_teacher = "SELECT * FROM  teacher_tbl where teacher_number = ?;";


# Student
// getting subjects
//$selectStudentSubjects = "SELECT * FROM subject_tbl"; //---test


# Teacher

## Teacher select
// student enrolled login.php
$sql_subject_enrolled = "SELECT * FROM subject_tbl where student_id = ?;";
// getting subjects teacher.php
$selectTeacherSubjects = "SELECT * FROM subject_tbl"; //---test 
// get  taskname from tasklist teacher.createtask.php
$selectTaskName = "SELECT * FROM task_list_tbl where task_name = ?;";




## Teacher insert 
// insert task teacher.createtask.php
$sql_insertTask = "INSERT INTO task_list_tbl (fk_grading_id, task_name, question_items, task_type, sub_type, date_created, date_deadline, time_limit, max_score, max_attempts, submission_choice)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
// insertt question teacher.createtask.php

$sql_insertTaskWithQuestion = "INSERT INTO task_list_tbl (fk_grading_id, task_name, task_content, task_type, sub_type, date_created, date_deadline, time_limit, max_score, max_attempts, submission_choice)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";



