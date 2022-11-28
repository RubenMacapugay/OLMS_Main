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
//echo $currentSubjectData['subject_list_name'];

// getTask count per grading;
$firstGradingTask = checkTaskCountPerGrading($conn, $subjectId, 1);
$secondGradingTask = checkTaskCountPerGrading($conn, $subjectId, 2);
$thirdGradingTask = checkTaskCountPerGrading($conn, $subjectId, 3);
$fourthGradingTask = checkTaskCountPerGrading($conn, $subjectId, 4);

# display the module section in first grading
$selectModuleSectionFirstGrading = "SELECT * FROM module_section_tbl WHERE (fk_grading_id = 1 AND fk_subject_list_id = $subjectId)";
$resultModuleSectionFirstGrading =  $conn->query($selectModuleSectionFirstGrading) or die($mysqli->error);


$selectModuleSectionSecondGrading = "SELECT * FROM module_section_tbl WHERE (fk_grading_id = 2 AND fk_subject_list_id = $subjectId)";
$resultModuleSectionSecondGrading =  $conn->query($selectModuleSectionSecondGrading) or die($mysqli->error);

$selectModuleSectionThirdGrading = "SELECT * FROM module_section_tbl WHERE (fk_grading_id = 3 AND fk_subject_list_id = $subjectId)";
$resultModuleSectionThirdGrading =  $conn->query($selectModuleSectionThirdGrading) or die($mysqli->error);

$selectModuleSectionFourthGrading = "SELECT * FROM module_section_tbl WHERE (fk_grading_id = 4 AND fk_subject_list_id = $subjectId)";
$resultModuleSectionFourthGrading =  $conn->query($selectModuleSectionFourthGrading) or die($mysqli->error);



# First Grading 
$selectTeacherTasksFirstGrading = "SELECT * FROM task_list_tbl WHERE (fk_grading_id = 1 AND fk_subject_list_id = $subjectId)";
$resultTasksFirstGrading =  $conn->query($selectTeacherTasksFirstGrading) or die($mysqli->error);

$selectTeacherTasksSecondGrading = "SELECT * FROM task_list_tbl WHERE (fk_grading_id = 2 AND fk_subject_list_id = $subjectId)";
$resultTasksSecondGrading =  $conn->query($selectTeacherTasksSecondGrading) or die($mysqli->error);

$selectTeacherTasksThirdGrading = "SELECT * FROM task_list_tbl WHERE (fk_grading_id = 3 AND fk_subject_list_id = $subjectId)";
$resultTasksThirdGrading =  $conn->query($selectTeacherTasksThirdGrading) or die($mysqli->error);

$selectTeacherTasksFourthGrading = "SELECT * FROM task_list_tbl WHERE (fk_grading_id = 4 AND fk_subject_list_id = $subjectId)";
$resultTasksFourthGrading =  $conn->query($selectTeacherTasksFourthGrading) or die($mysqli->error);

// Display all subject's students by section
$selectStudentsSubjectSection = "SELECT student_tbl.student_name FROM student_tbl INNER JOIN subject_list_tbl ON student_tbl.student_id = subject_list_tbl.fk_student_id WHERE subject_list_tbl.subject_list_id = $subjectId AND subject_list_tbl.fk_section_id = 1";
$resultStudentsSubjectSection =  $conn->query($selectStudentsSubjectSection) or die($mysqli->error);

//display the subject name
$selectSubjectName = "SELECT *, subject_list_tbl.subject_list_name FROM ((student_tbl INNER JOIN subject_list_tbl ON student_tbl.student_id = subject_list_tbl.fk_student_id ))WHERE  subject_list_tbl.fk_section_id = 1 AND subject_list_tbl.fk_teacher_id = 1 AND subject_list_tbl.fk_subject_id = 1";

//display Task List
$selectTaskListStudentsSection = "SELECT task_list_tbl.task_name, subject_list_tbl.fk_teacher_id FROM ((subject_list_tbl INNER JOIN task_list_tbl ON subject_list_tbl.subject_list_id = task_list_tbl.fk_subject_list_id)) WHERE subject_list_id = $subjectId";
$resultTaskList =  $conn->query($selectTaskListStudentsSection) or die($mysqli->error);

$resultTaskList2 =  $conn->query($selectTaskListStudentsSection) or die($mysqli->error);

?>

<!-- Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="uploadModalLabel">Upload Files</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="teacher.code.php" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    <div class="form-group">
                        <label>Module Name</label>
                        <input type="text" name="file_name" class="form-control" placeholder="Subject Name" required>
                    </div>
                    <div class="form-group">
                        <label>Chapter</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Select Chapter</option>
                            <option value="1">Chapter 1</option>
                            <option value="2">Chapter 2</option>
                            <option value="3">Chapter 3</option>
                            <option value="3">Chapter 4</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Upload Files</label>
                        <input type="file" name="file_upload" id="fileInput" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="btnUpload" class="btn btn-primary">Upload</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="createModuleSection" tabindex="-1" aria-labelledby="createModuleSection" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createModuleSection">Create Module Section</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../../includes/teacher.createtask.inc.php" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
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
                    <button type="submit" name="createModuleSection" class="btn btn-primary">Create</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- End of Modal -->

<!--Body content -->
<div class="container-fluid " id="content">

    <div class="row overflow-hidden">

        <!-- Left Side Nav global-->
        <div class="col-md-2 " id="sideNav">
            <?php include('assets/sidebar.view.php') ?>
        </div>

        <!-- Main Content -->
        <div class="col-md-8 py-4 main-content" id="teacherSubjectContent">
            <div class="row mx-0">

                <div class="container-fluid">
                    <!-- <button class="dangerBtn" onclick="showTab()">Danger</button> -->

                    <!-- validation message -->
                    <?php
                    if (isset($_SESSION["taskGiven"])) {
                        if ($_SESSION["taskGiven"] == "taskGiven") {
                            if ($_SESSION['taskGivenStatus'] == "Yes") {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        Task is now visible!
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>';
                            } else if ($_SESSION['taskGivenStatus'] == "No") {
                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        Task is now not visible!
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>';
                            }

                            if ($_GET['tab'] == "moduleTab") {
                                echo "<script> window.onload = function() {
                                        showGradingTab();
                                    }; </script>";
                            } else if ($_GET['tab'] == "taskTab") {
                                echo "<script> window.onload = function() {
                                        showTaskTab();
                                    }; </script>";
                            }


                            unset($_SESSION["taskGiven"]);
                        }
                    }

                    if (isset($_SESSION['moduleSectionCreated'])) {
                        if ($_SESSION['moduleSectionCreated'] == 'yes') {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            Module Section has been created!
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
                                unset($_SESSION['moduleSectionCreated']);
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
                                <div class="active tab-content p-2">
                                    <div class="card">
                                        <div class="card-header">
                                            <h2><?php echo $currentSubjectData['subject_list_name'] ?></h2>
                                            <p>Section</p>
                                            <p>Subject Description</p>
                                            <p>description Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                                                Atque
                                                ipsum
                                                reprehenderit voluptas sed et sint.</p>
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
                                                        <a class="nav-link content-collapse" type=""><?php echo $firstGradingTask; ?> Content <i class="fa-solid fa-chevron-down"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- First Grading Content -->
                                        <div class="card-body section-table-content custom-hide">

                                            <!-- Module Section resultModuleSectionFirstGrading -->
                                            <?php while ($rowModuleTask = $resultModuleSectionFirstGrading->fetch_assoc()) : ?>
                                                <div class="card mb-2">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <h4 class="module-section-title"><?php echo $rowModuleTask['module_section_name']; ?></h4>
                                                            <a class="nav-link text-primary content-collapse" type=""> Hide <i
                                                                    class="fa-solid fa-chevron-down"></i></a>
>>>>>>> bf987634406599274e6b4eb963cb9f68bd7edb72
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
                                                                        <i class="fa-regular fa-pen-to-square text-primary  me-2" type="button"></i>
                                                                        <i class="fa-solid fa-trash text-danger me-2" type="button"></i>
                                                                    </td>
                                                                    <td class="">-</td>
                                                                    <td class="">-</td>
                                                                    <td class="">
                                                                        <input class="btn btn-success fs-6 py-0" type="submit" value="give">
                                                                    </td>
                                                                </tr>

<<<<<<< HEAD
                                                                <!-- Displaying Task Per Module_section_tbl -->

                                                                <?php while ($rowGrading = $resultTasksFirstGrading->fetch_assoc()) : ?>
                                                                    <tr class="module-task ">
                                                                        <td><a href="#"><?php echo $rowGrading['task_name']; ?></a></td>
                                                                        <td>
                                                                            <i class="fa-regular fa-pen-to-square text-primary  me-2" type="button"></i>
                                                                            <i class="fa-solid fa-trash text-danger me-2" type="button"></i>
                                                                        </td>
                                                                        <td class="">-</td>
                                                                        <td class="">-</td>
                                                                        <td class="">
                                                                            <form method='POST' action='../../includes/teacher.createtask.inc.php'>
                                                                                <input type="hidden" type="hidden" name="taskId" value="<?php echo $rowGrading['task_list_id']; ?>">

                                                                                <?php
                                                                                $isGiven = $rowGrading['given'];
                                                                                if ($isGiven == "Yes") {
                                                                                    echo '<input type="hidden" type="hidden" name="isGiven" value="No">';
                                                                                    echo '<input class="btn btn-danger fs-6 py-0" type="submit" name="updateTaskGive" value="ungive">';
                                                                                } else if ($isGiven == "" || $isGiven == "No") {
                                                                                    echo '<input type="hidden" type="hidden" name="isGiven" value="Yes">';
                                                                                    echo '<input class="btn btn-success fs-6 py-0" type="submit" name="updateTaskGive" value="give">';
                                                                                }
                                                                                ?>
                                                                            </form>
                                                                        </td>

                                                                    </tr>
                                                                <?php endwhile; ?>
=======
                                                                    <?php while($rowGrading = $resultTasksFirstGrading->fetch_assoc()): ?>
                                                                        <tr class="module-task ">
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
>>>>>>> bf987634406599274e6b4eb963cb9f68bd7edb72

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
                                                        <a class="nav-link content-collapse" type=""><?php echo $secondGradingTask; ?> Content <i class="fa-solid fa-chevron-down"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Second Grading Content -->
                                        <div class="card-body section-table-content custom-hide">
                                            
                                            <!-- Module Section resultModuleSectionFirstGrading -->
                                            <?php while($rowModuleTask = $resultModuleSectionSecondGrading->fetch_assoc()): ?>
                                                <div class="card mb-2">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <h4 class="module-section-title"><?php echo $rowModuleTask['module_section_name']; ?></h4>
                                                            <a class="nav-link text-primary content-collapse" type=""> Hide <i
                                                                    class="fa-solid fa-chevron-down"></i></a>
>>>>>>> bf987634406599274e6b4eb963cb9f68bd7edb72
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
                                                                        <i class="fa-regular fa-pen-to-square text-primary  me-2" type="button"></i>
                                                                        <i class="fa-solid fa-trash text-danger me-2" type="button"></i>
                                                                    </td>
                                                                    <td class="">-</td>
                                                                    <td class="">-</td>
                                                                    <td class="">
                                                                        <input class="btn btn-success fs-6 py-0" type="submit" value="give">
                                                                    </td>
                                                                </tr>

                                                                <!-- Displaying Task Per Module_section_tbl -->
                                                                <?php while ($rowGrading = $resultTasksSecondGrading->fetch_assoc()) : ?>
                                                                    <tr class="module-task">
                                                                        <td><a href="#"><?php echo $rowGrading['task_name']; ?></a></td>
                                                                        <td>
                                                                            <i class="fa-regular fa-pen-to-square text-primary  me-2" type="button"></i>
                                                                            <i class="fa-solid fa-trash text-danger me-2" type="button"></i>
                                                                        </td>
                                                                        <td class="">-</td>
                                                                        <td class="">-</td>
                                                                        <td class="">
                                                                            <form method='POST' action='../../includes/teacher.createtask.inc.php'>
                                                                                <input type="hidden" type="hidden" name="taskId" value="<?php echo $rowGrading['task_list_id']; ?>">

                                                                                <?php
                                                                                $isGiven = $rowGrading['given'];
                                                                                if ($isGiven == "Yes") {
                                                                                    echo '<input type="hidden" type="hidden" name="isGiven" value="No">';
                                                                                    echo '<input class="btn btn-danger fs-6 py-0" type="submit" name="updateTaskGive" value="ungive">';
                                                                                } else if ($isGiven == "" || $isGiven == "No") {
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
                                            <h4 class="section-title">Third Grading</h4>
                                            <br>
                                            <div>
                                                <ul class="nav justify-content-between align-items-center">
                                                    <li class="nav-item"><?php echo $thirdGradingTask; ?> task</li>
                                                    <li class="nav-item d-flex align-items-center">
                                                        <i class="fa-solid fa-circle-plus" data-bs-toggle="modal" data-bs-target="#uploadModal"></i>
                                                        <a class="nav-link content-collapse" type=""><?php echo $thirdGradingTask; ?> Content <i class="fa-solid fa-chevron-down"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Third Grading Content -->
                                        <div class="card-body section-table-content custom-hide">
                                            
                                            <!-- Module Section resultModuleSectionFirstGrading -->
                                            <?php while($rowModuleTask = $resultModuleSectionThirdGrading->fetch_assoc()): ?>
                                                <div class="card mb-2">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <h4 class="module-section-title"><?php echo $rowModuleTask['module_section_name']; ?></h4>
                                                            <a class="nav-link text-primary content-collapse" type=""> Hide <i
                                                                    class="fa-solid fa-chevron-down"></i></a>
>>>>>>> bf987634406599274e6b4eb963cb9f68bd7edb72
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
                                                                        <i class="fa-regular fa-pen-to-square text-primary  me-2" type="button"></i>
                                                                        <i class="fa-solid fa-trash text-danger me-2" type="button"></i>
                                                                    </td>
                                                                    <td class="">-</td>
                                                                    <td class="">-</td>
                                                                    <td class="">
                                                                        <input class="btn btn-success fs-6 py-0" type="submit" value="give">
                                                                    </td>
                                                                </tr>

                                                                <!-- Displaying Task Per Module_section_tbl -->
                                                                <?php while ($rowGrading = $resultTasksThirdGrading->fetch_assoc()) : ?>
                                                                    <tr class="module-task">
                                                                        <td><a href="#"><?php echo $rowGrading['task_name']; ?></a></td>
                                                                        <td>
                                                                            <i class="fa-regular fa-pen-to-square text-primary  me-2" type="button"></i>
                                                                            <i class="fa-solid fa-trash text-danger me-2" type="button"></i>
                                                                        </td>
                                                                        <td class="">-</td>
                                                                        <td class="">-</td>
                                                                        <td class="">
                                                                            <form method='POST' action='../../includes/teacher.createtask.inc.php'>
                                                                                <input type="hidden" type="hidden" name="taskId" value="<?php echo $rowGrading['task_list_id']; ?>">

                                                                                <?php
                                                                                $isGiven = $rowGrading['given'];
                                                                                if ($isGiven == "Yes") {
                                                                                    echo '<input type="hidden" type="hidden" name="isGiven" value="No">';
                                                                                    echo '<input class="btn btn-danger fs-6 py-0" type="submit" name="updateTaskGive" value="ungive">';
                                                                                } else if ($isGiven == "" || $isGiven == "No") {
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
                                            <h4 class="section-title">Forth Grading</h4>
                                            <br>
                                            <div>
                                                <ul class="nav justify-content-between align-items-center">
                                                    <li class="nav-item"><?php echo $fourthGradingTask; ?> task</li>
                                                    <li class="nav-item d-flex align-items-center">
                                                        <i class="fa-solid fa-circle-plus" data-bs-toggle="modal" data-bs-target="#uploadModal"></i>
                                                        <a class="nav-link content-collapse" type=""><?php echo $fourthGradingTask; ?> Content <i class="fa-solid fa-chevron-down"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Fourth Grading Content -->
                                        <div class="card-body section-table-content custom-hide">
                                                                
                                            <!-- Module Section resultModuleSectionFirstGrading -->
                                            <?php while($rowModuleTask = $resultModuleSectionFourthGrading->fetch_assoc()): ?>
                                                <div class="card mb-2">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <h4 class="module-section-title"><?php echo $rowModuleTask['module_section_name']; ?></h4>
                                                            <a class="nav-link text-primary content-collapse" type=""> Hide <i
                                                                    class="fa-solid fa-chevron-down"></i></a>
>>>>>>> bf987634406599274e6b4eb963cb9f68bd7edb72
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
                                                                        <i class="fa-regular fa-pen-to-square text-primary  me-2" type="button"></i>
                                                                        <i class="fa-solid fa-trash text-danger me-2" type="button"></i>
                                                                    </td>
                                                                    <td class="">-</td>
                                                                    <td class="">-</td>
                                                                    <td class="">
                                                                        <input class="btn btn-success fs-6 py-0" type="submit" value="give">
                                                                    </td>
                                                                </tr>

                                                                <!-- Displaying Task Per Module_section_tbl -->
                                                                <?php while ($rowGrading = $resultTasksFourthGrading->fetch_assoc()) : ?>
                                                                    <tr class="module-task">
                                                                        <td><a href="#"><?php echo $rowGrading['task_name']; ?></a></td>
                                                                        <td>
                                                                            <i class="fa-regular fa-pen-to-square text-primary  me-2" type="button"></i>
                                                                            <i class="fa-solid fa-trash text-danger me-2" type="button"></i>
                                                                        </td>
                                                                        <td class="">-</td>
                                                                        <td class="">-</td>
                                                                        <td class="">
                                                                            <form method='POST' action='../../includes/teacher.createtask.inc.php'>
                                                                                <input type="hidden" type="hidden" name="taskId" value="<?php echo $rowGrading['task_list_id']; ?>">

                                                                                <?php
                                                                                $isGiven = $rowGrading['given'];
                                                                                if ($isGiven == "Yes") {
                                                                                    echo '<input type="hidden" type="hidden" name="isGiven" value="No">';
                                                                                    echo '<input class="btn btn-danger fs-6 py-0" type="submit" name="updateTaskGive" value="ungive">';
                                                                                } else if ($isGiven == "" || $isGiven == "No") {
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
                                <div class="tab-content p-3">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-8 d-flex justify-content-start align-items-center">
                                                <div class="dropdown">
                                                    <!-- Send subject id on url -->
                                                    <?php $currentSubject = $_SESSION['subjectId']; ?>
                                                    <a class="btn btn-primary" type="button" href="teacher.createtask.php?currentSubject=<?php echo $currentSubject; ?>">
                                                        Create Task <i class="fa-solid fa-circle-plus ms-1"></i>
                                                    </a>
                                                </div>

                                            </div>

                                            <div class="col-4 d-flex">
                                                <div class="module-actions d-flex justify-content-end align-items-center p-2">

                                                    <select class="form-select w-100" aria-label="Default select example">
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
                                                <th scope="col" class="text-center">Duration</th>
                                                <th scope="col" class="text-center">Status</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //Getting results from subject_tbl
                                            $subjectId = $_SESSION['subjectId'];
                                            $selectTaskList = "SELECT * FROM task_list_tbl WHERE fk_subject_list_id= $subjectId";
                                            $resultList =  $conn->query($selectTaskList) or die($mysqli->error);
                                            ?>
                                            <?php while ($row = $resultList->fetch_assoc()) : ?>
                                                <tr>
                                                    <td><a href=""><?php echo $row['task_name'] ?></a></td>
                                                    <td>
                                                        <i class="fa-regular fa-pen-to-square text-primary  me-2" type="button"></i>
                                                        <i class="fa-solid fa-trash text-danger me-2" type="button"></i>
                                                    </td>
                                                    <td><?php echo $row['date_created'] ?> - <?php echo $row['date_deadline'] ?></td>
                                                    <td>
                                                        <form method='POST' action='../../includes/teacher.createtask.inc.php'>
                                                            <input type="hidden" type="hidden" name="taskId" value="<?php echo $row['task_list_id']; ?>">
                                                            <?php
                                                            $isGivenTask = $row['given'];
                                                            if ($isGivenTask == "Yes") {
                                                                echo '<input type="hidden" type="hidden" name="isGivenTaskTab" value="No">';
                                                                echo '<input class="btn btn-danger fs-6 py-0" type="submit" name="updateTaskGiveTaskTab" value="ungive">';
                                                            } else if ($isGivenTask == "" || $isGivenTask == "No") {
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

                                <!-- Subject Students -->
                                <div class="tab-content p-3" id="subjectStudentList">
                                    <!-- Sort -->
                                    <div class="container-fluid d-flex justify-content-between align-items-center py-2">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <h3 class="mb-0">Section</h3>
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
                                                    <th scope="col" class="">Name</th>
                                                    <th scope="col" class="">Progress</th>
                                                    <th scope="col" class="">Grade</th>
                                                    <th scope="col" class="">Enrolled</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td scope="col">
                                                        <a href="student_subject.progress.php">
                                                            Student 1
                                                        </a>
                                                        <br>Student ID : 001
                                                    </td>
                                                    <td scope="col" class=""></td>
                                                    <td scope="col" class="">80</td>
                                                    <td scope="col" class="">Aug 2022</td>
                                                </tr>
                                                <tr>
                                                    <td scope="col">
                                                        <a href="student_subject.progress.php">Student 2</a>
                                                        <br>Student ID : 002
                                                    </td>
                                                    <td scope="col" class=""></td>
                                                    <td scope="col" class="">85</td>
                                                    <td scope="col" class="">Aug 2022</td>
                                                </tr>
                                                <tr>
                                                    <td scope="col">
                                                        <a href="student_subject.progress.php">Student 3</a>
                                                        <br>Student ID : 003
                                                    </td>
                                                    <td scope="col" class=""></td>
                                                    <td scope="col" class="">82</td>
                                                    <td scope="col" class="">Aug 2022</td>
                                                </tr>
                                                <tr>
                                                    <td scope="col">
                                                        <a href="student_subject.progress.php">Student 4</a>
                                                        <br>Student ID : 004
                                                    </td>
                                                    <td scope="col" class=""></td>
                                                    <td scope="col" class="">87</td>
                                                    <td scope="col" class="">Sept 2022</td>
                                                </tr>
                                                <tr>
                                                    <td scope="col">
                                                        <a href="student_subject.progress.php">Student 5</a>
                                                        <br>Student ID : 005
                                                    </td>
                                                    <td scope="col" class=""></td>
                                                    <td scope="col" class="">90</td>
                                                    <td scope="col" class="">Aug 2022</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                </div>

                                <!-- Subject Student Grades -->
                                <div class="tab-content p-3" id="subjectStudentGradeList">
                                    <!-- Sort -->
                                    <div class="container-fluid d-flex justify-content-between align-items-center py-2">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <h3 class="mb-0">Section</h3>
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

                                                            <td scope="col" class="text-center"></td>
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
            <?php include('assets/banner.view.php') ?>
        </div>

    </div>
</div>

<!-- Script Links Bootstrap/Jquery -->
<?php include('assets/scriptlink.view.php') ?>

<script>
    //Tabpane
    let tabHeader = document.getElementsByClassName("tab-header")[0];
    let tabIndicator = document.getElementsByClassName("tab-indicator")[0];
    let tabBody = document.getElementsByClassName("tab-body")[0];

    let tabsPane = tabHeader.getElementsByTagName("div");

    let danger = document.getElementsByClassName("dangerBtn");

    for (let i = 0; i < tabsPane.length; i++) {
        tabsPane[i].addEventListener("click", function() {
            tabHeader.getElementsByClassName("active")[0].classList.remove("active");
            tabsPane[i].classList.add("active");
            tabBody.getElementsByClassName("active")[0].classList.remove("active");
            tabBody.getElementsByClassName("tab-content")[i].classList.add("active");

            tabIndicator.style.left = `calc(calc(100% / 4) * ${i})`;
        });


    }

    //Tester
    function showGradingTab() {
        tabHeader.getElementsByClassName("active")[0].classList.remove("active");
        tabsPane[0].classList.add("active");
        tabBody.getElementsByClassName("active")[0].classList.remove("active");
        tabBody.getElementsByClassName("tab-content")[0].classList.add("active");

        tabIndicator.style.left = `calc(calc(100% / 4) * ${0})`;
    }

    function showTaskTab() {
        tabHeader.getElementsByClassName("active")[0].classList.remove("active");
        tabsPane[1].classList.add("active");
        tabBody.getElementsByClassName("active")[0].classList.remove("active");
        tabBody.getElementsByClassName("tab-content")[1].classList.add("active");

        tabIndicator.style.left = `calc(calc(100% / 4) * ${1})`;
    }


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

    // set session for Grading buttons
    $('#btnFirstGrading').on('click', function(e){
        var name = 1;
        $.ajax({
            type: 'POST',
            url: 'teacher.setSessionSubject.php',
            data: {
                service: name
            }
        }); 
    });

    $('#btnSecondGrading').on('click', function(e){
        var name = 2;
        $.ajax({
            type: 'POST',
            url: 'teacher.setSessionSubject.php',
            data: {
                service: name
            }
        }); 
    });
</script>

    $('#btnThirdGrading').on('click', function(e){
        var name = 3;
        $.ajax({
            type: 'POST',
            url: 'teacher.setSessionSubject.php',
            data: {
                service: name
            }
        }); 
    });

    $('#btnFourthGrading').on('click', function(e){
        var name = 4;
        $.ajax({
            type: 'POST',
            url: 'teacher.setSessionSubject.php',
            data: {
                service: name
            }
        }); 
    });
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
>>>>>>> bf987634406599274e6b4eb963cb9f68bd7edb72
        });
    });
</script>

</body>

</html>