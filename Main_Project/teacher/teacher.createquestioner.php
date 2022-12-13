<?php
include('assets/header.view.php'); 
ini_set('display_errors',1);
?>
<!--Body content -->
<div class="container-fluid " id="content">
    <div class="row overflow-hidden">

        <!-- Left Side Nav global-->
        <div class="col-md-2 " id="sideNav">
            <?php include('assets/sidebar.view.php') ?> 
        </div>

        <!-- Main Content -->
        <div class="col-md-8 ">
            <div class="container-fluid create-question" id="content">

                <div class="custom-border mt-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0" id="mema">Multiple Choice</h5>
                        <div class="d-flex w-50 align-items-center questioner-cont">
                            <label for="questionList" class="question-label">Question List: </label>
                            <select class="form-select" name="questionList" id="questionList" aria-label="select answer"
                                id="answerSelector" onchange="fetchQuestioner()">
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
                    <!-- Session Testers -->
                    <?php 
                        if(isset($_SESSION['msg'])){
                            
                            if($_SESSION['msg'] == "questionupdated"){
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            Questioner has been Updated!
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
                                
                            }

                            if($_SESSION['msg'] == "questionercreated"){
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            Questioner has been Created!
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
                                
                            }

                            if($_SESSION['msg'] == "questionertaken"){
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            Questioner has been taken!
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
                                
                            }

                            if($_SESSION['msg'] == "missingfeilds"){
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            Missing feilds!
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
                                
                            }
                            unset($_SESSION['msg']);
                        }
                    ?>

                    <!-- Questioner -->
                    <div class="mt-3">
                        <form method='POST' action='../../includes/teacher.createtask.inc.php' id="createQuestionForm">
                            <div class="form-group mb-3">
                                <label for="inputQuestion" id="nextQuestionLabel" name="nextQuestionLabel" class="form-label">Question
                                    <?php echo $_SESSION['questionCounter'];?></label>
                                
                                <label class="form-label" id="questionLabel">Question <span id="updateQuestionLabel" name="updateQuestionLabel"></span></label>

                                <input type="hidden" name="questionNumber" value="<?php echo $_SESSION['questionCounter'];?>">
                                <input type="hidden" class="form-control" id="inputQuestionId" name="questionerId"
                                    aria-describedby="questionHidden">
                                <input type="text" class="form-control" id="inputQuestion" name="questioner"
                                    aria-describedby="question">
                            </div>
                            <div class="form-group mb-3">
                                <label for="answerSelector">Answer key</label>
                                <input type="hidden" class="form-control" id="answerId" name="answerId">
                                <select class="form-select" name="answerselect" aria-label="select answer"
                                    id="answerSelector" onchange="setCorrectChoice(this)">
                                    <option value="1">A</option>
                                    <option value="2">B</option>
                                    <option value="3">C</option>
                                    <option value="4">D</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Choices</label>
                                <div class="mt-1">
                                    <div class="form-check d-flex mt-2">
                                        <label class="form-check-label mx-2" for="choiceA">
                                            A.
                                        </label>
                                        <input type="hidden" class="form-control" name="choiceAId" id="choiceAId">
                                        <input type="hidden" class="form-control" name="choiceIsCorrectA"
                                            id="choiceIsCorrectA">
                                        <input type="text" class="form-control" name="choiceA" id="choiceA">
                                    </div>
                                    <div class="form-check d-flex mt-2"> 
                                        <label class="form-check-label mx-2" for="choiceB">
                                            B.
                                        </label>
                                        <input type="hidden" class="form-control" name="choiceBId" id="choiceBId">
                                        <input type="hidden" class="form-control" name="choiceIsCorrectB"
                                            id="choiceIsCorrectB">
                                        <input type="text" class="form-control" name="choiceB" id="choiceB">
                                    </div>
                                    <div class="form-check d-flex mt-2">
                                        <label class="form-check-label mx-2" for="choiceC">
                                            C.
                                        </label>
                                        <input type="hidden" class="form-control" name="choiceCId" id="choiceCId">
                                        <input type="hidden" class="form-control" name="choiceIsCorrectC"
                                            id="choiceIsCorrectC">
                                        <input type="text" class="form-control" name="choiceC" id="choiceC">
                                    </div>
                                    <div class="form-check d-flex mt-2">
                                        <label class="form-check-label mx-2" for="choiceD">
                                            D.
                                        </label>
                                        <input type="hidden" class="form-control" name="choiceDId" id="choiceDId">
                                        <input type="hidden" class="form-control" name="choiceIsCorrectD"
                                            id="choiceIsCorrectD">
                                        <input type="text" class="form-control" name="choiceD" id="choiceD">
                                    </div>

                                </div>
                            </div>
                            <div class="text-center mb-3">
                                <button type="submit" name="cancelQuestion" class="btn btn-secondary ms-3"
                                    id="cancelBtn">Cancel</button>
                                <button type="submit" name="nextQuestion" class="btn btn-primary ms-3"
                                    id="nextBtn">next</button>
                                <button type="submit" name="updateQuestion" class="btn btn-primary ms-3"
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
    }
     else {
    }
}
</script>

</body>

</html>