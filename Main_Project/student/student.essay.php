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

}


// getting the first question
if(isset($_SESSION['questionStart'])){
    $quesionId = $_GET['currentQuestion'];
}

?>

    <!--Body content -->
    <div class="container border border-secondary rounded mt-5">
        <div class="row">
            <div class="col-12">

                <div class="container-fluid p-4">
                    <h3 class="form-label fw-bold ms-2 mb-3">Essay </h3>
                    <form action="../../includes/student.process.php" method="POST" enctype="multipart/form-data">
                        <div class="row mx-0">
                        
                            <input type="hidden" name="questionId" value="<?php echo $_GET['questionId'];?>">
                            <input type="hidden" name="taskId" value="<?php echo $_GET['taskId'];?>">
                            
                            <div class="custom-border mb-3 px-4">
                                <div class="mb-3">
                                    <h4 class="mb-2">Questioner</h4>
                                    <pre class="ms-2" style="font-style: inherit; color:#6c757d; font-size: .9rem; text-align: left;"><?php echo $question['question_name']; ?></pre>
                                </div>
                                
                                <div class="mb-3">
                                    <h4>Additional file</h4>
                                    <a class="ms-2" href="<?php echo '../'.$question['question_filepath'].'/'.$question['question_filename']; ?>" download><?php echo $question['question_filename']; ?></a>
                                   
                                </div>
                            </div>
                            
                            <div class="custom-border mb-3 px-4">
                                <div>   
                                    <div class="mb-3 ">
                                        <h4>Your answer here</h4>
                                        <textarea class="form-control" id="" rows="5" name="questionAnswer"></textarea>
                                    </div>
                                </div> 
                                
                                <div class=" mb-3">
                                    <h4>Attach file</h4>
                                    <input style="width: 270px;" type="file" name="file_upload" id="fileInput" class="form-control" > 
                                </div>
                            </div>

    
                            <div class="text-center">
                                <input class="btn btn-secondary" type="submit" name="submitAnswerCancel" value="Cancel">
                                <input class="btn btn-primary" type="submit" name="submitEssayQuestion" value="Submit">
                            </div>
                            
                        </div>
                    </form>
                </div>
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