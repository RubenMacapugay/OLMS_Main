<?php include('assets/header.view.php')?>

<!-- add score -->
<div class="modal fade" id="addScoreModal" tabindex="-1" aria-labelledby="addScore" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createModuleSection">Add task score</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../../includes/teacher.createtask.inc.php" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                  
                    <div class="form-group">
                        <label>Score</label>
                        <input type="hidden" id="student_IdInput" name="studentIdHidden"> 
                        <input type="hidden" id="task_IdInput" name="taskIdHidden">
                        <input type="hidden" id="submission_idInput" name="submissionId">
                        <input type="hidden" id="attempt_count_input" name="attemptCount">
                        <input type="number" name="submmisionScore" class="form-control" id="submmisionScore"
                            placeholder="enter score" required>
                    </div>
                    

                </div>

                <input type="hidden" grading>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="saveEssayScore"
                        class="btn btn-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="editScoreModal" tabindex="-1" aria-labelledby="editScore" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createModuleSection">Add task score</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../../includes/teacher.createtask.inc.php" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                  
                    <div class="form-group">
                        <label>Score</label>
                        <input type="hidden" id="student_IdInputEdit" name="studentIdHidden"> 
                        <input type="hidden" id="task_IdInputEdit" name="taskIdHidden">
                        <input type="hidden" id="submission_idInputEdit" name="submissionId">
                        <input type="hidden" id="attempt_count_inputEdit" name="attemptCount">
                        <input type="hidden" id="maxScoreEdit" name="maxScoreHidden">
                        <input type="number" name="submmisionScore" class="form-control" id="submmisionScoreEdit"
                            placeholder="enter score" required>
                    </div>
                    

                </div>

                <input type="hidden" grading>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="editEssayScore"
                        class="btn btn-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>

<?php 

// if(!isset($_GET['studentId']) || !isset($_GET['taskId']) || $_GET['taskId'] == "" || $_GET['studentId'] == "") {
//     header ("location: teacher.subject.php");
//     $_SESSION['msg'] = "missingparameter";
// }

$sectionId = $_SESSION['section_id'];
$subjectId = $_SESSION['subjectId'];
$teacherId = $_SESSION['teacher_id'];
$studentId = $_GET['studentId'];
$taskId = $_GET['taskId'];

if(isset($_GET['path'])) $path = $_GET['path'];
    
if(isset($_GET['tab'])) $tab = $_GET['tab'];


# get subject details
$maxAttempt = $_GET['attemptCount'];

$studentAnswer = getMaxScore($conn, $taskId, $maxAttempt, $studentId);

// get the task
$taskName = getCurrentTask($conn, $taskId);

?>
    <!--Body content -->

    <div class="container-fluid " id="content">

        <div class="row overflow-hidden">

            <!-- Left Side Nav global-->
            <div class="col-md-2 " id="sideNav">
                <?php include('assets/sidebar.view.php') ?>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 py-4 main-content" id="teacherSubjectContent">
                <div>
                <!-- Session message -->
                <?php
	                if(isset($_SESSION['msg'])){
	                
	                    if($_SESSION['msg'] == "taskgraded"){ 
							echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> 
									Task has been graded.
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>';
						}
						
						if($_SESSION['msg'] == "taskgradeedited"){ 
							echo '<div class="alert alert-success alert-dismissible fade show" role="alert"> 
									Task grade has been updated.
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>';
						}
						
						if($_SESSION['msg'] == "scorelimitreached"){ 
							echo '<div class="alert alert-danger alert-dismissible fade show" role="alert"> 
									Task score must not be greater than max score.
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>';
						}
	                }
	                
	                unset($_SESSION['msg']);
                ?>
                    <div class="card">
                        <div class="card-body">
                            <?php
                                
                                if(true){
									echo '<a href="studentTaskAttempts.php?studentId='.$studentId.'&&taskId='.$taskId.'&&tab='.$tab.'">back</a>';
                                }
                            ?>
                            <h3 class="mt-3">Displaying submitted task</h3>
                            
                            <div class="container my-4 custom-border p-4">
                                <h2><?php echo $taskName['task_name'];?> result</h2>
                                <?php
                                    if ($studentAnswer['score'] == ""){
										// /$submissionId = $submissionIdRowResult['submission_id'];
	                                    ?>  
												<span class="d-none attempt_count" ><?=$maxAttempt?></span>
												<span class="d-none student_id" ><?=$studentId?></span>
												<span class="d-none task_id" ><?=$taskId?></span>
												<span class="d-none submission_id" ><?=$studentAnswer['submission_id']?></span>
												<span class="d-none max_score" ><?=$taskName['max_score']?></span>
												<button class="btn btn-primary addScore" id="">add score</button>       
	                                        
	                                    <?php
                                    } else if ($studentAnswer['score'] >= 0 && $taskName['sub_type'] == 3){
									?>
                                        <h4 class="d-inline-block">Score is <strong><?php echo $studentAnswer['score'] .' / '.$taskName['max_score']; ?></strong> </h4>
                                        <span class="d-none attempt_count" ><?=$maxAttempt?></span>
										<span class="d-none student_id" ><?=$studentId?></span>
										<span class="d-none task_id" ><?=$taskId?></span>
										<span class="d-none submission_id" ><?=$studentAnswer['submission_id']?></span>
										<span class="d-none max_score" ><?=$taskName['max_score']?></span>
										<span class="d-none task_score" ><?=$studentAnswer['score']?></span>
                                        
                                        <i class="fa-regular fa-pen-to-square text-primary editScore ms-2" type="button"></i>
                                        <p>Task has been graded.</p>        
                                    <?php
                                        
                                    } else if ($studentAnswer['score'] >= 0){
										?>
											<h4>Score is <strong><?php echo $studentAnswer['score'] .' / '.$taskName['question_item']; ?></strong> </h4>
											<p>Task has been graded.</p>        
										<?php
											
									}
									
									
                                ?>
                                
                            
                            
                            	<div class="mt-5">
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
                            
                            				if($taskResult['sub_type'] == 10){
                            					echo 'Enumiration';
                            				}
                            
                            				if($taskResult['sub_type'] == 2){
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
                            
                            				if($taskResult['sub_type'] == 3){
												$submittedAnswers = getSubmittedAnswerRow($conn, $taskId, $studentId, $maxAttempt);
											
												//Query for the Question - goods na
												while($submittedAnswewrRow = mysqli_fetch_assoc($submittedAnswers)){
                            						
													$submittedAnswer = $submittedAnswewrRow['submitted_answer_key'];
	                            					$questionId = $submittedAnswewrRow['fk_question_id'];
	                            					$currentQuestion = getQuestionById($conn, $questionId); 
													
	                            				  
	                            				    ?>
                            				            <div class="custom-border mb-3 px-4">
							                                <div class="mb-3">
							                                    <h4 class="mb-2">Questioner</h4>
							                                    <pre class="ms-2 custom-border" style="font-style: inherit; color:#6c757d; font-size: .9rem; text-align: left;"><?php echo $currentQuestion['question_name']; ?></pre>
							                                </div>
							                                
							                                <div class="mb-3">
							                                    <h4>Additional file</h4>
							                                    <a class="ms-2" href="<?php echo '../'.$currentQuestion['question_filepath'].'/'.$currentQuestion['question_filename']; ?>" download><?php echo $currentQuestion['question_filename']; ?></a>
							                                   
							                                </div>
							                            </div>
							                            
						                                <div class="custom-border mb-3 px-4">
							                                <div>   
							                                    <div class="mb-3 ">
							                                        <h4>Student's answer</h4>
							                                        <pre class="ms-2 custom-border"  style="font-style: inherit; color:#6c757d; font-size: .9rem; text-align: left;" id="" rows="5" name="questionAnswer"><?=$submittedAnswer?></pre>
							                                    </div>
							                                </div> 
							                                
							                                <div class=" mb-3">
							                                    <h4>Submitted file</h4>
																<a class="ms-2" href="<?php echo '../'.$submittedAnswewrRow['submitted_filepath'].'/'.$submittedAnswewrRow['submitted_filename']; ?>" download><?php echo $submittedAnswewrRow['submitted_filename']; ?></a>

							                                </div>
							                            </div>
                            				        <?php

                            				    }
                            				}
                            
                            			}
                            
                            
                            
                            
                            
                            
                            			// unset($_SESSION['score']); 
                            			// unset($_SESSION['questionCounter']);
                            			
                            			// // used in multiple choice
                            			unset($_SESSION['questionCount']);
                            		?>
                            	</div>
                            	
                            	<br>
                                <a class="btn btn-primary" href="studentTaskAttempts.php?studentId=<?=$studentId?>&&taskId=<?=$taskId?>">Close</a>
                            
                            
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>

           

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
    
    

    <!-- J-query -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/main.js"></script>
	<script>
	    $(document).ready(function (){
	        $(document).on('click', '.addScore', function(){
	        
	            var submmistionId = $(this).closest('div').find('.submission_id').text();
	            var studentId = $(this).closest('div').find('.student_id').text();
	            var taskId = $(this).closest('div').find('.task_id').text();
	            var attemptCount = $(this).closest('div').find('.attempt_count').text();
	            // alert(studentId + " " + taskId);
	            // Opening the Modal
	            $('#addScoreModal').modal('show');
	            // Displaying data to fields
	            $('#submission_idInput').val(submmistionId);
	            $('#student_IdInput').val(studentId);
	            $('#task_IdInput').val(taskId);
	            $('#attempt_count_input').val(attemptCount);
	            
	        });
	    });
	    
	    $(document).ready(function (){
	        $(document).on('click', '.editScore', function(){
	        
	            var submmistionId = $(this).closest('div').find('.submission_id').text();
	            var studentId = $(this).closest('div').find('.student_id').text();
	            var taskId = $(this).closest('div').find('.task_id').text();
	            var attemptCount = $(this).closest('div').find('.attempt_count').text(); 
	            var taskScore = $(this).closest('div').find('.task_score').text();
	            var maxScore = $(this).closest('div').find('.max_score').text();
	            
	            alert(submmistionId);
	            // alert(studentId + " " + taskId);
	            // Opening the Modal
	            $('#editScoreModal').modal('show');
	            // Displaying data to fields
	            $('#submission_idInputEdit').val(submmistionId);
	            $('#student_IdInputEdit').val(studentId);
	            $('#task_IdInputEdit').val(taskId);
	            $('#attempt_count_inputEdit').val(attemptCount);
	            $('#submmisionScoreEdit').val(taskScore);
	            $('#maxScoreEdit').val(maxScore);
	            
	        });
	    });
	    
	    $('#submmisionScore').keyup(function(e){
		  if (/\D/g.test(this.value)){
		    // Filter non-digits from input value.
		    this.value = this.value.replace(/\D/g, '');
		  }
		});
		
    </script>
</body>

</html>