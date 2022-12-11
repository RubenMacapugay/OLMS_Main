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
$taskId = $_GET['taskId'];

$taskResult = taskExists($conn, $taskId);

if(!isset($taskId) || $taskResult == false){
    header ("location: teacher.subject.php");

}



?>  

<!-- Modal Update-->
<!-- Update Multiple Choice task -->
<div class="modal fade" id="edit_question_multipleChoice_Modal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit Multiple Choice</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../../includes/teacher.createtask.inc.php" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    <input type="hidden" name="updateTaskId" id="updateTaskId" value="<?php echo $_GET['taskId'];?>">
                    <input type="hidden" id="updateQuestionId" class="updateQuestion" name="questionerMultipleChoiceId">
                    <div class="form-group mb-3">
                        <input type="text" name="questionNameMultipleChoice" id="questionNameMultipleChoice" class="form-control updateQuestionName"  required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="answerSelector">Answer key</label>
                        <input type="hidden" class="form-control" id="updateAnswerId" name="updateAnswerId">
                        <select class="form-select" name="answerselectMultipleChoice" aria-label="select answer"
                            id="updateAnswerSelector" onchange="setCorrectChoice(this)">
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
                                <input type="hidden" class="form-control" name="updateChoiceAId" id="updateChoiceAId">
                                <input type="hidden" class="form-control" name="choiceIsCorrectA"
                                    id="choiceIsCorrectA">
                                <input type="text" class="form-control" name="choiceA" id="updateChoiceA" required>
                            </div>
                            <div class="form-check d-flex mt-2"> 
                                <label class="form-check-label mx-2" for="choiceB">
                                    B.
                                </label>
                                <input type="hidden" class="form-control" name="updateChoiceBId" id="updateChoiceBId">
                                <input type="hidden" class="form-control" name="choiceIsCorrectB"
                                    id="choiceIsCorrectB">
                                <input type="text" class="form-control" name="choiceB" id="updateChoiceB" required>
                            </div>
                            <div class="form-check d-flex mt-2">
                                <label class="form-check-label mx-2" for="choiceC">
                                    C.
                                </label>
                                <input type="hidden" class="form-control" name="updateChoiceCId" id="updateChoiceCId">
                                <input type="hidden" class="form-control" name="choiceIsCorrectC"
                                    id="choiceIsCorrectC">
                                <input type="text" class="form-control" name="choiceC" id="updateChoiceC" required>
                            </div>
                            <div class="form-check d-flex mt-2">
                                <label class="form-check-label mx-2" for="choiceD">
                                    D.
                                </label>
                                <input type="hidden" class="form-control" name="updateChoiceDId" id="updateChoiceDId">
                                <input type="hidden" class="form-control" name="choiceIsCorrectD"
                                    id="choiceIsCorrectD">
                                <input type="text" class="form-control" name="choiceD" id="updateChoiceD" required>
                            </div>

                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="updateQuestion_EditTask" class="btn btn-primary">Update</button>
                </div>

            </form>

        </div>
    </div>
</div>
<!-- End of Modal Update -->


<!-- Modal Create Queistions -->
<div class="modal fade" id="create_question_multipleChoice_Modal" tabindex="-1" aria-labelledby="createModuleSection" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createModuleSection">Add Multiple Choice</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method='POST' action='../../includes/teacher.createtask.inc.php' id="createQuestionForm">
                <div class="modal-body">
                    <input type="hidden" name="insertTaskId" id="insertTaskId" value="<?php echo $_GET['taskId'];?>">
                    <input type="hidden" name="createEditTaskQuestionCount" value="<?php echo $taskResult['question_item']+1;?>">
                    <div class="form-group mb-3">
                        <label class="form-label" id="questionLabel">Question  <span id="updateQuestionLabel" name="updateQuestionLabel"><?php echo $taskResult['question_item']+1;?></span></label>
                        <input type="text" class="form-control" id="inputQuestion" name="createQuestioner"
                            aria-describedby="question" placeholder="Enter question here" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="createAnswerSelector">Answer key</label>
                        <select class="form-select" name="createAnswerselect" aria-label="select answer"
                            id="createAnswerselect" onchange="setCorrectChoice2(this)">
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
                                <label class="form-check-label mx-2" for="createChoiceA">
                                    A.
                                </label>
                                <input type="hidden" class="form-control" name="createChoiceIsCorrectA"
                                    id="createChoiceIsCorrectA">
                                <input type="text" class="form-control" name="createChoiceA" id="createChoiceA" required>
                            </div>
                            <div class="form-check d-flex mt-2"> 
                                <label class="form-check-label mx-2" for="createChoiceB">
                                    B.
                                </label>
                                <input type="hidden" class="form-control" name="createChoiceIsCorrectB"
                                    id="createChoiceIsCorrectB">
                                <input type="text" class="form-control" name="createChoiceB" id="createChoiceB" required>
                            </div>
                            <div class="form-check d-flex mt-2">
                                <label class="form-check-label mx-2" for="createChoiceC">
                                    C.
                                </label>
                                <input type="hidden" class="form-control" name="createChoiceIsCorrectC"
                                    id="createChoiceIsCorrectC">
                                <input type="text" class="form-control" name="createChoiceC" id="createChoiceC" required>
                            </div>
                            <div class="form-check d-flex mt-2">
                                <label class="form-check-label mx-2" for="createChoiceD">
                                    D.
                                </label>
                                <input type="hidden" class="form-control" name="createChoiceIsCorrectD"
                                    id="createChoiceIsCorrectD">
                                <input type="text" class="form-control" name="createChoiceD" id="createChoiceD" required>
                            </div>

                        </div>
                    </div>
                    <div class="text-center mb-3">
                        <button type="submit" name="cancelQuestion" class="btn btn-secondary ms-3"
                            id="cancelBtn">Cancel</button>
                        <button type="submit" name="createQuestion_EditTask" class="btn btn-primary ms-3"
                            id="nextBtn">Create</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="delete_question_multipleChoice_Modal" tabindex="-1" aria-labelledby="deleteModalTask" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="container-fluid">
                <form action="../../includes/teacher.createtask.inc.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="deleteTaskId" id="deleteTaskId" value="<?php echo $_GET['taskId'];?>">
                    <input type="text" name="deleteEditTaskQuestionCount" value="<?php echo $taskResult['question_item'];?>">

                    <div class="modal-body text-center">
                        <h1 class="modal-title fs-5" id="updateTaskTitle">Do you want to delete the Questioner?</h1>
                        <input type="text" class="deleteTaskId" name="inputDeleteTaskId">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="deleteQuestion_EditTask" class="btn btn-danger" id="deleteModalTaskBtn">Delete</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!--Body content --> 
<div class="container-fluid " id="content">
    <div class="row overflow-hidden"> 
        
        <!-- Left Side Nav global-->
        <div class="col-md-2 " id="sideNav">
            <button class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#updateModalTask">Click me</button>
            <?php include('assets/sidebar.view.php') ?>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 py-4 main-content" id="teacherSubjectContent">
            <div class="row mx-0">
                <!-- Session Messages -->
                <?php 
                    if(isset($_SESSION['msg'])){
                        if($_SESSION['msg'] == "questionerdeleted"){
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        Questioner has been deleted!
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>';
                        }
                        if($_SESSION['msg'] == "questionertaken"){
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Questioner is taken!
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>';
                        }
                        if($_SESSION['msg'] == "taskDeletedFailed"){
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        Task has been deleted!
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>';
                        }
                        if($_SESSION['msg'] == "taskupdated"){ 
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

                        unset($_SESSION['msg']);
                    }
                ?>
                <div class="container-fluid custom-border">
                    <div>
                        <a href="teacher.subject.php?tab=taskTab">back</a>
                        <h2><?php echo $taskResult['task_name'];?></h2>
                        
                        <button class="btn btn-primary my-2 new_question" id="new_question"><i class="fa fa-plus"></i> Add Question</button>
                    </div>
                    <div>
                        <div class="card col-md-12 " style="float:left">
                            <div class="card-header">
                                <h3>Questions</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover">
                                    <tbody>
                                    <?php
                                        $qry = $conn->query("SELECT * FROM question_tbl where fk_task_list_id = ".$_GET['taskId']);
                                        while($row=$qry->fetch_array()){
                                            ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex d-flex justify-content-between">
                                                        <p><?php echo $row['question_name'] ?></p>
                                                        <div>
                                                            <span class="d-none" id="questionIdEditTask"><?php echo $row['question_id'];?></span>
                                                            <span class="d-none" id="questionerEditTask"><?php echo $row['question_name'];?></span>
                                                            <?php 
                                                                $taskType = $taskResult['sub_type'];
                                                                $questionId = $row['question_id'];
                                                                if ($taskType == "0"){
                                                                    // echo "Multiple choice";
                                                                    // Loop here for choices
                                                                    $choicesSql = "SELECT * FROM choices_tbl WHERE fk_question_id = {$questionId}";
                                                                    $choicesResult = mysqli_query($conn, $choicesSql);
                                                                    $choicesList = [];
                                                                    $chocesIdList = [];
                                                                    while($choiceRow = mysqli_fetch_array($choicesResult)){
                                                                        array_push($chocesIdList, $choiceRow['choices_id']);
                                                                        array_push($choicesList, $choiceRow['choices_name']);
                                                                    }
                                                                    $data['choiceA'] = $choicesList[0];
                                                                    $data['choiceB'] = $choicesList[1];
                                                                    $data['choiceC'] = $choicesList[2];
                                                                    $data['choiceD'] = $choicesList[3];

                                                                    $data['choiceAId'] = $chocesIdList[0];
                                                                    $data['choiceBId'] = $chocesIdList[1];
                                                                    $data['choiceCId'] = $chocesIdList[2];
                                                                    $data['choiceDId'] = $chocesIdList[3];

                                                                    $answerSql = "SELECT * FROM answer_tbl WHERE fk_question_id = {$questionId}";
                                                                    $answerResult = mysqli_query($conn, $answerSql);
                                                                    while($answerRow = mysqli_fetch_array($answerResult)){
                                                                        // fetching the record $row = same from database
                                                                        $data['answerId'] = $answerRow['answer_id'];
                                                                        $data['answerKey'] = $answerRow['answer_key'];
                                                                    }

                                                                    ?> 
                                                                        <span class="d-none choiceAId" id="choiceAId"><?php echo $data['choiceAId']; ?></span>
                                                                        <span class="d-none choiceBId" id="choiceBId"><?php echo $data['choiceBId']; ?></span>
                                                                        <span class="d-none choiceCId" id="choiceCId"><?php echo $data['choiceCId']; ?></span>
                                                                        <span class="d-none choiceDId" id="choiceDId"><?php echo $data['choiceDId']; ?></span>

                                                                        <span class="d-none choiceA" id="choiceA"><?php echo $data['choiceA']; ?></span>
                                                                        <span class="d-none choiceB" id="choiceB"><?php echo $data['choiceB']; ?></span>
                                                                        <span class="d-none choiceC" id="choiceC"><?php echo $data['choiceC']; ?></span>
                                                                        <span class="d-none choiceD" id="choiceD"><?php echo $data['choiceD']; ?></span>

                                                                        <!-- answer key -->
                                                                        <span class="d-none answerId" id="answerId"><?php echo $data['answerId']; ?></span>
                                                                        <span class="d-none answerKey" id="answerKey"><?php echo $data['answerKey']; ?></span>

                                                                    <?php 

                                                                    // save on span and send to modal
                                                                    echo '<button class="btn edit_question_multipleChoice p-0" type="button"><i class="fa-regular fa-pen-to-square text-primary"></i></button>';
                                                                    echo '<button class="btn remove_question p-0" type="button"><i class="fa-solid fa-trash text-danger"></i></button>';
                                                                } else if($taskType == "1"){
                                                                    // echo "Identification";
                                                                    echo '<button class="btn edit_question_identification p-0" type="button"><i class="fa-regular fa-pen-to-square text-primary"></i></button>';
                                                                    echo '<button class="btn remove_question p-0" type="button"><i class="fa-solid fa-trash text-danger"></i></button>';
                                                                } else if($taskType == "2"){
                                                                    // echo "True or false";
                                                                    echo '<button class="btn edit_question_trueOrFalse p-0" type="button"><i class="fa-regular fa-pen-to-square text-primary"></i></button>';
                                                                    echo '<button class="btn remove_question p-0" type="button"><i class="fa-solid fa-trash text-danger"></i></button>';
                                                                } else if($taskType == "3"){
                                                                    // echo "Essay";
                                                                    echo '<button class="btn edit_question_essay p-0" type="button"><i class="fa-regular fa-pen-to-square text-primary"></i></button>';
                                                                    echo '<button class="btn remove_question p-0" type="button"><i class="fa-solid fa-trash text-danger"></i></button>';
                                                                }
                                                                echo "<br>";
                                                            ?>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>

                                </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
       
    </div>
</div>

<!-- Script Links Bootstrap/Jquery -->
<?php include('assets/scriptlink.view.php')?>


<script type="text/javascript">

    // script for updating question details - multiple choice
    $(document).ready(function (){
        $(document).on('click', '.edit_question_multipleChoice', function(){
            var questionId = $(this).closest('div').find('#questionIdEditTask').text();
            var questioner = $(this).closest('div').find('#questionerEditTask').text();

            // getting the choices names and id
            var choiceAId = $(this).closest('div').find('#choiceAId').text();
            var choiceBId = $(this).closest('div').find('#choiceBId').text();
            var choiceCId = $(this).closest('div').find('#choiceCId').text();
            var choiceDId = $(this).closest('div').find('#choiceDId').text();

            var choiceA = $(this).closest('div').find('#choiceA').text();
            var choiceB = $(this).closest('div').find('#choiceB').text();
            var choiceC = $(this).closest('div').find('#choiceC').text();
            var choiceD = $(this).closest('div').find('#choiceD').text();
            
            // getting the correct choice
            var answerId = $(this).closest('div').find('#answerId').text();
            var answerKey = $(this).closest('div').find('#answerKey').text();

           

            $('#edit_question_multipleChoice_Modal').modal('show'); // load modal
            
            // setting value for question
            $('.updateQuestion').val(questionId);
            $('.updateQuestionName').val(questioner);

            // setting value for choices
            $('#updateChoiceAId').val(choiceAId);
            $('#updateChoiceBId').val(choiceBId);
            $('#updateChoiceCId').val(choiceCId);
            $('#updateChoiceDId').val(choiceDId);

            $('#updateChoiceA').val(choiceA);
            $('#updateChoiceB').val(choiceB);
            $('#updateChoiceC').val(choiceC);
            $('#updateChoiceD').val(choiceD);

            //setting the correct answer 
            $('#updateAnswerId').val(answerId);
            $('#updateAnswerSelector').val(answerKey).change();


            
            
        });
    });
    //createQuestion_EditTask
    $(document).ready(function (){
        $(document).on('click', '.new_question', function(){
            $('#create_question_multipleChoice_Modal').modal('show'); // load delete modal
        });
    });

    // script for deleting task - deleteTableTaskBtn
    $(document).ready(function (){
        $(document).on('click', '.remove_question', function(){
            var questionId = $(this).closest('div').find('#questionIdEditTask').text();

            $('#delete_question_multipleChoice_Modal').modal('show'); // load delete modal
            
            $('.deleteTaskId').val(questionId);
        });
    });

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

    function setCorrectChoice2(select) {
        if (select.value == 1) {
            document.getElementById('createChoiceIsCorrectA').value = 1;
            document.getElementById('createChoiceIsCorrectB').value = 0;
            document.getElementById('createChoiceIsCorrectC').value = 0;
            document.getElementById('createChoiceIsCorrectD').value = 0;
        } else if (select.value == 2) {
            document.getElementById('createChoiceIsCorrectA').value = 0;
            document.getElementById('createChoiceIsCorrectB').value = 1;
            document.getElementById('createChoiceIsCorrectC').value = 0;
            document.getElementById('createChoiceIsCorrectD').value = 0;
        } else if (select.value == 3) {
            document.getElementById('createChoiceIsCorrectA').value = 0;
            document.getElementById('createChoiceIsCorrectB').value = 0;
            document.getElementById('createChoiceIsCorrectC').value = 1;
            document.getElementById('createChoiceIsCorrectD').value = 0;
        } else if (select.value == 4) {
            document.getElementById('createChoiceIsCorrectA').value = 0;
            document.getElementById('createChoiceIsCorrectB').value = 0;
            document.getElementById('createChoiceIsCorrectC').value = 0;
            document.getElementById('createChoiceIsCorrectD').value = 1;
        }
        else {
        }
    }
</script>



</body>

</html>