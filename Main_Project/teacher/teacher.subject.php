<?php 
include('assets/header.view.php');

// if(isset($_SESSION['subjectId'])){
//     echo 'Section: '.$_SESSION['section_id']; 
// }else{
//     echo "failed";
// }
?>

<?php 
$sectionId = $_SESSION['section_id'];
$subjectId = $_SESSION['subjectId'];
$teacherId = $_SESSION['teacher_id'];




// get subject
$currentSubjectData = teacherSubjectExist2($conn, $subjectId, $sectionId, $teacherId);

// get the total task
$totalTaskCount = checkTotalTaskCount($conn, $subjectId);
// getTask count per grading;
$firstGradingTask = checkTaskCountPerGrading($conn, $subjectId, 1);
$secondGradingTask = checkTaskCountPerGrading($conn, $subjectId, 2);
$thirdGradingTask = checkTaskCountPerGrading($conn, $subjectId, 3);
$fourthGradingTask = checkTaskCountPerGrading($conn, $subjectId, 4);

# Display task per grading
$resultTasksFirstGrading = getTasksPerGrading($conn, $subjectId, 1);
$resultTasksSecondGrading = getTasksPerGrading($conn, $subjectId, 2);
$resultTasksThirdGrading = getTasksPerGrading($conn, $subjectId, 3);
$resultTasksFourthGrading = getTasksPerGrading($conn, $subjectId, 4);

# display the module section in first grading
$resultModuleSectionFirstGrading = getModuleSection($conn, $subjectId, 1);
$resultModuleSectionSecondGrading = getModuleSection($conn, $subjectId, 2);
$resultModuleSectionThirdGrading = getModuleSection($conn, $subjectId, 3);
$resultModuleSectionFourthGrading = getModuleSection($conn, $subjectId, 4);

// Display all subject's students by section
$resultStudentsSubjectSection = getSubjectStudents($conn);

// Display all subject's students by section progress
$resultStudentProgress = getSubjectStudentsProgress($conn, $sectionId, $subjectId);

$resultStudentList = getSubjectsStudentList($conn, $sectionId, $subjectId);

//display the subject name
// $selectSubjectName = "SELECT *, subject_list_tbl.subject_list_name FROM ((student_tbl INNER JOIN subject_list_tbl ON student_tbl.student_id = subject_list_tbl.fk_student_id ))WHERE  subject_list_tbl.fk_section_id = 1 AND subject_list_tbl.fk_teacher_id = 1 AND subject_list_tbl.fk_subject_id = 1";

//display Task List
$resultTaskList =  getTasks($conn, $subjectId, $teacherId);
?>  

<!-- Modal -->

<!-- upload module -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="uploadModalLabel">Upload Files</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../../includes/teacher.upload.php" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    <div class="form-group">
                        <label>File Name</label>
                        <input type="text" name="file_name" class="form-control" placeholder="Subject Name" required>
                    </div>
                    <div class="form-group">
                        <label>Upload Files</label>
                        <input type="file" name="file_upload" id="fileInput" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="btnUpload" class="btn btn-primary">Upload</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- edit module -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit File</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?php
            // if (isset($_POST['edit_data_btn'])) {
            
            //     $id = $_POST['file_edit_id'];

            //     $query = "SELECT * FROM module_tbl WHERE module_id ='$id'";
            //     $query_run = mysqli_query($conn, $query);

            //     foreach ($query_run as $row) {
            ?>
            <form action="../../includes/teacher.upload.php" method="POST" enctype="multipart/form-data">

             <input type="hidden" name="file_edit_id" value="<?php echo $row['module_id']?>">

                <div class="modal-body">
                    <div class="form-group">
                        <label>File Name</label>
                        <input type="text" name="file_edit_name" class="form-control" placeholder="Subject Name" value="<?php echo $row['module_name']?>" required>
                    </div>
                    <div class="form-group">
                        <label>Upload File</label>
                        <input type="file" name="file_upload" id="fileInput" class="form-control" value="<?php echo $row['module_file']?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="update_btn" class="btn btn-primary">Update</button>
                </div>
            </form>
            <?php
            //     }
            // }

            ?>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="uploadModalLabel">Upload Files</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="teacher.upload.php" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    <p>Are you sure you want to delete this?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" name="btnUpload" class="btn btn-primary">Yes</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- edit task ** no use-->
<div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit Task</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="update_btn" class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- save grading section content -->
<div class="modal fade" id="createModuleSection" tabindex="-1" aria-labelledby="createModuleSection" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createModuleSection">Create Module Section</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../../includes/teacher.createtask.inc.php" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    <input type="text" id="moduleSectionGradingId" name="moduleSectionGradingId">
                    <div class="form-group">
                        <label>Section name</label>
                        <input type="text" name="moduleSectionName" class="form-control" placeholder="Module Section name" required>
                    </div>
                    <div class="form-group">
                        <label>Section description</label>
                        <input type="text" name="moduleSectinDesc" class="form-control" placeholder="Description" required>
                    </div>
                    
                </div>

                <input type="hidden" grading>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="createModuleSection" class="btn btn-primary" id="modalCreateGradingSection">Create</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- updating grading section content -->
<div class="modal fade" id="updateModuleSection" tabindex="-1" aria-labelledby="updateModuleSection" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="updateModuleSectionTitle">Update Section content</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="../../includes/teacher.createtask.inc.php" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    <input type="hidden" name="updateModuleSectionGradingId" id="updateModuleSectionGradingId" class="form-control updateModuleSectionGradingId" placeholder="Module Section name" required>
                    <input type="hidden" name="updateModuleSectionId" id="updateModuleSectionId" class="form-control updateModuleSectionId" placeholder="Module Section name" required>
                    <div class="form-group">
                        <label>Section name</label>
                        <input type="text" name="updateModuleSectionName" id="updateModuleSectionName" class="form-control updateModuleSectionName" placeholder="Module Section name" required>
                    </div>
                    <div class="form-group">
                        <label>Section description</label>
                        <input type="text" name="updateModuleSectionDesc" id="updateModuleSectinDesc" class="form-control updateModuleSectinDesc" placeholder="Description" required>
                    </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="updateModuleSection" class="btn btn-primary" id="modalUpdateGradingSection">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- End of Modal -->

<!-- update task details -->
<div class="modal fade" id="updateModalTask" tabindex="-1" aria-labelledby="updateTask" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="updateTaskTitle">Update Task</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="container-fluid">
                <form action="../../includes/teacher.createtask.inc.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row task-details">
                            <div class="form-group">
                                <!-- get the task details --> 
                                <!-- Task Id -->
                                <input type="hidden" id="updateTaskId" name="updateTaskId">
                                <input type="hidden" id="inputSubType" name="inputSubType">
                                <!-- Task Name -->
                                <div class="mb-3">
                                    <label for="inputTaskDescription" class="form-label mb-0">Task
                                        Name</label>
                                    <input type="name" class="form-control" name="taskname"
                                        id="inputTaskDescription" aria-describedby="taskname"
                                        placeholder="sample: 01 Quiz 01">
                                </div>

                                <!-- Duration -->
                                <div class="mb-3">
                                    <label class="form-check-label" for="inputDates">Due date</label>
                                    <div class="d-flex align-items-center">
                                        <input type="date" class="form-control" name="datedeadline"
                                            id="inputEndDate">
                                    </div>
                                </div>

                                <!-- Attempts and Time -->
                                <div class="row">
                                    <!-- Time -->
                                    <div class="col-6 mb-3">
                                        <label for="inputTime">Due time</label>
                                        <input type="time" class="form-control" name="timelimit" id="inputTime">
                                    </div>
                                    
                                    <!-- Max Attempts -->
                                    <div class="col-6">
                                        <label for="inputMaxAttempt">Max attemps</label>
                                        <input type="number" class="form-control" name="maxattempts"
                                            id="inputMaxAttempts"  min="0">
                                    </div>
                                </div>

                                <!-- Max score and allow late submission -->
                                <div class="row mb-3">
                                    <!-- max score -->
                                    <div class="col-6 mb-3 " id="inputMaxScoreDiv">
                                        <label for="inputMaxScore">Max score</label>
                                        <input type="number" class="form-control"  name="maxscore"
                                            id="inputMaxScore" min="0">
                                    </div>
                                    
                                    <!-- allow late submission -->
                                    <div class="col-6">
                                        <label>Allow late submission</label>
                                        <div class="mt-1">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="submissionchoice" type="radio"
                                                    id="radioYes" checked value="Yes">
                                                <label class="form-check-label" for="radioYes">
                                                    Yes
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="submissionchoice" type="radio"
                                                    id="radioNo" value="No">
                                                <label class="form-check-label" for="radioNo">
                                                    no
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="updateModalTaskWithQuestion" class="btn btn-primary" id="updateModalTaskWithQuestion">Update</button>
                        <button type="submit" name="updateModalEssay" class="btn btn-primary" id="updateModalEssay">Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- delete task modal -->
<div class="modal fade" id="deleteModalTask" tabindex="-1" aria-labelledby="deleteModalTask" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="container-fluid">
                <form action="../../includes/teacher.createtask.inc.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body text-center">
                        <h1 class="modal-title fs-5" id="updateTaskTitle">Do you want to delete the task?</h1>
                        <input type="hidden" class="deleteTaskId" name="inputDeleteTaskId">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="deleteModalTaskBtn" class="btn btn-danger" id="deleteModalTaskBtn">Delete</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<!-- End of Modal -->

<!--Body content --> 
<div class="container-fluid " id="content">
    <div class="row overflow-hidden"> 
        
        <!-- Left Side Nav global-->
        <div class="col-md-2 " id="sideNav">
            <!-- <button class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#updateModalTask">Click me</button> -->
            <?php include('assets/sidebar.view.php') ?>
        </div>

        <!-- Main Content -->
        <div class="col-md-8 py-4 main-content" id="teacherSubjectContent">
            <div class="row mx-0">

                <div class="container-fluid">
                    <!-- <button class="dangerBtn" onclick="showTab()">Danger</button> -->
                    
                    <!-- validation message -->
                    <?php 

                        if(isset($_SESSION["taskGiven"])){
                            if($_SESSION["taskGiven"] == "taskGiven"){
                                if($_SESSION['taskGivenStatus'] == "Yes"){
                                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        Task is now visible!
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>';
                                } else if($_SESSION['taskGivenStatus'] == "No"){
                                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        Task is now not visible!
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>';
                                }

                                if($_GET['tab'] == "moduleTab"){
                                    echo "<script> window.onload = function() {
                                        showGradingTab();
                                    }; </script>";
                                } else if($_GET['tab'] == "taskTab"){
                                    echo "<script> window.onload = function() {
                                        showTaskTab();
                                    }; </script>";
                                }
                                
        
                                unset($_SESSION["taskGiven"]);
                            }
                        }

                        if(isset($_SESSION['moduleSectionCreated'])){
                            if($_SESSION['moduleSectionCreated'] == 'yes'){
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            Module Section has been created!
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
                                unset($_SESSION['moduleSectionCreated']);
                            }
                        }

                        if(isset($_SESSION['msg'])){
                            if($_SESSION['msg'] == "modulenametaken"){
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            Module Section has been taken!
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
                            }
                            if($_SESSION['msg'] == "modulesectionupdated"){
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            Module Section has been updated!
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
                            }
                            if($_SESSION['msg'] == "taskDeleted"){
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            Task has been deleted!
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
                            }
                            if($_SESSION['msg'] == "taskDeletedFailed"){
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            Task has been deleted!
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
                            }
                            if($_SESSION['msg'] == "taskupdated"){
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            Task has been Updated!
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
                                if($_GET['tab'] == "taskTab"){
                                    echo "<script> window.onload = function() {
                                        showTaskTab();
                                    }; </script>";
                                }
                            }
                            

                            unset($_SESSION['msg']);
                        }
                        if(isset($_GET['tab'])){
                            if($_GET['tab'] == "taskTab"){
                                echo "<script> window.onload = function() {
                                    showTaskTab();
                                }; </script>";
                            }
                            if($_GET['tab'] == "gradeBook"){
                                echo "<script> window.onload = function() {
                                    showGradingTab();
                                }; </script>";
                            }
                            if($_GET['tab'] == "moduleTab"){
                                
                                echo "<script> window.onload = function() {
                                    showModuleTab();
                                }; </script>";
                            }
                        }
                    ?>

                    <!-- Subject Header (tabpane header) -->
                    <div class="row">
                        <div class="col-8">
                            <div class="tab-header">
                                <div class="active">
                                    Modules
                                </div>
                                <div>
                                    Task
                                </div>
                                <div>
                                    Students
                                </div>
                                <div>
                                    Grade Book
                                </div>
                            </div>
                            <div class="tab-indicator"></div>
                        </div>
                    </div>

                    <!-- Subject Content (tabpane body) -->
                    <div class="row mt-2">
                        <div class="tabs px-0">
                            <div class="tab-body">

                                <!-- Subject Modules Tab -->
                                <div class="active tab-content p-2" >
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #1F78FC; color: white; font-weight: bold;">
                                            <h2 class="mb-0"><?php echo $currentSubjectData['subject_list_name']?></h2>
                                            <p class="mb-0 me-4"><?php echo $currentSubjectData['grade_level_name'].' - '.$currentSubjectData['section_name']?></p>
                                            <!-- <p>Subject Description</p>
                                            <p>description Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                                Atque
                                                ipsum
                                                reprehenderit voluptas sed et sint.</p> -->
                                        </div>

                                    </div>

                                    <!-- First Grading -->
                                    <div class="section-module mt-2 card ">

                                        <!-- Adding module -->
                                        <div class="card-header">

                                            <h3 class="section-title ">First Grading</h3>
                                            <br>

                                            <div>
                                                <ul class="nav justify-content-between align-items-center">
                                                    <li class="nav-item"><?php echo $firstGradingTask; ?> task</li>
                                                    <li class="nav-item d-flex align-items-center">
                                                        <i class="fa-solid fa-circle-plus" data-bs-toggle="modal" data-bs-target="#uploadModal"></i>
                                                        <a class="nav-link content-collapse" type=""><?php echo $firstGradingTask;?> Content <i
                                                                class="fa-solid fa-chevron-down"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- First Grading Content -->
                                        <div class="card-body section-table-content custom-hide">

                                            <!-- Module Section resultModuleSectionFirstGrading -->
                                            <?php while($rowModuleTask = $resultModuleSectionFirstGrading->fetch_assoc()): ?>
                                                <div class="card mb-2">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">

                                                            <!-- for updating module_section -->
                                                            <div class="d-flex">
                                                                <span class="d-none" id="moduleGradingId"><?php echo $rowModuleTask['fk_grading_id'];?></span>
                                                                <span class="d-none" id="moduleTaskId"><?php echo $rowModuleTask['module_section_id'];?></span>
                                                                <span class="d-none" id="moduleTaskDesc"><?php echo $rowModuleTask['module_section_desc']; ?></span>
                                                                <h4 class="module-section-title" id="moduleTaskName"><?php echo $rowModuleTask['module_section_name']; ?> </h4>
                                                                <i class="fa-regular fa-pen-to-square text-primary editGradingModuleSection ms-2"
                                                                                        type="button"></i>
                                                            </div>
                                                            <a class="nav-link text-primary content-collapse" type=""> Hide <i
                                                                    class="fa-solid fa-chevron-down"></i></a>
                                                        </div>
                                                        <p class="module-section-desc mt-3 mb-0" ><?php echo $rowModuleTask['module_section_desc']; ?></p>

                                                        <!-- Module section task -->
                                                        <table class="table table-hover p-0 section-table section-table-content custom-hide">
                                                            <tbody>
                                                                <!-- Display the Module Section tasks and modules -->
                                                                    <thead>
                                                                        <tr class="text-center">
                                                                            <th></th>
                                                                            <th>Actions</th>
                                                                            <th>Start</th>
                                                                            <th>Due</th>
                                                                            <th>Permit</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <!-- Display the list of modules here per Module Section -->
                                                                    <tr class="module-module">
                                                                        <td class="">
                                                                            <a class="section-link" href="student.module.php">01 Module 1</a>
                                                                        </td>
                                                                        <td>
                                                                            <i class="fa-regular fa-pen-to-square text-primary  me-2" type="button" data-bs-toggle="modal" data-bs-target="#editModal"></i>
                                                                            <i class="fa-solid fa-trash text-danger me-2" type="button" name = "delete_data_btn" data-bs-toggle="modal" data-bs-target="#deleteModal"></i>
                                                                        </td>
                                                                        <td class="">-</td>
                                                                        <td class="">-</td>
                                                                        <td class="">
                                                                            <input class="btn btn-success fs-6 py-0" type="submit" value="give">
                                                                        </td>
                                                                    </tr>

                                                                    <!-- Displaying Task Per Module_section_tbl -->

                                                                    <?php while($rowGrading = $resultTasksFirstGrading->fetch_assoc()): 
                                                                        $tableRowTaskId = $rowGrading['task_list_id'];
                                                                        $tableRowTaskName = $rowGrading['task_name'];
                                                                        ?>
                                                                        <tr class="module-task ">
                                                                            
                                                                            <td><?php echo '<a href="teacher.editTask.php?taskId='.$tableRowTaskId.'&&tab=fromModule">'.$tableRowTaskName.'</a>';?></td>
                                                                            <td>
                                                                                <i class="fa-regular fa-pen-to-square text-primary  me-2" type="button" data-bs-toggle="modal" data-bs-target="#editTaskModal"></i>
                                                                                <i class="fa-solid fa-trash text-danger me-2"
                                                                                    type="button"></i>
                                                                            </td>
                                                                            <td class="">-</td>
                                                                            <td class="">-</td>
                                                                            <td class="">
                                                                                <form method='POST' action='../../includes/teacher.createtask.inc.php'>
                                                                                    <input type="hidden" type="hidden" name="taskId" value="<?php echo $rowGrading['task_list_id'];?>"> 
                                                                                    
                                                                                    <?php 
                                                                                        $isGiven = $rowGrading['given'];
                                                                                        if($isGiven == "Yes"){
                                                                                            echo '<input type="hidden" type="hidden" name="isGiven" value="No">';
                                                                                            echo '<input class="btn btn-danger fs-6 py-0" type="submit" name="updateTaskGive" value="ungive">';
                                                                                            
                                                                                        } else if($isGiven == "" || $isGiven == "No"){
                                                                                            echo '<input type="hidden" type="hidden" name="isGiven" value="Yes">';
                                                                                            echo '<input class="btn btn-success fs-6 py-0" type="submit" name="updateTaskGive" value="give">';
                                                                                        }
                                                                                    ?>
                                                                                </form>
                                                                            </td>
                                                                            
                                                                        </tr>
                                                                    <?php endwhile; ?>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            <?php endwhile; ?>

                                            

                                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModuleSection" id="btnFirstGrading">Add Section</button>

                                        </div>
                                    </div>

                                    <!-- Second Grading -->
                                    <div class="section-module mt-2 card">
                                        <div class="card-header">
                                            <h3 class="section-title ">Second Grading</h3>
                                            <br>
                                            
                                            <!-- Adding module -->
                                            <div>
                                                <ul class="nav justify-content-between align-items-center">
                                                <li class="nav-item"><?php echo $secondGradingTask; ?> task</li>
                                                    <li class="nav-item d-flex align-items-center">
                                                        <i class="fa-solid fa-circle-plus" data-bs-toggle="modal" data-bs-target="#uploadModal"></i>
                                                        <a class="nav-link content-collapse" type=""><?php echo $secondGradingTask; ?> Content <i
                                                                class="fa-solid fa-chevron-down"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Second Grading Content -->
                                        <div class="card-body section-table-content custom-hide">
                                            
                                            <!-- Module Section resultModuleSectionSecondGrading -->
                                            <?php while($rowModuleTask = $resultModuleSectionSecondGrading->fetch_assoc()): ?>
                                                <div class="card mb-2">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div class="d-flex">
                                                                <span class="d-none" id="moduleGradingId"><?php echo $rowModuleTask['fk_grading_id'];?></span>
                                                                <span class="d-none" id="moduleTaskId"><?php echo $rowModuleTask['module_section_id']; ?></span>
                                                                <span class="d-none" id="moduleTaskDesc"><?php echo $rowModuleTask['module_section_desc']; ?></span>
                                                                <h4 class="module-section-title" id="moduleTaskName"><?php echo $rowModuleTask['module_section_name']; ?> </h4>
                                                                <i class="fa-regular fa-pen-to-square text-primary editGradingModuleSection ms-2"
                                                                                        type="button"></i>
                                                            </div>
                                                            <a class="nav-link text-primary content-collapse" type=""> Hide <i
                                                                    class="fa-solid fa-chevron-down"></i></a>
                                                        </div>
                                                        <p class="module-section-desc mt-3 mb-0"><?php echo $rowModuleTask['module_section_desc']; ?></p>
                                                        <table class="table table-hover p-0 section-table section-table-content custom-hide">
                                                            <tbody>
                                                                <!-- Display the Module Section tasks and modules -->
                                                                    <thead>
                                                                        <tr class="text-center">
                                                                            <th></th>
                                                                            <th>Actions</th>
                                                                            <th>Start</th>
                                                                            <th>Due</th>
                                                                            <th>Permit</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <!-- Display the list of modules here per Module Section -->
                                                                    <tr class="module-module">
                                                                        <td class="">
                                                                            <a class="section-link" href="student.module.php">01 Module 1</a>
                                                                        </td>
                                                                        <td>
                                                                                <i class="fa-regular fa-pen-to-square text-primary  me-2"
                                                                                    type="button"></i>
                                                                                <i class="fa-solid fa-trash text-danger me-2"
                                                                                    type="button"></i>
                                                                        </td>
                                                                        <td class="">-</td>
                                                                        <td class="">-</td>
                                                                        <td class="">
                                                                            <input class="btn btn-success fs-6 py-0" type="submit" value="give">
                                                                        </td>
                                                                    </tr>

                                                                    <!-- Displaying Task Per Module_section_tbl -->
                                                                    <?php while($rowGrading = $resultTasksSecondGrading->fetch_assoc()): ?>
                                                                        <tr class="module-task">
                                                                            <td><a href="#"><?php echo $rowGrading['task_name'];?></a></td>
                                                                            <td>
                                                                                <i class="fa-regular fa-pen-to-square text-primary  me-2"
                                                                                    type="button"></i>
                                                                                <i class="fa-solid fa-trash text-danger me-2"
                                                                                    type="button"></i>
                                                                            </td>
                                                                            <td class="">-</td>
                                                                            <td class="">-</td>
                                                                            <td class="">
                                                                                <form method='POST' action='../../includes/teacher.createtask.inc.php'>
                                                                                    <input type="hidden" type="hidden" name="taskId" value="<?php echo $rowGrading['task_list_id'];?>"> 
                                                                                    
                                                                                    <?php 
                                                                                        $isGiven = $rowGrading['given'];
                                                                                        if($isGiven == "Yes"){
                                                                                            echo '<input type="hidden" type="hidden" name="isGiven" value="No">';
                                                                                            echo '<input class="btn btn-danger fs-6 py-0" type="submit" name="updateTaskGive" value="ungive">';
                                                                                            
                                                                                        } else if($isGiven == "" ||$isGiven == "No"){
                                                                                            echo '<input type="hidden" type="hidden" name="isGiven" value="Yes">';
                                                                                            echo '<input class="btn btn-success fs-6 py-0" type="submit" name="updateTaskGive" value="give">';
                                                                                        }
                                                                                    ?>
                                                                                </form>
                                                                            </td>
                                                                            
                                                                        </tr>
                                                                    <?php endwhile; ?>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            <?php endwhile; ?>

                                           
                                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModuleSection" id="btnSecondGrading">Add Section</button>
                                        </div>
                                    </div>

                                    <!-- Third Grading -->

                                    <div class="section-module mt-2 card">
                                        <div class="card-header">
                                            <h3 class="section-title">Third Grading</h3>
                                            <br>
                                            <div>
                                                <ul class="nav justify-content-between align-items-center">
                                                <li class="nav-item"><?php echo $thirdGradingTask; ?> task</li>
                                                    <li class="nav-item d-flex align-items-center">
                                                        <i class="fa-solid fa-circle-plus" data-bs-toggle="modal" data-bs-target="#uploadModal"></i>
                                                        <a class="nav-link content-collapse" type=""><?php echo $thirdGradingTask; ?> Content <i
                                                                class="fa-solid fa-chevron-down"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Third Grading Content -->
                                        <div class="card-body section-table-content custom-hide">
                                            
                                            <!-- Module Section resultModuleSectionThirdGrading -->
                                            <?php while($rowModuleTask = $resultModuleSectionThirdGrading->fetch_assoc()): ?>
                                                <div class="card mb-2">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div class="d-flex">
                                                                <span class="d-none" id="moduleGradingId"><?php echo $rowModuleTask['fk_grading_id'];?></span>
                                                                <span class="d-none" id="moduleTaskId"><?php echo $rowModuleTask['module_section_id']; ?></span>
                                                                <span class="d-none" id="moduleTaskDesc"><?php echo $rowModuleTask['module_section_desc']; ?></span>
                                                                <h4 class="module-section-title" id="moduleTaskName"><?php echo $rowModuleTask['module_section_name']; ?> </h4>
                                                                <i class="fa-regular fa-pen-to-square text-primary editGradingModuleSection ms-2"
                                                                                        type="button"></i>
                                                            </div>
                                                            <a class="nav-link text-primary content-collapse" type=""> Hide <i
                                                                    class="fa-solid fa-chevron-down"></i></a>
                                                        </div>
                                                        <p class="module-section-desc mt-3 mb-0"><?php echo $rowModuleTask['module_section_desc']; ?></p>
                                                        <table class="table table-hover p-0 section-table section-table-content custom-hide">
                                                            <tbody>
                                                                <!-- Display the Module Section tasks and modules -->
                                                                    <thead>
                                                                        <tr class="text-center">
                                                                            <th></th>
                                                                            <th>Actions</th>
                                                                            <th>Start</th>
                                                                            <th>Due</th>
                                                                            <th>Permit</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <!-- Display the list of modules here per Module Section -->
                                                                    <tr class="module-module">
                                                                        <td class="">
                                                                            <a class="section-link" href="student.module.php">01 Module 1</a>
                                                                        </td>
                                                                        <td>
                                                                                <i class="fa-regular fa-pen-to-square text-primary  me-2"
                                                                                    type="button"></i>
                                                                                <i class="fa-solid fa-trash text-danger me-2"
                                                                                    type="button"></i>
                                                                        </td>
                                                                        <td class="">-</td>
                                                                        <td class="">-</td>
                                                                        <td class="">
                                                                            <input class="btn btn-success fs-6 py-0" type="submit" value="give">
                                                                        </td>
                                                                    </tr>

                                                                    <!-- Displaying Task Per Module_section_tbl -->
                                                                    <?php while($rowGrading = $resultTasksThirdGrading->fetch_assoc()): ?>
                                                                        <tr class="module-task">
                                                                            <td><a href="#"><?php echo $rowGrading['task_name'];?></a></td>
                                                                            <td>
                                                                                <i class="fa-regular fa-pen-to-square text-primary  me-2"
                                                                                    type="button"></i>
                                                                                <i class="fa-solid fa-trash text-danger me-2"
                                                                                    type="button"></i>
                                                                            </td>
                                                                            <td class="">-</td>
                                                                            <td class="">-</td>
                                                                            <td class="">
                                                                                <form method='POST' action='../../includes/teacher.createtask.inc.php'>
                                                                                    <input type="hidden" type="hidden" name="taskId" value="<?php echo $rowGrading['task_list_id'];?>"> 
                                                                                    
                                                                                    <?php 
                                                                                        $isGiven = $rowGrading['given'];
                                                                                        if($isGiven == "Yes"){
                                                                                            echo '<input type="hidden" type="hidden" name="isGiven" value="No">';
                                                                                            echo '<input class="btn btn-danger fs-6 py-0" type="submit" name="updateTaskGive" value="ungive">';
                                                                                            
                                                                                        } else if($isGiven == "" ||$isGiven == "No"){
                                                                                            echo '<input type="hidden" type="hidden" name="isGiven" value="Yes">';
                                                                                            echo '<input class="btn btn-success fs-6 py-0" type="submit" name="updateTaskGive" value="give">';
                                                                                        }
                                                                                    ?>
                                                                                </form>
                                                                            </td>
                                                                            
                                                                        </tr>
                                                                    <?php endwhile; ?>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            <?php endwhile; ?>

                                            
                                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModuleSection" id="btnThirdGrading">Add Section</button>
                                        </div>
                                        
                                    </div>

                                    <!-- Fourth Grading -->
                                    <div class="section-module mt-2 card">
                                        <div class="card-header">
                                            <h3 class="section-title">Forth Grading</h3>
                                            <br>
                                            <div>
                                                <ul class="nav justify-content-between align-items-center">
                                                <li class="nav-item"><?php echo $fourthGradingTask; ?> task</li>
                                                    <li class="nav-item d-flex align-items-center">
                                                        <i class="fa-solid fa-circle-plus" data-bs-toggle="modal" data-bs-target="#uploadModal"></i>
                                                        <a class="nav-link content-collapse" type=""><?php echo $fourthGradingTask; ?> Content <i
                                                                class="fa-solid fa-chevron-down"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Fourth Grading Content -->
                                        <div class="card-body section-table-content custom-hide">
                                                                
                                            <!-- Module Section resultModuleSectionFourthGrading -->
                                            <?php while($rowModuleTask = $resultModuleSectionFourthGrading->fetch_assoc()): ?>
                                                <div class="card mb-2">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <div class="d-flex">
                                                                <span class="d-none" id="moduleGradingId"><?php echo $rowModuleTask['fk_grading_id'];?></span>
                                                                <span class="d-none" id="moduleTaskId"><?php echo $rowModuleTask['module_section_id']; ?></span>
                                                                <span class="d-none" id="moduleTaskDesc"><?php echo $rowModuleTask['module_section_desc']; ?></span>
                                                                <h4 class="module-section-title" id="moduleTaskName"><?php echo $rowModuleTask['module_section_name']; ?> </h4>
                                                                <i class="fa-regular fa-pen-to-square text-primary editGradingModuleSection ms-2"
                                                                                        type="button"></i>
                                                            </div>
                                                            <a class="nav-link text-primary content-collapse" type=""> Hide <i
                                                                    class="fa-solid fa-chevron-down"></i></a>
                                                        </div>
                                                        <p class="module-section-desc mt-3 mb-0"><?php echo $rowModuleTask['module_section_desc']; ?></p>
                                                        <table class="table table-hover p-0 section-table section-table-content custom-hide">
                                                            <tbody>
                                                                <!-- Display the Module Section tasks and modules -->
                                                                    <thead>
                                                                        <tr class="text-center">
                                                                            <th></th>
                                                                            <th>Actions</th>
                                                                            <th>Start</th>
                                                                            <th>Due</th>
                                                                            <th>Permit</th>
                                                                        </tr>
                                                                    </thead>

                                                                    <!-- Display the list of modules here per Module Section -->
                                                                    <tr class="module-module">
                                                                        <td class="">
                                                                            <a class="section-link" href="student.module.php">01 Module 1</a>
                                                                        </td>
                                                                        <td>
                                                                                <i class="fa-regular fa-pen-to-square text-primary  me-2"
                                                                                    type="button"></i>
                                                                                <i class="fa-solid fa-trash text-danger me-2"
                                                                                    type="button"></i>
                                                                        </td>
                                                                        <td class="">-</td>
                                                                        <td class="">-</td>
                                                                        <td class="">
                                                                            <input class="btn btn-success fs-6 py-0" type="submit" value="give">
                                                                        </td>
                                                                    </tr>

                                                                    <!-- Displaying Task Per Module_section_tbl -->
                                                                    <?php while($rowGrading = $resultTasksFourthGrading->fetch_assoc()): ?>
                                                                        <tr class="module-task">
                                                                            <td><a href="#"><?php echo $rowGrading['task_name'];?></a></td>
                                                                            <td>
                                                                                <i class="fa-regular fa-pen-to-square text-primary  me-2"
                                                                                    type="button"></i>
                                                                                <i class="fa-solid fa-trash text-danger me-2"
                                                                                    type="button"></i>
                                                                            </td>
                                                                            <td class="">-</td>
                                                                            <td class="">-</td>
                                                                            <td class="">
                                                                                <form method='POST' action='../../includes/teacher.createtask.inc.php'>
                                                                                    <input type="hidden" type="hidden" name="taskId" value="<?php echo $rowGrading['task_list_id'];?>"> 
                                                                                    
                                                                                    <?php 
                                                                                        $isGiven = $rowGrading['given'];
                                                                                        if($isGiven == "Yes"){
                                                                                            echo '<input type="hidden" type="hidden" name="isGiven" value="No">';
                                                                                            echo '<input class="btn btn-danger fs-6 py-0" type="submit" name="updateTaskGive" value="ungive">';
                                                                                            
                                                                                        } else if($isGiven == "" ||$isGiven == "No"){
                                                                                            echo '<input type="hidden" type="hidden" name="isGiven" value="Yes">';
                                                                                            echo '<input class="btn btn-success fs-6 py-0" type="submit" name="updateTaskGive" value="give">';
                                                                                        }
                                                                                    ?>
                                                                                </form>
                                                                            </td>
                                                                            
                                                                        </tr>
                                                                    <?php endwhile; ?>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            <?php endwhile; ?>

                                           

                                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModuleSection" id="btnFourthGrading">Add Section</button>
                                        </div>
                                    </div>

                                </div>

                                <!-- Subject Task -->
                                <div class="tab-content ">
                                    <div class="container-fluid">
                                        <div class="row mt-3">
                                            <div class="col-8 d-flex justify-content-start align-items-center">
                                                <div class="dropdown">
                                                    <!-- Send subject id on url -->
                                                    <?php $currentSubject = $_SESSION['subjectId'];?>
                                                    <a class="btn btn-primary" type="button"
                                                        href="teacher.createtask.php?currentSubject=<?php echo $currentSubject; ?>">
                                                        Create Task <i class="fa-solid fa-circle-plus ms-1"></i>
                                                    </a>
                                                </div>

                                            </div>

                                            <!-- <div class="col-4 d-flex">
                                                <div class="module-actions d-flex justify-content-end align-items-center p-2">
                                                 
                                                    <select class="form-select w-100"
                                                        aria-label="Default select example">
                                                        <option selected>All</option>
                                                        <option value="1">Quizzes</option>
                                                        <option value="2">Activity</option>
                                                        <option value="3">Assignment</option>
                                                        <option value="4">Major Examination</option>
                                                    </select>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="custom-border m-2">
                                        <h4>Task List</h4>
                                        <div class="card m-2">
                                            <table class="table table-hover ms-1 ">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Task Names</th>
                                                        <th scope="col" class="text-center">Action</th>
                                                        <th scope="col" class="text-center">Start</th>
                                                        <th scope="col" class="text-center">Due</th>
                                                        <th scope="col" class="text-center">Status</th>
        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        //Getting results from subject_tbl
                                                        $subjectId = $_SESSION['subjectId'];
                                                        $selectTaskList = "SELECT * FROM task_list_tbl WHERE fk_subject_list_id= $subjectId";
                                                        $resultList =  $conn->query($selectTaskList) or die ($mysqli->error);
                                                    ?>
                                                    <?php while($row = $resultList->fetch_assoc()): ?>
                                                        <?php 
                                                            $tableRowTaskId = $row['task_list_id'];
                                                            $tableRowTaskName = $row['task_name'];
                                                            $tableRowSubType = $row['sub_type'];
                                                            $tableRowDueDate = $row['date_deadline'];
                                                            $tableRowDueTime = $row['time_limit'];
                                                            $tableRowMaxAttempts = $row['max_attempts'];
                                                            $tableRowQuestionItem = $row['question_item'];
                                                            $tableRowMaxScore = $row['max_score'];
                                                            $tableRowAllowLate = $row['submission_choice'];
        
                                                            $startedDate = strtotime($row['date_created']);
                                                            $formatedDateCreated = date('F, j Y', $startedDate);
        
                                                            $endDate = strtotime($row['date_deadline']);
                                                            $formatedDateDue = date('F, j Y', $endDate);
                                                        ?>
                                                        <tr>
                                                            
                                                            <td>
                                                                <?php echo '<a href="teacher.editTask.php?taskId='.$tableRowTaskId.'">'.$tableRowTaskName.'</a>';?>
                                                            </td>
                                                            <td>
                                                                <div>
                                                                    <!-- Task details -->
                                                                    <span class="d-none" id="taskId_DeleteEdit"><?php echo $tableRowTaskId;?></span>
        
                                                                    <span class="d-none" id="tableTaskName"><?php echo $tableRowTaskName;?></span>
                                                                    <span class="d-none" id="tableSubType"><?php echo $tableRowSubType;?></span>
                                                                    <span class="d-none" id="tableDueDate"><?php echo $tableRowDueDate;?></span>
                                                                    <span class="d-none" id="tableDueTime"><?php echo $tableRowDueTime;?></span>
                                                                    <span class="d-none" id="tableMaxAttempts"><?php echo $tableRowMaxAttempts;?></span>
                                                                    <span class="d-none" id="tableQuestionItem"><?php echo $tableRowQuestionItem;?></span>
                                                                    <span class="d-none" id="tableMaxScore"><?php echo $tableRowMaxScore;?></span>
                                                                    <span class="d-none" id="tableAllowLate"><?php echo $tableRowAllowLate;?></span>
        
                                                                    <i class="fa-regular fa-pen-to-square text-primary  updateTableTaskBtn me-2"></i>
                                                                    <i class="fa-solid fa-trash text-danger me-2 deleteTableTaskBtn" ></i>
                                                                </div>
                                                            </td>
                                                            <td><?php echo $formatedDateCreated?></td>
                                                            <td><?php echo $formatedDateDue ?></td>
                                                            <td>
                                                                <form method='POST' action='../../includes/teacher.createtask.inc.php'>
                                                                    <input type="hidden" type="hidden" name="taskId" value="<?php echo $tableRowTaskId;?>"> 
                                                                    <?php 
                                                                        $isGivenTask = $row['given'];
                                                                        if($isGivenTask == "Yes"){
                                                                            echo '<input type="hidden" type="hidden" name="isGivenTaskTab" value="No">';
                                                                            echo '<input class="btn btn-danger fs-6 py-0" type="submit" name="updateTaskGiveTaskTab" value="ungive">';
                                                                            
                                                                        } else if($isGivenTask == "" || $isGivenTask == "No"){
                                                                            echo '<input type="hidden" type="hidden" name="isGivenTaskTab" value="Yes">';
                                                                            echo '<input class="btn btn-success fs-6 py-0" type="submit" name="updateTaskGiveTaskTab" value="give">';
                                                                        }
                                                                    ?>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                </tbody>
                                            </table>
    
                                        </div>
                                    </div>
                                </div>

                                <!-- Students List -->
                                <div class="tab-content " id="StudentList">
                                    <!-- Sort -->
                                    <div class="container-fluid d-flex justify-content-between align-items-center py-2">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <h3 class="mb-0 me-2 "><?php echo $currentSubjectData['subject_list_name']?></h3>
                                            <p class="mb-0 me-4"><?php echo $currentSubjectData['grade_level_name'].' - '.$currentSubjectData['section_name']?></p>
                                        </div>
                                        <!-- <select class="form-select w-25" aria-label="Default select example">
                                            <option selected>All</option>
                                            <option value="1">Assignment</option>
                                            <option value="2">Activity</option>
                                            <option value="3">Project</option>
                                            <option value="4">Quiz</option>
                                            <option value="5">Exam</option>
                                        </select> -->
                                    </div>
                                    <div class="student-table custom-border m-2" id="subject-students-progress">
                                        <h4>Progress</h4>
                                        <div class="card">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="">Student List</th>
                                                        <!-- <th scope="col" class="text-center">Progress</th> -->
                                                        <th scope="col" class="text-center">Task Completed</th>
                                                        <th scope="col" class="text-center">Enrolled</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- resultStudentsSubjectSection -->
                                                    <?php while ($rowResult = $resultStudentProgress->fetch_assoc()) : 
                                                        $startedDateEnrolled = strtotime($rowResult['student_date_enrolled']);
                                                        $formatedDateEnrolled = date('F, j Y', $startedDateEnrolled);
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $rowResult['student_name'];?></td>
                                                            <!-- <td> -->
                                                                <?php //echo $rowResult['Task_Completed'].' out of '.$totalTaskCount;?>
                                                                <!-- <div class="d-flex justify-content-center">
                                                                    <div class="progress-bar d-inline subjectStudentProgress">
                                                                        <div class="circular-progress">
                                                                            <div class="value-container"></div>
                                                                        </div>
                                                                    </div>
                                                                </div> -->
                                                                
                                                            <!-- </td> -->
                                                            <td><?php echo $rowResult['Task_Completed'].' out of '.$totalTaskCount;?></td>
                                                            
    
                                                            <td><?php echo $formatedDateEnrolled?></td>
    
                                                        </tr>
                                                    <?php endwhile; ?>
                                                    
                                                    
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>


                                </div>

                                <!-- Subject Students Gradebook-->
                                <div class="tab-content " id="subjectStudentList">
                                    <!-- Sort -->
                                    <div class="container-fluid d-flex justify-content-between align-items-center py-2">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <h3 class="mb-0 me-2 "><?php echo $currentSubjectData['subject_list_name']?></h3>
                                            <p class="mb-0 me-4"><?php echo $currentSubjectData['grade_level_name'].' - '.$currentSubjectData['section_name']?></p>
                                        </div>
                                        <!-- <select class="form-select w-25" aria-label="Default select example">
                                            <option selected>All</option>
                                            <option value="1">Assignment</option>
                                            <option value="2">Activity</option>
                                            <option value="3">Project</option>
                                            <option value="4">Quiz</option>
                                            <option value="5">Exam</option>
                                        </select> -->
                                    </div>
                                    <div class="student-table custom-border m-2">
                                        <h4>Student's scores</h4>
                                        <div class="card overflow-scroll">
                                            <div class="card-body">
                                                <table class="table table-hover ">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" class="">Student List</th>
        
                                                            <!-- Display Task List -->
                                                            <?php while ($rowTaskList = $resultTaskList->fetch_assoc()) : ?>
                                                                <th scope="col"  class="text-center task-names">
                                                                    <p><?php echo $rowTaskList['task_name']; ?></p>
                                                                </th>
                                                            <?php endwhile; ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- display students -->
                                                        <?php while ($rowResult = $resultStudentList->fetch_assoc()) : ?>
                                                            <?php 
                                                                $resultTaskList2 =  getTasks($conn, $subjectId, $teacherId);
                                                            ?>
                                                            <tr>
                                                                <td><a href="student_subject.progress.php"><?php echo $rowResult['student_name'] ?></a></td>
                                                                
                                                                <?php while ($rowTaskList2 = $resultTaskList2->fetch_assoc()) : 
                                                                    $studentId = $rowResult['student_id'];
                                                                    $taskId = $rowTaskList2['task_list_id'];
                                                                    $maxAttempt = getMaxAttempt2($conn, $taskId, $studentId);
                                                                    $scoreResult;
                                                                    if($maxAttempt[0] == null){
                                                                        $scoreResult = "-";
                                                                    }
                                                                    else{
                                                                        $studentAnswer = getScore2($conn, $taskId, $maxAttempt[0], $studentId);
                                                                        $scoreResult = $studentAnswer['score'];
                                                                    }
                                                                    ?>
                                                                    
                                                                    <td scope="col" class="text-center"><?php echo $scoreResult?></td>
                                                                <?php endwhile; ?>
                                                            </tr>
        
                                                        <?php endwhile; ?>
        
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>


                                </div>
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

<!-- Progress bar -->
<script>
    let totalModule = 10;
    let speed = 10;

    // List of progress bar --
    var progressList = document.querySelectorAll('.circular-progress');

    // Calculate the subject progress --
    let subjectProgressEndValue = progressEndValue(10, totalModule);

    // Loop through each progress bar
   

    $(".subjectStudentProgress").each(function(){
        for (i = 0; i < progressList.length; i++) {
            progressList[i];
            progressDisplay(progressList[i], subjectProgressEndValue);
        }
    });

    function progressDisplay(progressIndicator, endValue) {
        let progressValue = 0;
        let progress = setInterval(() => {
            progressValue++;
            if (endValue == 0) {
                progressValue = 0;
            }

            progressIndicator.style.background = `conic-gradient(
            #FFD61E ${progressValue * 3.6}deg,
            #fff ${progressValue * 3.6}deg
        )`;
            if (progressValue == endValue) {
                clearInterval(progress);
                progressIndicator.style.background = `conic-gradient(
            #1ABD13 ${progressValue * 3.6}deg,
            #fff ${progressValue * 3.6}deg
        )`;
            }
        }, speed);
    }

    function progressEndValue(count, total) {
        let result = Math.round((count / total) * 100);
        if (result == 0) {
            return 100;
        }
        return result;
    }
</script>

<!-- Collapse grading and module sections -->
<script>

    //Module collapse
    let hideContent = document.querySelectorAll("#teacherSubjectContent .content-collapse");
    let customHideTable = document.querySelectorAll(".section-table-content");

    for (let i = 0; i < hideContent.length; i++) {
        hideContent[i].addEventListener("click", function() {
            customHideTable[i].classList.toggle("custom-hide");
        });
    }

   

    //Change task type (modal - create_tas_modals.php)
    var lookup = {
        '1': ['No subtask'],
        '2': ['Multiple Choice', 'Identification', 'Enumiration', 'Essay'],
        '3': ['Multiple Choice', 'Identification', 'Enumiration'],
        '4': ['Multiple Choice', 'Identification', 'Enumiration'],
    };

    // When an option is changed, search the above for matching choices
    $('#options').on('change', function() {
        // Set selected option as variable
        var selectValue = $(this).val();

        // Empty the target field
        $('#choices').empty();

        // For each chocie in the selected option
        for (i = 0; i < lookup[selectValue].length; i++) {
            // Output choice in the target field
            $('#choices').append("<option value='" + lookup[selectValue][i] + "'>" + lookup[selectValue][i] +
                "</option>");
        }
    });

    // Change update and create button for modalCreateUpdateGradingSection
    $('#btnFirstGrading').on('click', function(e){
        createDisplay();
    });

    $('#modalCreateUpdateGradingSection').on('click', function(e){
        updateDisplay();
    });

    //  create button
    function createDisplay(){
        $('#modalUpdateGradingSection').hide();
        $('#modalCreateGradingSection').show();
    }

    // update button
    function updateDisplay(){
        $('#modalCreateGradingSection').hide();
        $('#modalUpdateGradingSection').show();
    }

</script>

<!-- Modal openners -->
<script type="text/javascript">

    // script for updating  module_section
    $(document).ready(function (){
        $(document).on('click', '.editGradingModuleSection', function(){
            var moduleTaskGradingId = $(this).closest('div').find('#moduleGradingId').text();
            var moduleTaskId = $(this).closest('div').find('#moduleTaskId').text();
            var moduleTaskName = $(this).closest('div').find('#moduleTaskName').text();
            var moduleTaskDesc = $(this).closest('div').find('#moduleTaskDesc').text();

            $('#updateModuleSection').modal('show'); // load modal
            $('.updateModuleSectionGradingId').val(moduleTaskGradingId);
            $('.updateModuleSectionId').val(moduleTaskId);
            $('.updateModuleSectionName').val(moduleTaskName);
            $('.updateModuleSectinDesc').val(moduleTaskDesc);
        });
    });

    // script for update task - updateModalTask
    $(document).ready(function (){
        $(document).on('click', '.updateTableTaskBtn', function(){
            var taskId = $(this).closest('div').find('#taskId_DeleteEdit').text();
            var taskSubType = $(this).closest('div').find('#tableSubType').text();
            var taskName = $(this).closest('div').find('#tableTaskName').text();
            var taskEndDate = $(this).closest('div').find('#tableDueDate').text();
            var taskEndTime = $(this).closest('div').find('#tableDueTime').text();
            var taskMaxAttempts = $(this).closest('div').find('#tableMaxAttempts').text();
            var taskMaxScore = $(this).closest('div').find('#tableMaxScore').text();
            
            // for radio button
            var taskAllowLate = $(this).closest('div').find('#tableAllowLate').text();
            
            // load update modal
            $('#updateModalTask').modal('show'); 
            // Displaying data to fields
            $('#updateTaskId').val(taskId);
            $('#inputSubType').val(taskSubType);
            $('#inputTaskDescription').val(taskName);
            $('#inputEndDate').val(taskEndDate);
            $('#inputTime').val(taskEndTime);
            $('#inputMaxAttempts').val(taskMaxAttempts);
            $('#inputMaxScore').val(taskMaxScore);

            if(taskAllowLate == "Yes"){
                $('#radioYes').prop('checked',true);
            } else  if(taskAllowLate == "No"){
                $('#radioNo').prop('checked',true);
            }

            $('#updateModalTaskWithQuestion').hide();
            $('#updateModalEssay').hide();

            $('#inputMaxScoreDiv').hide();



            // Update buttons visibility 
            switch(taskSubType) {
                case "0":
                    $('#updateModalTaskWithQuestion').show();
                    break;
                case "1":
                    // code block
                    $('#updateModalTaskWithQuestion').show();
                    break;
                case "2":
                    // code block
                    $('#updateModalTaskWithQuestion').show();
                    break;
                case "3":
                    // code block
                    $('#inputMaxScoreDiv').show();
                    $('#questionItemsDiv').hide();
                    $('#updateModalEssay').show();
                    break;
                default:
                    alert("Not found");
                }
        });
    });

    // script for deleting task - deleteTableTaskBtn
    $(document).ready(function (){
        $(document).on('click', '.deleteTableTaskBtn', function(){
            var moduleGGTaskId = $(this).closest('div').find('#taskId_DeleteEdit').text();
            
            // Opening the Modal
            $('#deleteModalTask').modal('show');
            // Displaying data to fields
            $('.deleteTaskId').val(moduleGGTaskId);
            
        });
    });

</script>

<!-- Grading -->
<script type="text/javascript">
    $(document).ready(function (){
        $(document).on('click', '#btnFirstGrading', function(){
            var id = 1;

            $('#moduleSectionGradingId').val(id);
        });
        $(document).on('click', '#btnSecondGrading', function(){
            var id = 2;

            $('#moduleSectionGradingId').val(id);
        });
        $(document).on('click', '#btnThirdGrading', function(){
            var id = 3;

            $('#moduleSectionGradingId').val(id);
        });
        $(document).on('click', '#btnFourthGrading', function(){
            var id = 4;

            $('#moduleSectionGradingId').val(id);
        });
    });
</script>

</body>

</html>