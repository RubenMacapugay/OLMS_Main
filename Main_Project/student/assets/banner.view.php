<?php  
    // getting subjects 
    // $selectStudentSubjects = "SELECT * FROM subject_list_tbl where fk_student_id = $studentId";
    $selectStudentSubjects = 
        "SELECT * FROM subject_list_tbl 
        INNER JOIN section_tbl ON subject_list_tbl.fk_section_id = section_tbl.section_id
        INNER JOIN student_subjects_tbl ON student_subjects_tbl.fk_subject_list_id = subject_list_tbl.subject_list_id
        INNER JOIN gradelevel_tbl ON gradelevel_tbl.grade_level_id = section_tbl.fk_grade_level_id
        INNER JOIN teacher_tbl ON teacher_tbl.teacher_id = subject_list_tbl.fk_teacher_id
        WHERE student_subjects_tbl.fk_student_id = $studentId";
    $resultSubject =  $conn->query($selectStudentSubjects) or die ($mysqli->error);
    
    $selectStudentTaskssss = "SELECT * FROM task_list_tbl WHERE task_list_tbl.fk_subject_list_id = $subjectId";
    $resultTasksStudents =  $conn->query($selectStudentTaskssss) or die ($mysqli->error);
    
    

    
    // count the total task per student subject
    $studentSubjectTaskCount = getSubjectTaskCount($conn, $subjectId);
    echo $studentSubjectTaskCount['mycount'];
    
?>

<!-- <div class="custom-border">
    <div class="calendar-mini">
        <h4>Calendar</h4>
        <img src="images/img-calendar.jpg" alt="Calendar">
    </div>
</div> -->



<div class="custom-border">
    <div class="announcement-mini">
        <h4 class="position-relative">
            Announcement <span class="badge text-bg-secondary mb-1">-</span>
        </h4>
        <div class="announcement-item">
            <p>This is sample text</p>
        </div>
    </div>
</div>
<div class="custom-border mt-3">
    <div class="announcement-mini">
        <div class="d-flex justify-content-between">
            <h4>Todo</h4> 
            <span class="badge text-bg-secondary mb-2">-</span>    
        </div>
        <?php foreach ($resultSubject as $row) { 
            $subjectId = $row['subject_list_id']; 
            $subjectToDoResult = getSubjectToDoCount($conn, $subjectId, $studentId);
            $lengStudentNotSubmitted = getLengNotSubmitted($conn, $subjectId, $studentId);
            
            // total student submitted task
            $studentSubmittedTaskCount = getStudentSubmittedTaskCount($conn, $subjectId, $studentId);   
            
        ?>
            <form action="student.setSessionSubject.php" method="POST">
                <input type="hidden" name="subject_list_id" value="<?php echo $row['subject_list_id']; ?>">
                <input type="hidden" name="section_id" value="<?php echo $row['fk_section_id']; ?>">
                <input type="hidden" name="tab" value="taskTab">
                <div class="d-flex justify-content-between">
                    <button type="submit" name="submitSubjectId" class="btn btn-link p-0">
                        <?=$row['subject_list_name']?> 
                    </button>
                    
                    
                    <span class="badge text-bg-warning text-white mb-2 p-2">-
                    </span>
                    
                </div>
            </form>
            
            
        <?php }?>
    </div>
</div>

<div class="custom-border mt-3">
    <div class="announcement-mini">
        
        <h4><?=$_SESSION['userType']?></h4>
        <div class="deadlines-item">
            <?php 
                if(isset($_SESSION['parent_name'])){
                    echo '<p class="text-muted">'.$_SESSION['parent_name'].'</p>';
                } else if (isset($_SESSION['my_child'])){
                    echo '<p class="text-muted">'.$_SESSION['my_child'].'</p>';
                }
            
            ?>
        </div>
    </div>
</div>