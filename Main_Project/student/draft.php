<!-- Skip to content
Search or jump to…
Pull requests
Issues
Codespaces
Marketplace
Explore
 
@Carlozzzzz 
RubenMacapugay
/
OLMS_Main
Private
Code
Issues
Pull requests
Actions
Projects
Security
Insights
OLMS_Main/Main_Project/student/student.subjects.php /
@Carlozzzzz
Carlozzzzz add coments
Latest commit 01de99f 11 hours ago
 History
 2 contributors
@Rubenjr1999@Carlozzzzz
765 lines (635 sloc)  49.8 KB -->

<?php 
include('assets../header.view.php'); 
// if(isset($_SESSION['subjectId'])){
//     echo $_SESSION['subjectId'];
// }else{
//     echo "failed";
// }  SELECT * FROM task_list_tbl WHERE task_list_tbl.fk_grading_id = 1 AND task_list_tbl.fk_subject_list_id = 9
$_SESSION['score'] = 0;



?>


<?php 
    //Getting the list of task in specific subject of student on subject_list_tbl
    $subjectId = $_SESSION['subjectId'];
    $studentId = $_SESSION['student_id'];
    date_default_timezone_set('Asia/Manila');


    # tester --- 
        $taskId = 204;
        // // $sqlAttempt = "SELECT MAX(attempt) FROM submitted_answer_tbl where fk_task_list_id = $taskId and fk_student_id = $studentId";
        // // $attemptRow = mysqli_query($conn, $sqlAttempt);
        // // $result = mysqli_fetch_assoc($attemptRow);
        // // $maxAttempt = $result['MAX(attempt)'];

        
        // $maxAttempt = getMaxAttempt2($conn, $taskId, $studentId);
        // if($maxAttempt[0] == null){
        //     echo 'Theres no return value';
        //     print_r ($maxAttempt);
        // }
        // else{
        //     echo 'Max Attempt for ' .$taskId. ': '.$maxAttempt[0].'<br>';
        //     print_r ($maxAttempt);
        //     $studentAnswer = getScore2($conn, $taskId, $maxAttempt[0], $studentId);
        //     echo 'Score: '.$studentAnswer['score'];
        // }

        // time
        // $time = "01:10 PM";
        // $firstFormat = date('h:i A', strtotime($time));
        // $secondFormat = date('H:i', strtotime($time));

        // echo $secondFormat;
        
        $time = "07:50 PM";
        $timee = "11:55 PM";
        $secondFormat = date('H:i', strtotime($timee));
        //echo $secondFormat;
        if (time() > $secondFormat){
            echo " >= ".$secondFormat;
        }else{
            echo ' <= '.$secondFormat;
        }
        // $date = date('m/d/Y h:i:s a', time());
        // echo $date;
        

        # tester --- end




    // get the subject name
// <<<<<<< Updated upstream
    //$subjectName = getSubjectName($conn, $subjectId);
// =======
    // $subjectName = getSubjectName($conn, $subjectId);
// >>>>>>> Stashed changes

    //unsetting question counter
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
        if($msg == "cancelled"){
            unset($_SESSION['questionCount']);
        }
    }

    # getTask count per grading ---
        $firstGradingTask = checkTaskCountPerGrading($conn, $subjectId, 1);
        $secondGradingTask = checkTaskCountPerGrading($conn, $subjectId, 2);
        $thirdGradingTask = checkTaskCountPerGrading($conn, $subjectId, 3);
        $fourthGradingTask = checkTaskCountPerGrading($conn, $subjectId, 4);
    # getTask count per grading --- end

    # display the module section in first grading ---
        $selectModuleSectionFirstGrading = "SELECT * FROM module_section_tbl WHERE (fk_grading_id = 1 AND fk_subject_list_id = $subjectId)";
        $resultModuleSectionFirstGrading =  $conn->query($selectModuleSectionFirstGrading) or die ($mysqli->error);


        $selectModuleSectionSecondGrading = "SELECT * FROM module_section_tbl WHERE (fk_grading_id = 2 AND fk_subject_list_id = $subjectId)";
        $resultModuleSectionSecondGrading =  $conn->query($selectModuleSectionSecondGrading) or die ($mysqli->error);

        $selectModuleSectionThirdGrading = "SELECT * FROM module_section_tbl WHERE (fk_grading_id = 3 AND fk_subject_list_id = $subjectId)";
        $resultModuleSectionThirdGrading =  $conn->query($selectModuleSectionThirdGrading) or die ($mysqli->error);

        $selectModuleSectionFourthGrading = "SELECT * FROM module_section_tbl WHERE (fk_grading_id = 4 AND fk_subject_list_id = $subjectId)";
        $resultModuleSectionFourthGrading =  $conn->query($selectModuleSectionFourthGrading) or die ($mysqli->error);


        // Leng query back
        $selectStudentTasks = "SELECT * FROM task_list_tbl WHERE task_list_tbl.fk_subject_list_id = $subjectId";
        $resultTasks =  $conn->query($selectStudentTasks) or die ($mysqli->error);
    # display the module section in first grading --- end


    
    # Display task per subjects ----
        # SELECT * FROM ((task_list_tbl INNER JOIN submission_tbl ON task_list_tbl.task_list_id = submission_tbl.fk_task_list_id) INNER JOIN task_tbl ON task_list_tbl.fk_task_type = task_tbl.task_id) WHERE submission_tbl.fk_student_id = $studentId
        # First Grading SELECT task_list_tbl.task_name, submission_tbl.score FROM ((task_list_tbl INNER JOIN submission_tbl ON task_list_tbl.task_list_id = submission_tbl.fk_task_list_id)) WHERE submission_tbl.fk_student_id = 6;
        // $selectStudentTasksFirstGrading = "SELECT * FROM task_list_tbl WHERE task_list_tbl.fk_grading_id = 1 AND task_list_tbl.fk_subject_list_id = $subjectId";
        // $resultTasksFirstGrading =  $conn->query($selectStudentTasksFirstGrading) or die ($mysqli->error);
        

        # Second Grading 
        // $selectStudentTasksSecondGrading = "SELECT * FROM task_list_tbl WHERE task_list_tbl.fk_grading_id = 2 AND task_list_tbl.fk_subject_list_id = $subjectId";
        // $resultTasksSecondGrading =  $conn->query($selectStudentTasksSecondGrading) or die ($mysqli->error);

        # Third Grading 
        // $selectStudentTasksThirdGrading = "SELECT * FROM task_list_tbl WHERE task_list_tbl.fk_grading_id = 3 AND task_list_tbl.fk_subject_list_id = $subjectId";
        // $resultTasksThirdGrading =  $conn->query($selectStudentTasksThirdGrading) or die ($mysqli->error);

        # Fourth Grading 
        // $selectStudentTasksFourthGrading = "SELECT * FROM task_list_tbl WHERE task_list_tbl.fk_grading_id = 4 AND task_list_tbl.fk_subject_list_id = $subjectId";
        // $resultTasksFourthGrading =  $conn->query($selectStudentTasksFourthGrading) or die ($mysqli->error);
    # Display task per subjects ----end

?>

<!--Body content -->

<div class="container-fluid " id="content">

    <div class="row overflow-hidden">

        <!-- Left Side Nav global-->
        <div class="col-md-2 " id="sideNav">
            <?php include('assets/sidebar.view.php') ?>
        </div>

        <!-- Main Content -->

        <div class="col-md-8 py-4 main-content" id="subjectMainContent">
           
            <div class="row mx-0">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-8">
                            <!-- Tab header   -->
                            <div class="tab-header">
                                <div class="active">
                                    Modules
                                </div>
                                <div>
                                    Task
                                </div>
                            <!-- <div>
                                    Progress
                                </div> -->
                            </div>
                            <div class="tab-indicator"></div>
                        </div>
                    </div>

                    <!-- Subject Content (tabpane body) -->
                    <div class="row mt-2">
                        <div class="tabs px-0">
                            <div class="tab-body">

                                <!-- Subject Modules Tab -->
                                <div class="active tab-content p-2">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3>Mapehhhehe Design</h3>
                                            <p>BSIT 4.1B</p>
                                            <p>Course Description</p>
                                            <p>description Lorem, ipsum dolor sit amet consectetur adipisicing
                                                elit.
                                                Atque
                                                ipsum
                                                reprehenderit voluptas sed et sint.</p>
                                        </div>

                                    </div>

                                    <!-- First Grading -->
                                    <div class="section-module mt-2 card ">
                                        <div class="card-header ">
                                            <h4 class="section-title">First Grading</h4>
                                            <br>
                                            <div>
                                                <ul class="nav justify-content-between align-items-center">
                                                    <li class="nav-item"><?php echo $firstGradingTask; ?> Task</li>
                                                    <li class="nav-item d-flex align-items-center">
                                                        <a class="nav-link content-collapse" type="">Content
                                                            <i class="fa-solid fa-chevron-down"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- First Grading Content -->
                                        <div class="card-body section-table-content custom-hide">

                                            <!-- create loop inside the card to display the module_sections -->
                                            <?php while($rowModuleTask = $resultModuleSectionFirstGrading->fetch_assoc()): ?>
                                                <?php 

                                                // query for displaying the task per module section
                                                $moduleSectionId = $rowModuleTask['module_section_id'];
                                                //echo 'Module Section ID:'.$moduleSectionId;
                                                $selectStudentTasksFirstGrading = "SELECT * FROM task_list_tbl LEFT JOIN submission_tbl ON submission_tbl.fk_task_list_id = task_list_tbl.task_list_id AND submission_tbl.fk_student_id = $studentId AND task_list_tbl.fk_subject_list_id = $subjectId AND submission_tbl.attempt = (SELECT MAX(attempt) FROM submitted_answer_tbl) WHERE task_list_tbl.fk_grading_id = 1 and task_list_tbl.fk_module_section_id = $moduleSectionId";
                                                $resultTasksFirstGrading =  $conn->query($selectStudentTasksFirstGrading) or die ($mysqli->error); 
                                                
                                                
                                               
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
                                                                <?php while($rowFirstGrading = $resultTasksFirstGrading->fetch_assoc()): ?>
                                                                    <?php  //displaying the task backend code
                                                                        
                                                                        
                                                                        // saving the id's 
                                                                        $gradingFirstTask = $rowFirstGrading['fk_module_section_id']; 
                                                                        $moduleFirstSectionId = $rowModuleTask['module_section_id'];
                                                                        $taskId = $rowFirstGrading['task_list_id'];
                                                                        
                                                                        // save date variables
                                                                        $date_now = date("Y-m-d"); // this format is string comparable
                                                                        $startDate = $rowFirstGrading['date_created'];
                                                                        $endDate = $rowFirstGrading['date_deadline'];

                                                                        // task attempt
                                                                        $taskMaxAttempt = $rowFirstGrading['max_attempts'];

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

                                                                        $taskTime = $rowFirstGrading["time_limit"];
                                                                        $newTaskFormat = date('h:i A', strtotime($taskTime));
                                                                       
                                                                        
                                                                        //echo $newTaskFormat;
                                                                        if (time() >= strtotime($newTaskFormat)) {
                                                                            echo $rowFirstGrading['task_name'].'---'.date("h:i A")." >= ".$newTaskFormat.'<br>';
                                                                        }else{
                                                                            echo $rowFirstGrading['task_name'].'---'.date("h:i A").' <= '.$newTaskFormat.'<br>';
                                                                        }

                                                                        //echo 'TaskID: '.$taskId; echo 'and '.$studentAnswer['score'].'<br>';
                                                                        //echo 'TaskId:'.$taskId.' Max attempts: '.$rowFirstGrading['max_attempts']. ' - ' .'current attempts: '.$maxAttempt[0].'<br>';
                                                                        // print_r($rowFirstGrading);
                                                                        // echo '<br><br>';
                                                                    ?>

                                                                    <?php if(($rowFirstGrading['given'] == "Yes") && ($taskMaxAttempt > $maxAttempt[0]) && ($date_now <= $endDate) && (time() <= strtotime($newTaskFormat))){ ?>
                                                                        <tr>
                                                                            <td class="">
                                                                                <form action="../../includes/student.process.php"
                                                                                    method="POST">
                                                                                    <input type="hidden" name="task_id"
                                                                                        value="<?php echo $rowFirstGrading['task_list_id']; ?>">
                                                                                    <input type="hidden" name="task_type"
                                                                                        value="<?php echo $rowFirstGrading['fk_task_type']; ?>">
                                                                                    <button class="list-group-item list-group-item-action text-primary text-decoration-underline" type="submit"
                                                                                        name="submitTaskDetails"><?php echo $rowFirstGrading['task_name']?></button>
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


                                        </div>
                                    </div>

                                    <!-- Second Grading -->
                                    <div class="section-module mt-2 card">
                                        <div class="card-header">
                                            <h4 class="section-title">Second Grading</h4>
                                            <br>
                                            <div>
                                                <ul class="nav justify-content-between align-items-center">
                                                    <li class="nav-item"><?php echo $secondGradingTask; ?> Task</li>
                                                    <li class="nav-item d-flex align-items-center">
                                                        <a class="nav-link content-collapse" type="">Content
                                                            <i class="fa-solid fa-chevron-down"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Second Grading Content -->
                                        <div class="card-body section-table-content custom-hide">

                                            <!-- create loop inside the card to display the module_sections -->
                                            <?php while($rowModuleTask = $resultModuleSectionSecondGrading->fetch_assoc()): ?>
                                                <?php 

                                                // query for displaying the task per module section
                                                $moduleSectionId = $rowModuleTask['module_section_id'];
                                                //echo 'Module Section ID:'.$moduleSectionId;
                                                $selectStudentTasksSecondGrading = "SELECT * FROM task_list_tbl LEFT JOIN submission_tbl ON submission_tbl.fk_task_list_id = task_list_tbl.task_list_id AND submission_tbl.fk_student_id = $studentId AND task_list_tbl.fk_subject_list_id = $subjectId AND submission_tbl.attempt = (SELECT MAX(attempt) FROM submitted_answer_tbl) WHERE task_list_tbl.fk_grading_id = 2 and task_list_tbl.fk_module_section_id = $moduleSectionId";
                                                $resultTasksSecondGrading =  $conn->query($selectStudentTasksSecondGrading) or die ($mysqli->error); 
                                                
                                                
                                                
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
                                                                <?php while($rowSecondGrading = $resultTasksSecondGrading->fetch_assoc()): ?>
                                                                    <?php  //displaying the task backend code
                                                                        
                                                                        
                                                                        // saving the id's 
                                                                        $gradingSecondTask = $rowSecondGrading['fk_module_section_id']; 
                                                                        $moduleSecondSectionId = $rowModuleTask['module_section_id'];
                                                                        $taskId = $rowSecondGrading['task_list_id'];
                                                                        
                                                                        // save date variables
                                                                        $date_now = date("Y-m-d"); // this format is string comparable
                                                                        $startDate = $rowSecondGrading['date_created'];
                                                                        $endDate = $rowSecondGrading['date_deadline'];

                                                                        // task attempt
                                                                        $taskMaxAttempt = $rowSecondGrading['max_attempts'];

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

                                                                        $taskTime = $rowSecondGrading["time_limit"];
                                                                        $newTaskFormat = date('h:i A', strtotime($taskTime));
                                                                        
                                                                        
                                                                        //echo $newTaskFormat;
                                                                        // if (time() >= strtotime($newTaskFormat)) {
                                                                        //     echo $rowSecondGrading['task_name'].'---'.date("h:i A")." >= ".$newTaskFormat.'<br>';
                                                                        // }else{
                                                                        //     echo $rowSecondGrading['task_name'].'---'.date("h:i A").' <= '.$newTaskFormat.'<br>';
                                                                        // }

                                                                        //echo 'TaskID: '.$taskId; echo 'and '.$studentAnswer['score'].'<br>';
                                                                        //echo 'TaskId:'.$taskId.' Max attempts: '.$rowSecondGrading['max_attempts']. ' - ' .'current attempts: '.$maxAttempt[0].'<br>';
                                                                        // print_r($rowSecondGrading);
                                                                        // echo '<br><br>';
                                                                    ?>

                                                                    <?php if(($rowSecondGrading['given'] == "Yes") && ($taskMaxAttempt > $maxAttempt[0]) && ($date_now <= $endDate) && (time() <= strtotime($newTaskFormat))){ ?>
                                                                        <tr>
                                                                            <td class="">
                                                                                <form action="../../includes/student.process.php"
                                                                                    method="POST">
                                                                                    <input type="hidden" name="task_id"
                                                                                        value="<?php echo $rowSecondGrading['task_list_id']; ?>">
                                                                                    <input type="hidden" name="task_type"
                                                                                        value="<?php echo $rowSecondGrading['fk_task_type']; ?>">
                                                                                    <button class="list-group-item list-group-item-action text-primary text-decoration-underline" type="submit"
                                                                                        name="submitTaskDetails"><?php echo $rowSecondGrading['task_name']?></button>
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


                                        </div>
                                    </div>

                                    <!-- Third Grading -->
                                    <div class="section-module mt-2 card">
                                        <div class="card-header">
                                            <h4 class="section-title">Third Grading</h4>
                                            <br>
                                            <div>
                                                <ul class="nav justify-content-between align-items-center">
                                                    <li class="nav-item"><?php echo $thirdGradingTask; ?> Task</li>
                                                    <li class="nav-item d-flex align-items-center">
                                                        <a class="nav-link content-collapse" type="">Content
                                                            <i class="fa-solid fa-chevron-down"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Third Grading Content -->
                                        <div class="card-body section-table-content custom-hide">
                                            
                                            <!-- create loop inside the card to display the module_sections -->
                                            <?php while($rowModuleTask = $resultModuleSectionThirdGrading->fetch_assoc()): ?>
                                                <?php 

                                                // query for displaying the task per module section
                                                $moduleSectionId = $rowModuleTask['module_section_id'];
                                                //echo 'Module Section ID:'.$moduleSectionId;
                                                $selectStudentTasksThirdGrading = "SELECT * FROM task_list_tbl LEFT JOIN submission_tbl ON submission_tbl.fk_task_list_id = task_list_tbl.task_list_id AND submission_tbl.fk_student_id = $studentId AND task_list_tbl.fk_subject_list_id = $subjectId AND submission_tbl.attempt = (SELECT MAX(attempt) FROM submitted_answer_tbl) WHERE task_list_tbl.fk_grading_id = 3 and task_list_tbl.fk_module_section_id = $moduleSectionId";
                                                $resultTasksThirdGrading =  $conn->query($selectStudentTasksThirdGrading) or die ($mysqli->error); 
                                                
                                                
                                                
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
                                                                <?php while($rowThirdGrading = $resultTasksThirdGrading->fetch_assoc()): ?>
                                                                    <?php  //displaying the task backend code
                                                                        
                                                                        
                                                                        // saving the id's 
                                                                        $gradingThirdTask = $rowThirdGrading['fk_module_section_id']; 
                                                                        $moduleThirdSectionId = $rowModuleTask['module_section_id'];
                                                                        $taskId = $rowThirdGrading['task_list_id'];
                                                                        
                                                                        // save date variables
                                                                        $date_now = date("Y-m-d"); // this format is string comparable
                                                                        $startDate = $rowThirdGrading['date_created'];
                                                                        $endDate = $rowThirdGrading['date_deadline'];

                                                                        // task attempt
                                                                        $taskMaxAttempt = $rowThirdGrading['max_attempts'];

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

                                                                        $taskTime = $rowThirdGrading["time_limit"];
                                                                        $newTaskFormat = date('h:i A', strtotime($taskTime));
                                                                        
                                                                        
                                                                        //echo $newTaskFormat;
                                                                        // if (time() >= strtotime($newTaskFormat)) {
                                                                        //     echo $rowThirdGrading['task_name'].'---'.date("h:i A")." >= ".$newTaskFormat.'<br>';
                                                                        // }else{
                                                                        //     echo $rowThirdGrading['task_name'].'---'.date("h:i A").' <= '.$newTaskFormat.'<br>';
                                                                        // }

                                                                        //echo 'TaskID: '.$taskId; echo 'and '.$studentAnswer['score'].'<br>';
                                                                        //echo 'TaskId:'.$taskId.' Max attempts: '.$rowThirdGrading['max_attempts']. ' - ' .'current attempts: '.$maxAttempt[0].'<br>';
                                                                        // print_r($rowThirdGrading);
                                                                        // echo '<br><br>';
                                                                    ?>

                                                                    <?php if(($rowThirdGrading['given'] == "Yes") && ($taskMaxAttempt > $maxAttempt[0]) && ($date_now <= $endDate) && (time() <= strtotime($newTaskFormat))){ ?>
                                                                        <tr>
                                                                            <td class="">
                                                                                <form action="../../includes/student.process.php"
                                                                                    method="POST">
                                                                                    <input type="hidden" name="task_id"
                                                                                        value="<?php echo $rowThirdGrading['task_list_id']; ?>">
                                                                                    <input type="hidden" name="task_type"
                                                                                        value="<?php echo $rowThirdGrading['fk_task_type']; ?>">
                                                                                    <button class="list-group-item list-group-item-action text-primary text-decoration-underline" type="submit"
                                                                                        name="submitTaskDetails"><?php echo $rowThirdGrading['task_name']?></button>
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

                                        
                                        </div>
                                    </div>

                                    <!-- Fourth Grading -->
                                    <div class="section-module mt-2 card">
                                        <div class="card-header">
                                            <h4 class="section-title">Fourth Grading</h4>
                                            <br>
                                            <div>
                                                <ul class="nav justify-content-between align-items-center">
                                                    <li class="nav-item"><?php echo $fourthGradingTask; ?> Task</li>
                                                    <li class="nav-item d-flex align-items-center">
                                                        <a class="nav-link content-collapse" type="">Content
                                                            <i class="fa-solid fa-chevron-down"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Fourth Grading Content -->
                                        <div class="card-body section-table-content custom-hide">
                                            <?php //include('assets../test.view.php'); ?>
                                            
                                            <!-- create loop inside the card to display the module_sections -->
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
                                                                        // if (time() >= strtotime($newTaskFormat)) {
                                                                        //     echo $rowFourthGrading['task_name'].'---'.date("h:i A")." >= ".$newTaskFormat.'<br>';
                                                                        // }else{
                                                                        //     echo $rowFourthGrading['task_name'].'---'.date("h:i A").' <= '.$newTaskFormat.'<br>';
                                                                        // }

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
                                                                        
                                            
                                        
                                        </div>
                                    </div>

                                </div>

                                <!-- Subject Task -->
                                <div class="tab-content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="d-flex">
                                                <div
                                                    class="module-actions d-flex justify-content-end align-items-center p-2">
                                                    <select class="form-select w-25"
                                                        aria-label="Default select example">

                                                        <option value="0">All</option>
                                                        <?php 
                                                        $taskSqli = "SELECT * FROM task_tbl";
                                                        $taskTypeResult = mysqli_query($conn, $taskSqli);
                                                        while($row = mysqli_fetch_array($taskTypeResult)) {
                                                            $task = $row['task_id'];
                                                            echo '<option value="'.$task.'">' .$row['task_main_name']. '</option>';
                                                        } 
                                                    ?>
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Task List</th>
                                                <th scope="col" class="text-center">Duration</th>
                                                <th scope="col" class="text-center">Score</th>
                                                <!-- <th scope="col" class="text-center">Status</th> -->

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <!-- Looping through all the available task -->
                                            <?php while($row = $resultTasks->fetch_assoc()): ?>

                                            <tr>
                                                <td>
                                                    <form action="../../includes/student.process.php" method="POST">
                                                        <input type="hidden" name="task_id"
                                                            value="<?php echo $row['task_list_id']; ?>">
                                                        <input type="hidden" name="task_type"
                                                            value="<?php echo $row['fk_task_type']; ?>">
                                                        <button type="submit" class="list-group-item list-group-item-action text-primary text-decoration-underline"
                                                            name="submitTaskDetails"><?php echo $row['task_name']?></button>
                                                    </form>
                                                </td>
                                                <td>-</td>
                                                <td>-</td>
                                                <!-- <td>-</td> -->
                                            </tr>
                                           

                                            <?php endwhile; ?>
                                            
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Subject Progress -->
                                <!-- <div class="tab-content">
                                    <div class="custom-border p-5">
                                        <div class="container-fluid">
                                            <div class="row  px-0">
                                                <div class="col-md-4 mt-2">
                                                    <div class="card p-3 justify-content-center align-items-center">
                                                        <div class="circular-progress">
                                                            <div class="value-container">0%</div>
                                                        </div>
                                                        <h4 class="mt-1">Assignment Progress</h4>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mt-2">
                                                    <div class="card p-3 justify-content-center align-items-center">
                                                        <div class="circular-progress">
                                                            <div class="value-container">0%</div>
                                                        </div>
                                                        <h4 class="mt-1">Quiz Progress</h4>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mt-2">
                                                    <div class="card p-3 justify-content-center align-items-center">
                                                        <div class="circular-progress">
                                                            <div class="value-container">0%</div>
                                                        </div>
                                                        <h4 class="mt-1">Activity Progress</h4>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mt-2">
                                                    <div class="card p-3 justify-content-center align-items-center">
                                                        <div class="circular-progress">
                                                            <div class="value-container">0%</div>
                                                        </div>
                                                        <h4 class="mt-1">Projects Progress</h4>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mt-2">
                                                    <div class="card p-3 justify-content-center align-items-center">
                                                        <div class="circular-progress">
                                                            <div class="value-container">0%</div>
                                                        </div>
                                                        <h4 class="mt-1">Exam Progress</h4>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mt-2">
                                                    <div class="card p-3 justify-content-center align-items-center">
                                                        <div class="circular-progress">
                                                            <div class="value-container">0%</div>
                                                        </div>
                                                        <h4 class="mt-1">Essay Progress</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->


                            </div>
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

<!-- Script Links Bootstrap/Jquery -->
<?php include('assets/scriptlink.view.php')?>

<script src="js/main.js"></script>

<script>
//Tab pane control ----------
let tabHeader = document.getElementsByClassName("tab-header")[0];
let tabIndicator = document.getElementsByClassName("tab-indicator")[0];
let tabBody = document.getElementsByClassName("tab-body")[0];

let tabsPane = tabHeader.getElementsByTagName("div");

for (let i = 0; i < tabsPane.length; i++) {
    tabsPane[i].addEventListener("click", function() {
        tabHeader.getElementsByClassName("active")[0].classList.remove("active");
        tabsPane[i].classList.add("active");
        tabBody.getElementsByClassName("active")[0].classList.remove("active");
        tabBody.getElementsByClassName("tab-content")[i].classList.add("active");

        tabIndicator.style.left = `calc(calc(100% / 4) * ${i})`;
    });
}

//Module collapse ----------
let hideContent = document.querySelectorAll(".content-collapse");
let customHideTable = document.querySelectorAll(".section-table-content");

for (let i = 0; i < hideContent.length; i++) {
    hideContent[i].addEventListener("click", function() {
        customHideTable[i].classList.toggle("custom-hide");
    });
}

// Task Progress ----------
let totalModule = 10;
let speed = 10;

// --List of progress bar --
var progressList = document.querySelectorAll('.circular-progress');
var valueContList = document.querySelectorAll('.value-container');

// --Calculate the subject progress --
let subjectProgressEndValue = progressEndValue(6, totalModule);

// --Loop through each progress bar
for (i = 0; i < progressList.length; i++) {
    progressList[i];
    progressDisplay(progressList[i], valueContList[i], subjectProgressEndValue);
}

function progressDisplay(progressIndicator, startValue, endValue) {
    let progressValue = 0;
    let progress = setInterval(() => {
        progressValue++;
        if (endValue == 0) {
            progressValue = 0;
        }

        if (progressValue <= 60) {
            startValue.textContent = `${progressValue}%`;
            progressIndicator.style.background = `conic-gradient(
                    #38E54D ${progressValue * 3.6}deg,
                    #888 ${progressValue * 3.6}deg
                )`;
        }

        if (progressValue == endValue) {
            clearInterval(progress);
        }
    }, speed);
}

// --Calculate Progress Result
function progressEndValue(count, total) {
    let result = Math.round((count / total) * 100);
    if (result == 0) {
        return 100;
    }
    return result;
}
</script>

</body>

</html>
<!-- Footer
© 2022 GitHub, Inc.
Footer navigation
Terms
Privacy
Security
Status
Docs
Contact GitHub
Pricing
API
Training
Blog
About
OLMS_Main/student.subjects.php at main · RubenMacapugay/OLMS_Main -->