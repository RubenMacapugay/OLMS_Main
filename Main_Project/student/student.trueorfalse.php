<?php include('assets../header.view.php') ?>

<?php 
if(isset($_GET['taskId'])){
    //Set the question number
    $taskId = $_GET['taskId'];
    $quesionId = $_GET['questionId'];

    //Query for the Question - goods na
    $queryQuestion = "SELECT * FROM question_tbl where fk_task_list_id=$taskId and question_id=$quesionId";

	// Getting the question
	$resultQuestion = mysqli_query($conn,$queryQuestion);
	$questionTrueOrFalse = mysqli_fetch_assoc($resultQuestion); 

    // Getting the answer
    $queryAnswer = "SELECT * FROM answer_tbl WHERE fk_question_id = $quesionId"; 
	$resultAnswer = mysqli_query($conn,$queryAnswer);
	$answerTrueOrFalse = mysqli_fetch_assoc($resultAnswer);

	// get total questions
	$query = "SELECT * FROM question_tbl where fk_task_list_id=$taskId";
	$total_questions = mysqli_num_rows(mysqli_query($conn,$query));
}


// getting the first question
if(isset($_SESSION['questionStart'])){
    $quesionId = $_GET['currentQuestion'];
}

?>
<div class="container" id="questioner">
    <div class="row">
        <div class="col-12 mt-5 border border-secondary rounded bg-white">

            <div class="container-fluid p-4">
                <form action="../../includes/student.process.php" method="POST">
                    <div class="form-group mb-3">
                        <div class="form-group mb-3">
                            <h3 class="form-label fw-bold">Question <?php echo $_SESSION['questionCount']; ?> of <?php echo $total_questions; ?></h3>

                            <!-- Questioner -->
                            <h6 class="question fw-bold mx-4 mt-4"><?php echo $questionTrueOrFalse['question_name']; ?> </h6>
                            <input type="hidden" name="questionId" value="<?php echo $quesionId; ?>">
                            <input type="hidden" name="task_id" value="<?php echo $taskId; ?>">
                        </div>

                        <div class="form-group mb-3 ms-4">
                            <div class="form-check form-check-inline mt-2 ms-4">
                                <input class="form-check-input" name="choice" type="radio" id="radioTrue"
                                    value="True">
                                <label class="form-check-label" for="radioYes">
                                    True
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="choice" type="radio" id="radioFalse"
                                    value="False">
                                <label class="form-check-label" for="radioNo">
                                    False
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mb-3">
                        <button type="submit" name="submitAnswerCancel" class="btn btn-secondary ms-3"
                            id="cancelBtn">Cancel</button>
                        <button type="submit" name="nextTrueOrFalseQuestion" class="btn btn-primary ms-3"
                            id="nextBtn">next</button>
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