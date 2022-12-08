                                            <?php while($rowModuleTask = $resultModuleSectionFourthGrading->fetch_assoc()): ?>
                                                <?php 

                                                // query for displaying the task per module section
                                                $moduleSectionId = $rowModuleTask['module_section_id'];
                                                //echo 'Module Section ID:'.$moduleSectionId;
                                                $selectStudentTasksFourthGrading = "SELECT * FROM task_list_tbl LEFT JOIN submission_tbl ON submission_tbl.fk_task_list_id = task_list_tbl.task_list_id AND submission_tbl.fk_student_id = $studentId AND task_list_tbl.fk_subject_list_id = $subjectId AND submission_tbl.attempt = (SELECT MAX(attempt) FROM submitted_answer_tbl) WHERE task_list_tbl.fk_grading_id = 4 and task_list_tbl.fk_module_section_id = $moduleSectionId";
                                                $resultTasksFourthGrading =  $conn->query($selectStudentTasksFourthGrading) or die ($mysqli->error); 
                                               
                                               ?>
                                                <div class="card mb-2">
                                                    <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <!-- for updating module_section -->
                                                       
                                                        <h4 class="module-section-title" id="moduleTaskName"><?php echo $rowModuleTask['module_section_name']; ?> </h4>
                                                        <a class="nav-link text-primary content-collapse" type=""> Hide <i
                                                                class="fa-solid fa-chevron-down"></i></a>
                                                        </div>
                                                        <p class="module-section-desc mt-3 mb-0" ><?php echo $rowModuleTask['module_section_desc']; ?></p>
                                                        
                                                        <!-- Module section task -->
                                                        <table class="table table-hover p-0 section-table section-table-content custom-hide">
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <th></th>
                                                                    <th>Type</th>
                                                                    <th>Start</th>
                                                                    <th>Due</th>
                                                                    <th>Score</th>
                                                                    <!-- <th>Status</th> -->
                                                                </tr>
                                                            </thead>
            
                                                            <tbody>
                                                                <tr>
                                                                    <td class=""><a class="section-link"
                                                                            href="student.module.php">01 Module
                                                                            1</a></td>
                                                                    <td class="">-</td>
                                                                    <td class="">-</td>
                                                                    <td class="">-</td>
                                                                    <td class="">-</td>
                                                                </tr>
                                                                <?php while($rowFourthGrading = $resultTasksFourthGrading->fetch_assoc()): ?>
                                                                    <?php  //displaying the task backend code
                                                                        
                                                                        
                                                                        // saving the id's 
                                                                        $gradingFourthTask = $rowFourthGrading['fk_module_section_id']; 
                                                                        $moduleFourthSectionId = $rowModuleTask['module_section_id'];
                                                                        $taskId = $rowFourthGrading['task_list_id'];
                                                                        
                                                                        // save date variables
                                                                        $date_now = date("Y-m-d"); // this format is string comparable
                                                                        $startDate = $rowFourthGrading['date_created'];
                                                                        $endDate = $rowFourthGrading['date_deadline'];

                                                                        // task attempt
                                                                        $taskMaxAttempt = $rowFourthGrading['max_attempts'];

                                                                        // getting the student attempt and score
                                                                        $maxAttempt = getMaxAttempt2($conn, $taskId, $studentId);
                                                                        $scoreResult;
                                                                        if($maxAttempt[0] == null){
                                                                            $scoreResult = "-";
                                                                        }
                                                                        else{
                                                                            $studentAnswer = getScore2($conn, $taskId, $maxAttempt[0], $studentId);
                                                                            $scoreResult = $studentAnswer['score'];

                                                                        }

                                                                        $taskTime = $rowFourthGrading["time_limit"];
                                                                        $newTaskFormat = date('h:i A', strtotime($taskTime));
                                                                       
                                                                        
                                                                        //echo $newTaskFormat;
                                                                        if (time() >= strtotime($newTaskFormat)) {
                                                                            echo $rowFourthGrading['task_name'].'---'.date("h:i A")." >= ".$newTaskFormat.'<br>';
                                                                        }else{
                                                                            echo $rowFourthGrading['task_name'].'---'.date("h:i A").' <= '.$newTaskFormat.'<br>';
                                                                        }

                                                                        //echo 'TaskID: '.$taskId; echo 'and '.$studentAnswer['score'].'<br>';
                                                                        //echo 'TaskId:'.$taskId.' Max attempts: '.$rowFourthGrading['max_attempts']. ' - ' .'current attempts: '.$maxAttempt[0].'<br>';
                                                                        // print_r($rowFourthGrading);
                                                                        // echo '<br><br>';
                                                                    ?>

                                                                    <?php if(($rowFourthGrading['given'] == "Yes") && ($taskMaxAttempt > $maxAttempt[0]) && ($date_now <= $endDate) && (time() <= strtotime($newTaskFormat))){ ?>
                                                                        <tr>
                                                                            <td class="">
                                                                                <form action="../../includes/student.process.php"
                                                                                    method="POST">
                                                                                    <input type="hidden" name="task_id"
                                                                                        value="<?php echo $rowFourthGrading['task_list_id']; ?>">
                                                                                    <input type="hidden" name="task_type"
                                                                                        value="<?php echo $rowFourthGrading['fk_task_type']; ?>">
                                                                                    <button class="list-group-item list-group-item-action text-primary text-decoration-underline" type="submit"
                                                                                        name="submitTaskDetails"><?php echo $rowFourthGrading['task_name']?></button>
                                                                                </form>
                                                                            </td>
                                                                            <td>-</td>
                                                                            <td class=""><?php echo $startDate;?></td>
                                                                            <td class=""><?php echo $endDate;?></td>
                                                                            <td class=""><?php echo $scoreResult;?></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                <?php endwhile; ?>
            
            
                                                            </tbody>
                                                        </table>
                                                        
                                                    </div>
                                                </div>
                                            <?php endwhile; ?>