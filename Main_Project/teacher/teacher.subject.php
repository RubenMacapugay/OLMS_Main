<?php 
include('assets/header.view.php');

// if(isset($_SESSION['subjectId'])){
//     echo 'Section: '.$_SESSION['section_id'];
// }else{
//     echo "failed";
// }
?>

<?php 
$subjectId = $_SESSION['subjectId'];
$teacherId = $_SESSION['teacher_id'];


// get subject
$currentSubjectData = teacherSubjectExist($conn, $subjectId, $teacherId);


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


//display the subject name
$selectSubjectName = "SELECT *, subject_list_tbl.subject_list_name FROM ((student_tbl INNER JOIN subject_list_tbl ON student_tbl.student_id = subject_list_tbl.fk_student_id ))WHERE  subject_list_tbl.fk_section_id = 1 AND subject_list_tbl.fk_teacher_id = 1 AND subject_list_tbl.fk_subject_id = 1";

//display Task List
$resultTaskList =  getTasks($conn, $subjectId, $teacherId);
$resultTaskList2 =  getTasks($conn, $subjectId, $teacherId);
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

<!-- edit task -->
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
                <h1 class="modal-title fs-5" id="updateModuleSection">Update Section content</h1>
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
<div class="modal fade" id="updateTask" tabindex="-1" aria-labelledby="updateTask" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="updateModuleSection">Update Task</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="container-fluid">
                <form action="../../includes/teacher.createtask.inc.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="updateModuleSectionGradingId" id="updateModuleSectionGradingId" class="form-control updateModuleSectionGradingId" placeholder="Module Section name" required>
                        <input type="hidden" name="updateModuleSectionId" id="updateModuleSectionId" class="form-control updateModuleSectionId" placeholder="Module Section name" required>
                        <div class="form-group">
                            <label>Task name</label>
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
</div>
<!-- End of Modal -->

<!--Body content --> 
<div class="container-fluid " id="content">
    <div class="row overflow-hidden"> 
        
        <!-- Left Side Nav global-->
        <div class="col-md-2 " id="sideNav">
            <button class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#updateTask">Click me</button>
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
                            unset($_SESSION['msg']);
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
                                <div class="active tab-content p-2">
                                    <div class="card">
                                        <div class="card-header">
                                            <h2><?php echo $currentSubjectData['subject_list_name']?></h2>
                                            <p>Section</p>
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
                                        <div class="card-header ">

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

                                                                    <?php while($rowGrading = $resultTasksFirstGrading->fetch_assoc()): ?>
                                                                        <tr class="module-task ">
                                                                            <td><a href="#"><?php echo $rowGrading['task_name'];?></a></td>
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
                                <div class="tab-content">
                                    <div class="container-fluid">
                                        <div class="row">
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

                                            <div class="col-4 d-flex">
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
                                            </div>
                                        </div>
                                    </div>

                                    <table class="table table-hover ms-1 ">
                                        <thead>
                                            <tr>
                                                <th scope="col">Task List</th>
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
                                                <tr>
                                                    <td><a href=""><?php echo $row['task_name']?></a></td>
                                                    <td>
                                                        <i class="fa-regular fa-pen-to-square text-primary  me-2"
                                                            type="button"></i>
                                                        <i class="fa-solid fa-trash text-danger me-2"
                                                            type="button"></i>
                                                    </td>
                                                    <td><?php echo $row['date_created']?></td>
                                                    <td><?php echo $row['date_deadline']?></td>
                                                    <td>
                                                        <form method='POST' action='../../includes/teacher.createtask.inc.php'>
                                                            <input type="hidden" type="hidden" name="taskId" value="<?php echo $row['task_list_id'];?>"> 
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

                                <!-- Students List -->
                                <div class="tab-content " id="StudentList">
                                    <!-- Sort -->
                                    <div class="container-fluid d-flex justify-content-between align-items-center py-2">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <h4 class="mb-0">Section</h4>
                                            <p class="text-muted ms-2 mb-0">Aralin Panlipunan</p>
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
                                    <div class="student-table ms-1">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="">Task List</th>
                                                    <th scope="col" class="text-center">Progress</th>
                                                    <th scope="col" class="text-center">Task Completed</th>
                                                    <th scope="col" class="text-center">Enrolled</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- resultStudentsSubjectSection -->
                                                <tr>
                                                    <td>
                                                        <a href="student_subject.progress.php">Student 1</a>
                                                    </td>
                                                    <td scope="col" class="text-center"></td>
                                                    <td scope="col" class="text-center">87.0</td>
                                                    <td scope="col" class="text-center">Aug 20 2022</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="student_subject.progress.php">Student 2</a>
                                                    </td>
                                                    <td scope="col" class="text-center"></td>
                                                    <td scope="col" class="text-center">80.0</td>
                                                    <td scope="col" class="text-center">Aug 13 2022</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="student_subject.progress.php">Student 3</a>
                                                    </td>
                                                    <td scope="col" class="text-center"></td>
                                                    <td scope="col" class="text-center">89.0</td>
                                                    <td scope="col" class="text-center">Aug 25 2022</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="student_subject.progress.php">Student 4</a>
                                                    </td>
                                                    <td scope="col" class="text-center"></td>
                                                    <td scope="col" class="text-center">90.0</td>
                                                    <td scope="col" class="text-center">Sept 01 2022</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="student_subject.progress.php">Student 5</a>
                                                    </td>
                                                    <td scope="col" class="text-center"></td>
                                                    <td scope="col" class="text-center">84.0</td>
                                                    <td scope="col" class="text-center">Aug 23 2022</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                </div>

                                <!-- Subject Students Grades-->
                                <div class="tab-content " id="subjectStudentList">
                                    <!-- Sort -->
                                    <div class="container-fluid d-flex justify-content-between align-items-center py-2">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <h4 class="mb-0">Section</h4>
                                            <p class="text-muted ms-2 mb-0">Aralin Panlipunan</p>
                                        </div>
                                        <select class="form-select w-25" aria-label="Default select example">
                                            <option selected>All</option>
                                            <option value="1">Assignment</option>
                                            <option value="2">Activity</option>
                                            <option value="3">Project</option>
                                            <option value="4">Quiz</option>
                                            <option value="5">Exam</option>
                                        </select>
                                    </div>
                                    <div class="student-table ms-1">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="">Task List</th>

                                                    <!-- Display Task List -->
                                                    <?php while ($rowTaskList = $resultTaskList->fetch_assoc()) : ?>
                                                        <th scope="col" class="text-center"><?php echo $rowTaskList['task_name']; ?></th>
                                                    <?php endwhile; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- resultStudentsSubjectSection -->
                                                <?php while ($rowResult = $resultStudentsSubjectSection->fetch_assoc()) : ?>

                                                    <tr>
                                                        <td><a href="student_subject.progress.php"><?php echo $rowResult['student_name'] ?></a></td>
                                                        
                                                        <?php while ($rowTaskList2 = $resultTaskList2->fetch_assoc()) : ?>
                                                            
                                                            <td scope="col" class="text-center">test</td>
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

        <!-- Right Banner -->
        <div class="custom-border col-md-2 mt-4" id="rightBanner">
            <?php include('assets/banner.view.php')?>
        </div>

    </div>
</div>

<!-- Script Links Bootstrap/Jquery -->
<?php include('assets/scriptlink.view.php')?>

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
</script>

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