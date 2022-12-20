 <!-- Side nav Collapse -->
 <?php

// set gradingRow variable
// require '../../includes/teacherDropdown.inc.php';
// $gradings = loadModuleSection();

?>
<!-- End Modal -->

<!-- Add Section Modal -->
<div class="modal" id="createModuleSection" tabindex="-1" aria-labelledby="createModuleSection" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createModuleSection">Create Module Section</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../../includes/teacher.createtask.inc.php" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    <?php
                //create a validation message here
                ?>
                    <div class="form-group">
                        <label>Grading</label>
                        <select class="form-control" id="modalGrading" name="gradingModal">
                            <option selected="" disabled="">Select grading</option>
                            <?php
                        // foreach ($gradings as $grading) {
                        //     echo "<option id='" . $grading['grading_id'] . "' value='" . $grading['grading_id'] . "'>" . $grading['grading_name'] . "</option>";
                        // }

                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Section name</label>
                        <input type="text" name="moduleSectionName" class="form-control"
                            placeholder="Module Section name" required>
                    </div>
                    <div class="form-group">
                        <label>Section description</label>
                        <input type="text" name="moduleSectinDesc" class="form-control" placeholder="Description"
                            required>
                    </div>

                </div>

                <input type="hidden" grading>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="createModuleSectionWithGrading"
                        class="btn btn-primary">Create</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- End Add Section Modal -->

<!-- Side nav Collapse -->
<div class="container-ralative">

    <div class="navbar py-0" id="test-nav">
        <ul class="navbar-nav  w-100">
            <i class="fa-solid fa-grip side-button-logo" id="sidenavBtn"></i>
            <li class="nav-item sub-list fw-bold"><a href="#" class="nav-link sub-title">Teacher Page</a></li>

                         <li class="nav-item"><a href="teacher.php" class="nav-link">
                                         <i class="fa-solid fa-house-chimney side-logo"></i>
                                         <span class="link_name">Dashboard</span></a>
                         </li>
                         <li class="nav-item"><a href="teacher.php#mainPageSubject" class="nav-link">
                                         <i class="fa-solid fa-book side-logo"></i>
                                         <span class="link_name">Subjects</span></a>
                         </li>
                         <li class="nav-item"><a href="teacher.multiUpload.php" class="nav-link">
                                         <i class="fa-solid fa-file-upload side-logo"></i>
                                         <span class="link_name">Upload File</span></a>
                         </li>

                         <?php
                         if($_SERVER['REQUEST_URI'] == "/OLMS/OLMS_Main/OLMS_Main/Main_Project/teacher/teacher.php" ||
                            $_SERVER['REQUEST_URI'] == "/OLMS/OLMS_Main/OLMS_Main/Main_Project/teacher/teacher.php#mainPageSubject"){
                            ?> 
                            
                            <?php
                         }else{
                            ?> 
                            <li class="nav-item"><a href="teacher.subject.php?tab=gradeBook" class="nav-link">
                                         <i class="fa-solid fa-table-list side-logo"></i>
                                         <span class="link_name">Grade Book</span></a>
                         </li>
                            <?php
                         }
                         ?>
                         
                         <!-- change me -->
                 </ul>
         </div>
 </div>

