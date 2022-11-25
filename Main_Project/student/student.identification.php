<?php include('assets../header.view.php') ?>

<?php 
if(isset($_GET['taskId'])){
    //Set the question number
    $taskId = $_GET['taskId'];
    $quesionId = $_GET['questionId'];

    //Query for the Question - goods na
    $queryQuestion = "SELECT * FROM question_tbl where fk_task_list_id=$taskId and question_id=$quesionId";

	// saving the question
	$result = mysqli_query($conn,$queryQuestion);
	$question = mysqli_fetch_assoc($result); 

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
                            <div class="d-flex mx-4 mt-4 align-items-center">
                                <input type="text" class="form-control w-25" name="identificationanswer" id="identificationAnswerId">
                                <h6 class="question ms-3 p-0 mb-0"><?php echo $question['question_name']; ?> </h6>
                            </div>
                            <input type="hidden" name="questionId" value="<?php echo $quesionId; ?>">
                            <input type="hidden" name="task_id" value="<?php echo $taskId; ?>">
                        </div>
                       
                        <div class="text-center mb-3">
                            <input class="btn btn-secondary" type="submit" name="submitAnswerCancel" value="Cancel">
                            <input class="btn btn-primary" type="submit" name="nextIdentificationQuestion" value="Next">
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