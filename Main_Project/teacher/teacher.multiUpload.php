<?php include('assets../header.view.php') ?>

<!-- Testing query -->
<?php
$teacherId = $_SESSION["teacher_id"];

//Getting results from subject_tbl
// $selectTeacherSubject = "SELECT * FROM subject_list_tbl where fk_teacher_id = $subjectId";
$selectTeacherSubject = "SELECT * FROM ((((subject_list_tbl INNER JOIN section_tbl ON subject_list_tbl.fk_section_id = section_tbl.section_id) INNER JOIN gradelevel_tbl ON gradelevel_tbl.grade_level_id = section_tbl.fk_grade_level_id)INNER JOIN teacher_tbl ON teacher_tbl.teacher_id = subject_list_tbl.fk_teacher_id) INNER JOIN subject_tbl ON subject_tbl.subject_id = subject_list_tbl.fk_subject_id) WHERE subject_list_tbl.fk_teacher_id = $teacherId";
$resultSubject =  $conn->query($selectTeacherSubject) or die($mysqli->error);

?>


<!--Body content -->
<div class="container-fluid " id="content">

    <div class="row overflow-hidden">

        <!-- Left Side Nav -->
        <div class="col-md-2" id="sideNav">
            <?php include('assets../sidebar.view.php') ?>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 py-4 main-content" id="mainContent">
            <div class="container-fluid ">
                <div class="custom-border mt-4">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <div class="modal-body col-6">
                            <div class="form-group">
                                <label>Subject</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Select Subject...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Section</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Select Subject...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
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
    </div>
</div>




<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
</script>

<!-- J-query -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Javascrpit Files -->
<script src="js/main.js"></script>


<script>
    let totalModule = 10;
    let speed = 10;

    // List of progress bar --
    var progressList = document.querySelectorAll('.circular-progress');

    // Calculate the subject progress --
    let subjectProgressEndValue = progressEndValue(6, totalModule);

    // Loop through each progress bar
    for (i = 0; i < progressList.length; i++) {
        progressList[i];
        progressDisplay(progressList[i], subjectProgressEndValue);
    }

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
</body>

</html>