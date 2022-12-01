<?php include('assets../header.view.php');

//getting the score from database
$taskId = $_GET['taskId'];
$studentId = $_SESSION["student_id"];

$maxAttempt = getMaxAttempt($conn, $taskId, $studentId);
$studentAnswer = getScore($conn, $taskId, $maxAttempt, $studentId);
// get the task
$taskName = getCurrentTask($conn, $taskId);
?>

<div class="container my-4 custom-border p-4">
    <h2><?php echo $taskName['task_name'];?> result</h2>
    <h4>Your score is <strong><?php echo $studentAnswer['score']; ?></strong> </h4>
    <p>You have completed this test succesfully.</p>


	<div class="mt-5 px-5">
		<?php 
			// check what type of task
			if(isset($_GET['taskId'])){
				$taskId = $_GET['taskId'];
				$taskResult = getCurrentTask($conn, $taskId);

				// get the questions , $studentId
				// get the answers

				// Multiple Choice
				if($taskResult['sub_type'] == 0){
					# get the data from submission_answer_tbl
					$submittedAnswers = getSubmittedAnswerRow($conn, $taskId, $studentId, $maxAttempt);

					while($submittedAnswewrRow = mysqli_fetch_assoc($submittedAnswers)){
						
						$questionId = $submittedAnswewrRow['fk_question_id'];
						$currentQuestion = getQuestionById($conn, $questionId); 
						?>
							<div class="form-group mb-4">
								<h6 class="question fw-bold"><?php echo $currentQuestion['question_name']; ?></h6>
								
								<?php
								$choices = getChoicesRow($conn, $questionId);

								while($choicesRow = mysqli_fetch_assoc($choices)){
								// get the correct answer from choices table
									$choicesId = $choicesRow['choices_id'];
									$submittedAnswerId = $submittedAnswewrRow['submitted_answer_choice'];
									?>
									<div class="form-check d-flex mt-2">
										<div class="container">
											<input type="radio" disabled <?php if ($choicesId == $submittedAnswerId) echo 'checked';?>>
											<?php 
												echo $choicesRow['choices_name']; 
												if($choicesRow['choices_id'] == $submittedAnswewrRow['submitted_answer_choice']){
													if($choicesRow['is_correct'] == 1)
														echo "<span class='ms-2 text-success fw-semibold'> Correct answer </span>";
													else
														echo "<span class='ms-2 text-danger fw-semibold'> Wrong answer</span>";
												}
											?>
										</div>
										<br>
									</div>
								<?php
								}
								?>
							</div>
						<?php
					}
					
				}

				if($taskResult['sub_type'] == 1){
					//echo 'Identification';
					# get the data from submission_answer_tbl
					$submittedAnswers = getSubmittedAnswerRow($conn, $taskId, $studentId, $maxAttempt);

					while($submittedAnswewrRow = mysqli_fetch_assoc($submittedAnswers)){
						$submittedAnswer = $submittedAnswewrRow['submitted_answer_key'];
						$questionId = $submittedAnswewrRow['fk_question_id'];
						$currentQuestion = getQuestionById($conn, $questionId); 

						// get the correct answer
						$correctAnswerRow = getCorrectAnswerIdentification($conn, $questionId);
						$correctAnswerKey = $correctAnswerRow['answer_key'];
						?>
						<div class="form-group">
							<p class="question mb-0"><?php echo $currentQuestion['question_name']; ?></p>
							<?php
							if($submittedAnswer == $correctAnswerKey){
								echo "<p class='ms-3 mb-3'> Answer: $submittedAnswer <span class='ms-2 text-success fw-semibold'>Correct answer</span></p>";
							} else{
								echo "<p class='ms-3 mb-3'> Answer: $submittedAnswer <span class='ms-2 text-danger fw-semibold'>Wrong answer</span></p>";
							}
							?>
						</div>	 
						<?php
					}
				}

				if($taskResult['sub_type'] == 2){
					echo 'Enumiration';
				}

				if($taskResult['sub_type'] == 3){
					//echo 'True or False';
					# get the data from submission_answer_tbl
					$submittedAnswers = getSubmittedAnswerRow($conn, $taskId, $studentId, $maxAttempt);

					while($submittedAnswewrRow = mysqli_fetch_assoc($submittedAnswers)){
						
						$submittedAnswer = $submittedAnswewrRow['submitted_answer_key'];
						$questionId = $submittedAnswewrRow['fk_question_id'];
						$currentQuestion = getQuestionById($conn, $questionId); 

						// get the correct answer
						$correctAnswerRow = getCorrectAnswerIdentification($conn, $questionId);
						$correctAnswerKey = $correctAnswerRow['answer_key'];
						?>
						<div class="form-group">
							<h6 class="question fw-bold"><?php echo $currentQuestion['question_name']; ?></h6>
							<?php
							if($submittedAnswer == $correctAnswerKey){
								echo "<p class='ms-4 mb-3'> Answer: $submittedAnswer <span class='ms-2 text-success fw-semibold'>Correct answer</span></p>";
							} else{
								echo "<p class='ms-4 mb-3'> Answer: $submittedAnswer <span class='ms-2 text-danger fw-semibold'>Wrong answer</span></p>";
							}
							?>
						</div>	 
						<?php
					}
				}

				if($taskResult['sub_type'] == 4){
					echo 'Essay';
				}

			}






			// unset($_SESSION['score']); 
			// unset($_SESSION['questionCounter']);
			
			// // used in multiple choice
			unset($_SESSION['questionCount']);
		?>
	</div>
	
	<br>
    <a class="btn btn-primary" href="student.subjects.php">Close</a>


</div>
</body>

</html>