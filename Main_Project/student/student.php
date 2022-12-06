<?php include('assets../header.view.php') ?>

<?php 
    //Getting results from subject_tbl
    
    $studentId = $_SESSION['student_id'];
    
    // $selectStudentSubjects = "SELECT * FROM subject_list_tbl where fk_student_id = $studentId";
    $selectStudentSubjects = "SELECT * FROM ((((subject_list_tbl INNER JOIN section_tbl ON subject_list_tbl.fk_section_id = section_tbl.section_id)  INNER JOIN student_subjects_tbl ON student_subjects_tbl.fk_subject_list_id = subject_list_tbl.subject_list_id)INNER JOIN gradelevel_tbl ON gradelevel_tbl.grade_level_id = section_tbl.fk_grade_level_id)INNER JOIN teacher_tbl ON teacher_tbl.teacher_id = subject_list_tbl.fk_teacher_id) WHERE student_subjects_tbl.fk_student_id = $studentId";
    $resultSubject =  $conn->query($selectStudentSubjects) or die ($mysqli->error);
?>


<!--Body content -->
<div class="container-fluid " id="content">
    <div class="row overflow-hidden">

        <!-- Left Side Nav -->
        <div class="col-md-2 " id="sideNav">
            <?php include('assets../sidebar.view.php') ?>
        </div>

        <!-- Main Content -->
        <div class="col-md-8 py-4 main-content" id="mainContent">
            <div class="row mx-0">

                <!-- Announcement -->
                <div class="custom-border">
                    <div class="card mb-2">
                        <div class="card-header">
                            <h3>Announcement</h3>
                        </div>
                        <div class="card-body">
                            <p class="card-text text-header">Dear Charo,</p>
                            <p class="card-text text-body">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Illo
                                aperiam
                                distinctio eius quidem maiores, hic
                                tempore. Atque quaerat maiores quae at illo dolore in accusamus pariatur, mollitia
                                nisi
                                eos blanditiis
                                deleniti harum neque incidunt debitis doloribus temporibus earum nostrum deserunt
                                impedit reiciendis
                                distinctio. Quibusdam fugiat culpa nostrum unde, qui dolores?</p>

                            <div class="text-closing d-flex flex-column align-items-end">
                                <p class="card-text text-remarks mb-0">I'm yours,</p>
                                <p class="card-text text-author">Admin Addones</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Subjects List -->
            <div class="row mx-0 mt-3 subject-list" id="mainPageSubject">
                <div class="container-fluid custom-border">
                    <h3>Subjects</h3>
                    <div class="row ">

                        <!-- Subjects Display -->
                        <?php while($row = $resultSubject->fetch_assoc()): ?>
                        <div class="col-sm-6 col-md-6 col-lg-4 pt-2">
                            <div class="card">
                                <img src="images/img-2.jpg" class="card-img-top" alt="Subject Image">

                                <div class="card-body">

                                    <div class="progress-bar me-3">
                                        <div class="circular-progress">
                                            <div class="value-container"></div> 
                                        </div>
                                    </div>

                                    <h3 class="card-title"><?php echo $row['subject_list_name']; ?></h3>
                                    
                                    <p class="card-text"><?php echo $row['grade_level_name'].' - '.$row['section_name']; ?></p>
                                    <p class="card-text "><?php echo $row['teacher_name']; ?></p>
                                    <div class="text-center my-3">
                                        <!-- Send the subject id to specific subject page **student.subject.php -->
                                        <form action="student.setSessionSubject.php" method="POST">
                                            <input type="hidden" name="subject_list_id" value="<?php echo $row['fk_subject_list_id']; ?>">
                                            <button type="submit" name="submitSubjectId" class="btn startBtn">Start</button>
                                        </form>
                                        <!-- <a href="student.subjects.php" class="btn startBtn">Start</a> -->
                                    </div>

                                    <div class="card-menus mt-4 d-flex justify-content-between ">


                                        <button type="button" class="btn position-relative p-0">
                                            <i class="fa-regular fa-clipboard"></i>
                                            <span
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                3
                                            </span>
                                        </button>
                                        <a href=""><i class="fa-solid fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>

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

//Set session variable when clicking a subject
function setSession() {
    var subjectIdSession = document.getElementById("subjectId").value;
    $.ajax({
        url: "student.subjectSession.php",
        method: "POST",
        data: {
            subjectIdSession : id
        },
        dataType: "JSON",
        success: function(data) {
            location.reload();
           <?php header ("location: assets/header.view.php"); ?>
        }
    })
}
</script>
</body>

</html>