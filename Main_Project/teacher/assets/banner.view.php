<!-- <div class="custom-border">
    <div class="calendar-mini">
        <h4>Calendar</h4>
        <img src="images/img-calendar.jpg" alt="Calendar">
    </div>
</div> -->

<?php
    
    $selectTeacherSubject = 
        "SELECT * FROM subject_list_tbl 
        INNER JOIN section_tbl ON subject_list_tbl.fk_section_id = section_tbl.section_id 
        INNER JOIN gradelevel_tbl ON gradelevel_tbl.grade_level_id = section_tbl.fk_grade_level_id
        INNER JOIN teacher_tbl ON teacher_tbl.teacher_id = subject_list_tbl.fk_teacher_id 
        INNER JOIN subject_tbl ON subject_tbl.subject_id = subject_list_tbl.fk_subject_id 
        WHERE subject_list_tbl.fk_teacher_id = $teacherId";
    $resultSubject =  $conn->query($selectTeacherSubject) or die ($mysqli->error);
    
   
    
?>
<div class="custom-border">
    <div class="announcement-mini">
        <h4 class="position-relative">
            Announcement <span class="badge text-bg-secondary mb-1">1</span>
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
            <span class="badge text-bg-secondary mb-2">3</span>    
        </div>
        <?php foreach ($resultSubject as $row) { 
            $id = $row['subject_list_id']; 
            $subjectToGradeResult = getSubjectToGradeCount($conn, $id);
        ?>
            <form action="teacher.setSessionSubject.php" method="POST">
                <input type="hidden" name="subject_list_id" value="<?php echo $row['subject_list_id']; ?>">
                <input type="hidden" name="section_id" value="<?php echo $row['fk_section_id']; ?>">
                <input type="hidden" name="tab" value="tocheck">
                <div class="d-flex justify-content-between">
                    <button type="submit" name="submitSubjectId" class="btn btn-link p-0">
                        <?=$row['subject_list_name']?> 
                    </button>
                    <?php if($subjectToGradeResult['NotChecked_COUNT'] > 0){
                        ?>
                            <span class="badge text-bg-warning text-white mb-2 p-2">
                                <?=$subjectToGradeResult['NotChecked_COUNT']?>
                            </span>
                        <?php
                    } 
                    ?>
                </div>
            </form>
            
            
        <?php }?>
           
    </div>
</div>
