<?php include('assets/header.view.php')?>

<?php 

if(!isset($_GET['studentId']) || !isset($_GET['taskId']) || $_GET['taskId'] == "" || $_GET['studentId'] == "") {
    header ("location: teacher.subject.php");
    $_SESSION['msg'] = "missingparameter";
}

$sectionId = $_SESSION['section_id'];
$subjectId = $_SESSION['subjectId'];
$teacherId = $_SESSION['teacher_id'];
$studentId = $_GET['studentId'];
$taskId = $_GET['taskId'];

# get subject details
$currentSubjectData = teacherSubjectExist2($conn, $subjectId, $sectionId, $teacherId);

# student details
$studentData = getStudent($conn, $studentId);

# get attempts 
$taskAttempts = getAttempts($conn, $taskId, $studentId);

$currentTask = getCurrentTask($conn, $taskId);
$taskName = $currentTask['task_name'];

if(isset($_GET['path'])) $path = $_GET['path'];
    
if(isset($_GET['tab'])) $tab = $_GET['tab'];


?>
    <!--Body content -->

    <div class="container-fluid " id="content">

        <div class="row overflow-hidden">

            <!-- Left Side Nav global-->
            <div class="col-md-2 " id="sideNav">
                <?php include('assets/sidebar.view.php') ?>
            </div>

            <!-- Main Content -->
            <div class="col-md-8 py-4 main-content" id="teacherSubjectContent">
                <div>
                    <div class="custom-border">
                        <div class="mx-3">
                            <?php
                                if(isset($_GET['tab'])){
                                    if($_GET['tab'] == "tocheck"){
                                        echo '<a href="studentListOfSubmission.php?taskListId='.$taskId.'&&tab='.$tab.'">back</a>';
                                    }
                                    
                                    if($_GET['tab'] == "gradeBook"){
                                        echo '<a href="student_subject.progress.php?studentId='.$studentId.'&&tab='.$tab.'">back</a>';
                                    }
                                    
                                    if($_GET['tab'] == "progress"){
                                        echo '<a href="student_subject.progress.php?studentId='.$studentId.'&&tab='.$tab.'">back</a>';
                                    }
                                }
                            ?>
                            <div class="d-flex align-items-end mt-3">
                                <h3 class="mb-0"><?php echo $currentSubjectData['subject_list_name']?></h3>
                                <p class="text-muted mb-0 ms-2"><?php echo $currentSubjectData['grade_level_name'].' - '.$currentSubjectData['section_name']?></p>
                                
                            </div>
        
                        </div>
                        <div class="card ">
                            <div class="card-header d-flex justify-content-between">
                                <div class="">
                                    <h4 class="d-block"><?=$taskName?></h4>
                                    <p class="d-block mb-0"><?=$studentData['student_name']?></p>
                                </div>
                            </div>
                            <div class="card-body p-2">
                                <table class="table table-hover px-4 section-table">
                                    <thead class="">
                                        <tr>
                                            <th scope="col">
                                                <span>Task attempts</span>
                                            </th>
                                            <th scope="col" class="text-center">Time Submitted</th>
                                            <th scope="col" class="text-center">Date Submitted</th>
                                            <th scope="col" class="text-center ">Score</th>
        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($rowTaskAttempts = $taskAttempts->fetch_assoc()) : 
                                            $attemptCount = $rowTaskAttempts['attempt'];
                                            $submissionId = $rowTaskAttempts['submission_id'];
                                            $score = getScore2($conn, $taskId, $attemptCount, $studentId)
                                        ?>
                                            <tr>
                                                <td><?=$attemptCount?> <a class="ms-2" href="studentTaskView.php?tab=<?=$tab?>&&studentId=<?=$studentId?>&&taskId=<?=$taskId?>&&submissionId=<?=$submissionId?>&&attemptCount=<?=$attemptCount?>">View</a></td> 
                                                <td>
                                                    <?php 
                                                        if($rowTaskAttempts['submission_time'] == ""){
                                                            echo '-';
                                                        }else {
                                                            echo $rowTaskAttempts['submission_time'];
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        if($rowTaskAttempts['submission_date'] == ""){
                                                            echo '-';
                                                        } else{
                                                            echo $rowTaskAttempts['submission_date'];
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if($rowTaskAttempts['sub_type'] == "3"){
                                                            echo $rowTaskAttempts['score'] .'/'. $rowTaskAttempts['max_score'];
                                                        } else{
                                                            echo $rowTaskAttempts['score'] .'/'. $rowTaskAttempts['question_item'];
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php endwhile;?>
                                        
                                    </tbody>
                                </table>
                            </div>
        
                        </div>
                    </div>
                </div>
                
                
            </div>

            <!-- Right Banner -->
            <div class="custom-border col-md-2 mt-4" id="rightBanner">
                <?php include('assets/banner.view.php')?>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>

    <!-- J-query -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>