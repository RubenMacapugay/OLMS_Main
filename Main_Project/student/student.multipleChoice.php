<?php include('assets../header.view.php') ?>

<style>
    .question-choice{
        font-size: 1.3rem;
    }
</style>
<?php  
if(isset($_GET['taskId'])){
    //Set the question number
    $taskId = $_GET['taskId'];
    $quesionId = $_GET['questionId'];

    //Query for the Question
    $query = "SELECT * FROM question_tbl where fk_task_list_id=$taskId and question_id=$quesionId";
	$result = mysqli_query($conn,$query);
	$question = mysqli_fetch_assoc($result); 

	//Get Choices
	$query = "SELECT * FROM choices_tbl WHERE fk_question_id = $quesionId";
	$choices = mysqli_query($conn,$query);

	// Get Total questions
	$query = "SELECT * FROM question_tbl where fk_task_list_id=$taskId";
	$total_questions = mysqli_num_rows(mysqli_query($conn,$query));

    // getting the recent selected choice
    // $recentSubmittedId = "SELECT max(submitted_answer_id) FROM submitted_answer_tbl where fk_question_id = $quesionId";
	// $resultRecentSubmittedId = mysqli_query($conn,$recentSubmittedId);
    // $rowResultRecentSubmittedId = mysqli_fetch_assoc($resultRecentSubmittedId);
    // $varSubmitted = $rowResultRecentSubmittedId['max(submitted_answer_id)'];

    // $recentSelectedId = "SELECT * from submitted_answer_tbl WHERE submitted_answer_id = $varSubmitted";
	// $resultRecentSelected = mysqli_query($conn,$recentSelectedId);
    // $rowResultRecentSelected = mysqli_fetch_assoc($resultRecentSelected);

    // $recentAnswer = $rowResultRecentSelected['submitted_answer_choice'];

    //echo 'Recent choice answer: '.$recentAnswer;

}

?>


    <div class="container" id="questioner">
        <div class="row">
            <div class="col-12 mt-5 border border-secondary rounded bg-white">
                <?php 
                if(isset($_GET['msg'])){
                    if($_GET['msg'] == "missinganswer"){
                        echo "<p class='alert alert-danger mt-2'>Answer Required!</p>";
                    }
                }?>
                
                <div class="container-fluid p-4">
                    <form action="../../includes/student.process.php" method="POST">
                        <div class="form-group mb-3">
                            <h3 class="form-label fw-bold">Question <?php echo $_SESSION['questionCount']; ?> of <?php echo $total_questions; ?></h3>
                            <h5 class="question fw-bold mx-4 mt-4"><?php echo $question['question_name']; ?> </h5>
                            <input type="hidden" name="questionId" value="<?php echo $quesionId; ?>">
                            <input type="hidden" name="task_id" value="<?php echo $taskId; ?>">
                        </div>
                        <div class="form-group mb-3">
                            <div class="mt-1">
                                <?php while($row = mysqli_fetch_assoc($choices)){ ?>
                                <div class="form-check d-flex mt-2 ms-4">
                                    <div class="container">
                                        <input type="radio" name="choice" value="<?php echo $row['choices_id'];?>">
                                        <span class="question-choice"><?php echo $row['choices_name']; ?></span>
                                    </div>
                                    <br>
                                </div>
                                <?php 
                                } 
                                
                                ?>
                            </div>
                           
                        </div>
                        <div class="text-center">
                            <input class="btn btn-secondary" type="submit" name="submitAnswerCancel" value="Cancel">
                            <input class="btn btn-primary" type="submit" name="nextQuestion" value="Next">
                        </div>
                    </form>
                   
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>

</html>