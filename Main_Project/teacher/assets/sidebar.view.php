<!-- upload module -->
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
                        <label>Select Subject</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Select Subject...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Select Section</label>
                        <div class="d-flex">
                            <select class="form-select" id="moduleSection" name="moduleSection">
                                <option selected="" disabled="">Select module section</option>
                            </select>
                            <button class="btn btn-primary ms-4 col-3" data-bs-toggle="modal"
                                data-bs-target="#createModuleSection" id="btnFirstGrading" type="button">Add</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Module Name</label>
                        <input type="text" name="file_name" class="form-control" placeholder="Subject Name" required>
                    </div>
                    <div class="form-group">
                        <label>Upload Files</label>
                        <input type="file" name="file_upload" id="fileInput" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="btnUpload" class="btn btn-primary">Upload File</button>
                </div>
            </form>

        </div>
    </div>
</div>
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
            <li class="nav-item sub-list"><a href="" class="nav-link sub-title">OLMS - Teacher</a></li>

            <li class="nav-item"><a href="teacher.php" class="nav-link">
                    <i class="fa-solid fa-house-chimney side-logo"></i>
                    <span class="link_name">Dashboard</span></a>
            </li>
            <li class="nav-item"><a href="teacher.php#mainPageSubject" class="nav-link">
                    <i class="fa-solid fa-book side-logo"></i>
                    <span class="link_name">Subjects</span></a>
            </li>
            <li class="nav-item"><a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#uploadModal">
                    <i class="fa-solid fa-file-upload side-logo"></i>
                    <span class="link_name">Upload File</span></a>
            </li>
            <li class="nav-item" onclick="showGradingTab()"><a href="#" class="nav-link">
                    <i class="fa-solid fa-table-list side-logo"></i>
                    <span class="link_name">Grade Book</span></a>
            </li>
            <!-- change me -->
        </ul>
    </div>
</div>