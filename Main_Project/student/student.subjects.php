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
    //unsetting question counter
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
        if($msg == "cancelled"){
            unset($_SESSION['questionCount']);
        }
    }

    // getTask count per grading;
    $firstGradingTask = checkTaskCountPerGrading($conn, $subjectId, 1);
    $secondGradingTask = checkTaskCountPerGrading($conn, $subjectId, 2);
    $thirdGradingTask = checkTaskCountPerGrading($conn, $subjectId, 3);
    $fourthGradingTask = checkTaskCountPerGrading($conn, $subjectId, 4);

    // Leng query back
    $selectStudentTasks = "SELECT * FROM task_list_tbl WHERE task_list_tbl.fk_subject_list_id = $subjectId";
    $resultTasks =  $conn->query($selectStudentTasks) or die ($mysqli->error);


    // Display task per subjects
    # SELECT * FROM ((task_list_tbl INNER JOIN submission_tbl ON task_list_tbl.task_list_id = submission_tbl.fk_task_list_id) INNER JOIN task_tbl ON task_list_tbl.fk_task_type = task_tbl.task_id) WHERE submission_tbl.fk_student_id = $studentId
    # First Grading SELECT task_list_tbl.task_name, submission_tbl.score FROM ((task_list_tbl INNER JOIN submission_tbl ON task_list_tbl.task_list_id = submission_tbl.fk_task_list_id)) WHERE submission_tbl.fk_student_id = 6;
    $selectStudentTasksFirstGrading = "SELECT * FROM task_list_tbl WHERE task_list_tbl.fk_grading_id = 1 AND task_list_tbl.fk_subject_list_id = $subjectId";
    $resultTasksFirstGrading =  $conn->query($selectStudentTasksFirstGrading) or die ($mysqli->error);
    

    # Second Grading 
    $selectStudentTasksSecondGrading = "SELECT * FROM task_list_tbl WHERE task_list_tbl.fk_grading_id = 2 AND task_list_tbl.fk_subject_list_id = $subjectId";
    $resultTasksSecondGrading =  $conn->query($selectStudentTasksSecondGrading) or die ($mysqli->error);

    # Third Grading 
    $selectStudentTasksThirdGrading = "SELECT * FROM task_list_tbl WHERE task_list_tbl.fk_grading_id = 3 AND task_list_tbl.fk_subject_list_id = $subjectId";
    $resultTasksThirdGrading =  $conn->query($selectStudentTasksThirdGrading) or die ($mysqli->error);

    # Fourth Grading 
    $selectStudentTasksFourthGrading = "SELECT * FROM task_list_tbl WHERE task_list_tbl.fk_grading_id = 4 AND task_list_tbl.fk_subject_list_id = $subjectId";
    $resultTasksFourthGrading =  $conn->query($selectStudentTasksFourthGrading) or die ($mysqli->error);
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
                                <div>
                                    Progress
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
                                            <h4 class="section-title">Section 1</h4>
                                            <br>
                                            <div>
                                                <ul class="nav justify-content-between align-items-center">
                                                    <li class="nav-item"><?php echo $firstGradingTask; ?> Task</li>
                                                    <li class="nav-item d-flex align-items-center">
                                                        <a class="nav-link content-collapse" type="">3 Content
                                                            <i class="fa-solid fa-chevron-down"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- First Grading Content -->
                                        <div class="card-body section-table-content custom-hide">
                                            <table class="table table-hover p-0 section-table">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th></th>
                                                        <th>Type</th>
                                                        <th>Score</th>
                                                        <th>Status</th>
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
                                                    </tr>
                                                    <?php while($rowFirstGrading = $resultTasksFirstGrading->fetch_assoc()): ?>
                                                        <?php if($rowFirstGrading['given'] == "Yes") { ?>
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
                                                            <td>-</td>
                                                            <td class="">-</td>
                                                        </tr>
                                                        <?php } ?>
                                                    <?php endwhile; ?>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Second Grading -->
                                    <div class="section-module mt-2 card">
                                        <div class="card-header">
                                            <h4 class="section-title">Section 2</h4>
                                            <br>
                                            <div>
                                                <ul class="nav justify-content-between align-items-center">
                                                    <li class="nav-item"><?php echo $secondGradingTask; ?> Task</li>
                                                    <li class="nav-item d-flex align-items-center">
                                                        <a class="nav-link content-collapse" type="">4 Content
                                                            <i class="fa-solid fa-chevron-down"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Second Grading Content -->
                                        <div class="card-body section-table-content custom-hide">
                                            <table class="table table-hover p-0 section-table">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th></th>
                                                        <th>Type</th>
                                                        <th>Score</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr>


                                                        <td class=""><a class="section-link"
                                                                href="student.module.php">02 Module
                                                                1</a></td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    </tr>
                                                    <?php while($rowSecondGrading = $resultTasksSecondGrading->fetch_assoc()): ?>
                                                        <?php if($rowSecondGrading['given'] == "Yes") { ?>
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
                                                            <td>-</td>
                                                            <td class="">-</td>
                                                        </tr>
                                                        <?php } ?>

                                                    <?php endwhile; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Third Grading -->
                                    <div class="section-module mt-2 card">
                                        <div class="card-header">
                                            <h4 class="section-title">Section 3</h4>
                                            <br>
                                            <div>
                                                <ul class="nav justify-content-between align-items-center">
                                                    <li class="nav-item"><?php echo $thirdGradingTask; ?> Task</li>
                                                    <li class="nav-item d-flex align-items-center">
                                                        <a class="nav-link content-collapse" type="">7 Content
                                                            <i class="fa-solid fa-chevron-down"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Third Grading Content -->
                                        <div class="card-body section-table-content custom-hide">
                                            <table class="table table-hover p-0 section-table">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th></th>
                                                        <th>Type</th>
                                                        <th>Score</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    <tr>
                                                        <td class=""><a class="section-link"
                                                                href="student.module.php">03 Module
                                                                1</a></td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    </tr>
                                                    <?php while($rowThirdGrading = $resultTasksThirdGrading->fetch_assoc()): ?>
                                                        <?php if($rowThirdGrading['given'] == "Yes") { ?>
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
                                                            <td class="">-</td>
                                                            <td class="">-</td>
                                                            <td class="">-</td>
                                                        </tr>
                                                        <?php } ?>

                                                    <?php endwhile; ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Fourth Grading -->
                                    <div class="section-module mt-2 card">
                                        <div class="card-header">
                                            <h4 class="section-title">Section 4</h4>
                                            <br>
                                            <div>
                                                <ul class="nav justify-content-between align-items-center">
                                                    <li class="nav-item"><?php echo $fourthGradingTask; ?> Task</li>
                                                    <li class="nav-item d-flex align-items-center">
                                                        <a class="nav-link content-collapse" type="">7 Content
                                                            <i class="fa-solid fa-chevron-down"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Fourth Grading Content -->
                                        <div class="card-body section-table-content custom-hide">
                                            <table class="table table-hover p-0 section-table">
                                                <thead class="text-center">
                                                    <tr class="text-center">
                                                        <th></th>
                                                        <th>Type</th>
                                                        <th>Score</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        <td class=""><a class="section-link"
                                                                href="student.module.php">04 Module
                                                                1</a></td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                        <td>-</td>
                                                    </tr>
                                                    <?php while($rowFourthGrading = $resultTasksFourthGrading->fetch_assoc()): ?>
                                                        <?php if($rowThirdGrading['given'] == "Yes") { ?>
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
                                                            <td class="">-</td>
                                                            <td class="">-</td>
                                                            <td class="">-</td>
                                                        </tr>
                                                        <?php } ?>
                                                    <?php endwhile; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>

                                <!-- Subject Task -->
                                <div class="tab-content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="d-flex  ">
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
                                                <th scope="col" class="text-center">Score</th>
                                                <th scope="col" class="text-center">Duration</th>
                                                <th scope="col" class="text-center">Status</th>

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
                                                <!-- edit -->
                                                <td>-</td>
                                                <td>-</td>

                                                <!-- edit -->
                                                <td>-</td>
                                            </tr>

                                            <?php endwhile; ?>

                                        </tbody>
                                    </table>
                                </div>

                                <!-- Subject Progress -->
                                <div class="tab-content">
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