<?php 
include('assets/header.view.php'); 
ini_set('display_errors',1);
?>
<!--Body content -->
<div class="container-fluid " id="content">
    <div class="row overflow-hidden">

        <!-- Left Side Nav global-->
        <div class="col-md-2 " id="sideNav">
            <?php include('assets/sidebar.view.php');
            
            ?>
        </div>

        <!-- Main Content -->


        <div class="col-md-8 ">
            <div class="container-fluid create-question" id="content">
                <?php 
                // echo "Task id: ".$_SESSION["task_id"]."<br>";
                // echo "Subject Id: ".$_SESSION["subjectId"]."<br>";
                // echo "Current question ID: ".$_SESSION['recentlyAdded'];
                
                ?>
                <div class="custom-border mt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0" id="mema">Create Task Title</h5>
                        <div class="d-flex w-50 align-items-center questioner-cont">
                            <label for="questionList" class="question-label">Question List: </label>
                            <select class="form-select" name="questionList" id="questionList" aria-label="select answer"
                                id="answerSelector" onchange="fetchTrueOrFalse()">
                                <option>Select</option>
                                <?php 
                                    $id = $_SESSION["task_id"];
                                    $sqli = "SELECT * FROM question_tbl where fk_task_list_id = {$id}";
                                    $result = mysqli_query($conn, $sqli);
                                    while($row = mysqli_fetch_array($result)) {
                                        $question = $row['question_id'];
                                        echo '<option value="'.$question.'">' .$row['question_name']. '</option>';
                                    } 
                                ?>
                            </select>
                        </div>
                    </div>

                    <!-- Questioner -->
                    <div class="mt-3">
                        <form method='POST' action='../../includes/teacher.createtask.inc.php' id="createQuestionForm">
                            <div class="form-group mb-3">
                                <div class="mb-3">
                                    <label for="quetioner" class="form-label" id="nextQuestionLabel" >Question
                                        <?php if(isset($_SESSION['questionCounter'])) echo $_SESSION['questionCounter'];?></label>
                                    <label class="form-label" id="questionLabel">Question <span id="updateQuestionLabel"
                                            name="updateQuestionLabel"></span></label>

                                    <!-- Questioner -->
                                    <input type="hidden" class="form-control" id="inputtrueOrFalseQuestionerId"
                                        name="trueOrFalseQuestionerId" aria-describedby="questionHidden">
                                    <input type="text" class="form-control" id="inputtrueOrFalseQuestioner"
                                        placeholder="Enter question here" name="trueOrFalseQuestioner">
                                </div>
                                <div class="ms-3 mt-1">
                                    <input type="hidden" name="submissionChoiceId" id="submissionChoiceId">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="submissionchoice" type="radio"
                                            id="radioTrue" value="True">
                                        <label class="form-check-label" for="radioYes">
                                            True
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="submissionchoice" type="radio"
                                            id="radioFalse" value="False">
                                        <label class="form-check-label" for="radioNo">
                                            False
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mb-3">
                                <button type="submit" name="cancelTrueOrFalseQuestion" class="btn btn-secondary ms-3"
                                    id="cancelBtn">Cancel</button>
                                <button type="submit" name="nextTrueOrFalseQuestion" class="btn btn-primary ms-3"
                                    id="nextBtn">next</button>
                                <button type="submit" name="updateTrueOrFalseQuestion" class="btn btn-primary ms-3"
                                    id="updateBtn">update</button>
                            </div>


                        </form>
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
<script src="populateQuestioner.js"></script>
<script>
document.getElementById('nextBtn').style.display = "inline-block";
document.getElementById('nextQuestionLabel').style.display = "inline-block";

document.getElementById('updateBtn').style.display = "none";
document.getElementById('questionLabel').style.display = "none";

document.getElementById('choiceIsCorrectA').value = 1;

function setCorrectChoice(select) {
    if (select.value == 1) {
        document.getElementById('choiceIsCorrectA').value = 1;
        document.getElementById('choiceIsCorrectB').value = 0;
        document.getElementById('choiceIsCorrectC').value = 0;
        document.getElementById('choiceIsCorrectD').value = 0;
    } else if (select.value == 2) {
        document.getElementById('choiceIsCorrectA').value = 0;
        document.getElementById('choiceIsCorrectB').value = 1;
        document.getElementById('choiceIsCorrectC').value = 0;
        document.getElementById('choiceIsCorrectD').value = 0;
    } else if (select.value == 3) {
        document.getElementById('choiceIsCorrectA').value = 0;
        document.getElementById('choiceIsCorrectB').value = 0;
        document.getElementById('choiceIsCorrectC').value = 1;
        document.getElementById('choiceIsCorrectD').value = 0;
    } else if (select.value == 4) {
        document.getElementById('choiceIsCorrectA').value = 0;
        document.getElementById('choiceIsCorrectB').value = 0;
        document.getElementById('choiceIsCorrectC').value = 0;
        document.getElementById('choiceIsCorrectD').value = 1;
    } else {}
}
</script>

</body>

</html>