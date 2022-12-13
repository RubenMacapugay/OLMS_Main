<?php 
include('assets../header.view.php'); 
// echo "Task id: ".$_SESSION["task_id"]."<br>";
// echo "Task type: ".$_SESSION["task_type"]."<br>";
// echo 'Subject: '.$_SESSION['subjectId'];

// getting the task id from session
$taskId = $_SESSION["task_id"];

// retrieving the task from database
$taskExists = getCurrentTask($conn, $taskId);
$taskName = $taskExists['task_name'];
$subType = $taskExists['sub_type'];

// echo '<br>Sub Type: '.$subType;
// echo '<br>Current task: '.$taskName;

//getting the first question
$sqlFirstQuestion = "SELECT * FROM question_tbl WHERE question_tbl.fk_task_list_id = $taskId ORDER BY MIN(question_id) LIMIT 1";
$questionResult= mysqli_query($conn, $sqlFirstQuestion);
if($row = mysqli_fetch_array($questionResult)){
    $questionId = $row['question_id'];
}

$_SESSION['questionCounter'] = 1;
?>

<!--Body content -->

<div class="container-fluid " id="content">

    <div class="row overflow-hidden">

        <!-- Left Side Nav global-->
        <div class="col-md-2 " id="sideNav">
            <?php include('assets../sidebar.view.php') ?>
        </div>

        <!-- Main Content -->
        <div class="col-md-8 py-4 main-content" id="subjectMainContent">
            <div class="row mx-0">
                <div class="custom-border">
                    <a href="student.subjects.php" class="text-primary">Back</a>

                    
                    <!-- Change according to the type of grading -->
                    <h3 class="text-center">First Grading - Quiz</h3>

                    <?php // Display Multiple Choice
                    if($subType == 0){
                    ?>
                        <p><?php echo $taskName; ?></p>
                        <p><?php echo '<a href="student.multipleChoice.php?taskId='.$taskId.'&questionId='.$questionId.'" class="btn btn-success">Start</a>' ?></p>

                    <?php
                    }
                    ?>

                    <?php // Display Identification
                    if($subType == 1){
                    ?>
                        <p><?php echo $taskName; ?></p> 
                        <p><?php echo '<a href="student.identification.php?taskId='.$taskId.'&questionId='.$questionId.'" class="btn btn-success">Start</a>' ?></p>

                    <?php
                    }
                    ?>

                    <?php // Display Enumeration
                    if($subType == 10){
                    ?>
                        <p><?php echo $taskName; ?></p>
                        <p><?php echo '<a href="student.enumeration.php?taskId='.$taskId.'&questionId='.$questionId.'" class="btn btn-success">Start</a>' ?></p>

                    <?php
                    }
                    ?>

                    <?php // Display True or false
                    if($subType == 2){
                    ?>
                        <p><?php echo $taskName; ?></p>
                        <p><?php echo '<a href="student.trueorfalse.php?taskId='.$taskId.'&questionId='.$questionId.'" class="btn btn-success">Start</a>' ?></p>

                    <?php
                    }
                    ?>

                    <?php // Display Essay
                    if($subType == 3){
                    ?>
                        <p><?php echo $taskName; ?></p>
                        <p><?php echo '<a href="student.essay.php?taskId='.$taskId.'&questionId='.$questionId.'" class="btn btn-success">Start</a>' ?></p>

                    <?php
                    }
                    ?>

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
let btn2 = document.querySelector(".table-control-collapse");
let customHideTable = document.querySelector(".section-table-content");
customHideTable.classList.toggle("custom-hide");
btn2.onclick = function() {
    customHideTable.classList.toggle("custom-hide");
};
</script>


</body>

</html>