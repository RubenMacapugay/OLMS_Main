<?php include('assets/header.view.php')?>


<!--Body content -->
<div class="container-fluid " id="content">
    <div class="row overflow-hidden">
        <!-- Left Side Nav global-->
        <div class="col-md-2 " id="sideNav">
            <?php include('assets/sidebar.view.php') ?>
        </div>

        <!-- Main Content -->
        <div class="col-md-8 main-content" >

            <div class="container-fluid ">
                <div class="custom-border mt-4">

                    <?php 
                        // if(isset($_SESSION['msg'])){
                        //     echo 'Session message: '.$_SESSION['msg'];
                        // }
                        if(isset($_SESSION['msg'])){
                            if($_SESSION['msg'] == "emptyinput"){
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Missing Fillds! Please re-enter your inputs.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                            }

                            if($_SESSION['msg'] == "tasknametaken"){
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Task name has been used! Please re-enter your inputs.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                            }

                            if($_SESSION['msg'] == "taskcompleted"){ 
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        Task has been saved!
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                            }

                            unset($_SESSION['msg']);
                        }
                    ?>
                    <h5 class="">Create Task Title</h5>

                    <!-- Create Task form -->
                    <form method='POST' action='../../includes/teacher.createtask.inc.php'>
                        <!-- Capturing the subject ID -->
                        <?php $subjectId = $_GET['currentSubject']; ?>
                        <input type="hidden" name="subjectid" value="<?php echo $subjectId; ?>">
                        <div class="row">
                            <!-- Task Details -->
                            <div class="row task-details">
                                <div class="form-group col-md-6">
                                    <div class="mb-3">
                                        <label for="gradingSelector">Select Grading</label>
                                        <select class="form-select" name="grading" aria-label="select grading"
                                            id="gradingSelector">
                                            <?php 
                                            $sqli = "SELECT * FROM grading_tbl";
                                            $result = mysqli_query($conn, $sqli);
                                            while($row = mysqli_fetch_array($result)) {
                                                $gradingId = $row['grading_id'];
                                                echo '<option value="'.$gradingId.'">' .$row['grading_name']. '</option>';
                                            } 
                                        ?>
                                        </select>

                                    </div>
                                    <div class="mb-3">
                                        <label for="inputAssignmentDescription" class="form-label mb-0">Task
                                            Name</label>
                                        <input type="name" class="form-control" name="taskname"
                                            id="inputAssignmentDescription" aria-describedby="taskname"
                                            placeholder="sample: 01 Quiz 01">
                                    </div>
                                    <div class="mb-3 ps-0" id="taskcontentDiv">
                                        <label for="">Task Content</label>
                                        <textarea class="form-control" name="taskcontent"
                                            placeholder="Content Description" id="floatingTextarea"></textarea>
                                    </div>
                                    <div class="mb-3 w-50" id="questionItemsDiv">
                                        <label for="">Question items</label>
                                        <input type="number" class="form-control" name="questionitems"
                                            placeholder="0"></input>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <label for="inputTaskType">Task type</label>
                                            <div class="container-fluid p-0">
                                                <select class="form-select" name="tasktype" id="options">
                                                    <option value="none" disabled selected>Select task</option>

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
                                        <div class="col-6 mb-3">
                                            <label for="inputTaskType">Sub type</label>
                                            <select class="form-select" name="subtype" id="subtype"
                                                onchange="showDiv(this)">
                                                <option value="" disabled selected>Select sub task</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-check-label" for="inputDates">Duration</label>
                                        <div class="d-flex align-items-center">
                                            <input type="date" class="form-control" name="datecreated"
                                                id="inputStartDate">
                                            <span class="mx-2">to</span>
                                            <input type="date" class="form-control" name="datedeadline"
                                                id="inputEndDate">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <label for="inputTime">Time</label>
                                            <input type="time" class="form-control" name="timelimit" id="inputTime">
                                        </div>

                                        <div class="col-6">
                                            <label for="inputMaxScore">Max attemps</label>
                                            <input type="number" class="form-control" name="maxattempts"
                                                id="inputMaxScore">
                                        </div>
                                    </div>
                                    <div class="row mb-3">

                                        <div class="col-6 mb-3 " id="inputMaxScoreDiv">
                                            <label for="inputMaxScore">Max score</label>
                                            <input type="number" class="form-control" name="maxscore"
                                                id="inputMaxScore">
                                        </div>

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
                        <div class="d-flex justify-content-end">
                            <a href="teacher.subject.php"><button type="button"
                                    class="btn btn-secondary">Close</button></a>
                            <!-- Multiple Choice -->
                            <button type="submit" name="createQuestionTask" class="btn btn-primary ms-2 custom-hide"
                                id="createBtn">Proceed
                                to Multiple Choice</button>
                            <!-- Identification --> 
                            <button type="submit" name="createIdentificationTask"
                                class="btn btn-primary ms-2 custom-hide" id="createIdentificationBtn">Proceed
                                to indentification</button>
                            <!-- Enumeration -->
                            <button type="submit" name="createEnumeration" class="btn btn-primary ms-2 custom-hide"
                                id="createEnumerationBtn">Proceed
                                to Enumeration</button>
                            <!-- True or False -->
                            <button type="submit" name="createTrueOrFalse" class="btn btn-primary ms-2 custom-hide"
                                id="createTrueOrFalse">Proceed
                                to True or False</button>
                            <!-- Essay -->
                            <button type="submit" name="createEssay" class="btn btn-primary ms-2"
                                id="createWithQuestionBtn">Create Essay</button>
                        </div>
                    </form>
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
// Map your choices to your option value
var lookup = {
    '1': ['Multiple Choice', 'Identification', 'Enumiration', 'True or False',  'Essay'],
    '2': ['Multiple Choice', 'Identification', 'Enumiration', 'True or False', 'Essay'],
    '3': ['Multiple Choice', 'Identification', 'Enumiration', 'True or False'],
    '4': ['Multiple Choice', 'Identification', 'Enumiration', 'True or False']
};
// When an option is changed, search the above for matching choices
$('#options').on('change', function() {
    // Set selected option as variable
    var selectValue = $(this).val();

    // Empty the target field
    $('#subtype').empty();
    // For each chocie in the selected option
    for (i = 0; i < lookup[selectValue].length; i++) {
        // Output choice in the target field
        $('#subtype').append("<option value='" + i + "'>" + lookup[selectValue][i] +
            "</option>");
    }

    showDiv(lookup[selectValue]);
});

document.getElementById('questionItemsDiv').style.display = "none";
function showDiv(select) {

    if (select.value == 4) {
        document.getElementById('taskcontentDiv').style.display = "block";
        document.getElementById('questionItemsDiv').style.display = "none";
        document.getElementById('inputMaxScoreDiv').style.display = "block";
        document.getElementById('createBtn').style.display = "none";
        document.getElementById('createTrueOrFalse').style.display = "none";
        document.getElementById('createWithQuestionBtn').style.display = "block";
        document.getElementById('createIdentificationBtn').style.display = "none";
        document.getElementById('createEnumerationBtn').style.display = "none";
    } else if (select.value == 3) {
        document.getElementById('taskcontentDiv').style.display = "none";
        document.getElementById('questionItemsDiv').style.display = "block";
        document.getElementById('createWithQuestionBtn').style.display = "none";
        document.getElementById('createBtn').style.display = "none";
        document.getElementById('createTrueOrFalse').style.display = "block";
        document.getElementById('inputMaxScoreDiv').style.display = "none";
        document.getElementById('createIdentificationBtn').style.display = "none";
        document.getElementById('createEnumerationBtn').style.display = "none";
    } else if (select.value == 2) {
        document.getElementById('taskcontentDiv').style.display = "none";
        document.getElementById('questionItemsDiv').style.display = "block";
        document.getElementById('inputMaxScoreDiv').style.display = "block";
        document.getElementById('createBtn').style.display = "none";
        document.getElementById('createWithQuestionBtn').style.display = "none";
        document.getElementById('createTrueOrFalse').style.display = "none";
        document.getElementById('createIdentificationBtn').style.display = "none";
        document.getElementById('createEnumerationBtn').style.display = "block";
    } else if (select.value == 1) {
        // type your code here
        document.getElementById('taskcontentDiv').style.display = "none";
        document.getElementById('questionItemsDiv').style.display = "block";
        document.getElementById('inputMaxScoreDiv').style.display = "none";
        document.getElementById('createBtn').style.display = "none";
        document.getElementById('createTrueOrFalse').style.display = "none";
        document.getElementById('createWithQuestionBtn').style.display = "none";
        document.getElementById('createIdentificationBtn').style.display = "block";
        document.getElementById('createEnumerationBtn').style.display = "none";
    } else {
        document.getElementById('taskcontentDiv').style.display = "none";
        document.getElementById('questionItemsDiv').style.display = "block";
        document.getElementById('createWithQuestionBtn').style.display = "none";
        document.getElementById('createBtn').style.display = "block";
        document.getElementById('inputMaxScoreDiv').style.display = "none";
        document.getElementById('createIdentificationBtn').style.display = "none";
        document.getElementById('createTrueOrFalse').style.display = "none";
        document.getElementById('createEnumerationBtn').style.display = "none";
    }
}

var createBtn = document.querySelector("#createBtn");
var hideForm = document.querySelector("#questionerDiv");
createBtn.addEventListener("click", function() {
    hideForm.classList.add("show-div");
});
</script>

</body>

</html>