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
            <div class="container-fluid create-enumeration">
                <div class="row my-4">
                    <div class="col-12 mx-auto">
                        <div class="custom-border shadow">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Create Task Title</h5>
                                <div class="d-flex w-50 align-items-center questioner-cont">
                                    <label for="questionList" class="question-label">Question List: </label>
                                    <select class='form-select' name='questionList' id='questionList'
                                        aria-label='select answer' id='answerSelector'
                                        onchange='fetchEnumiration(this)'>
                                        <option disabled>Select</option>
                                        <?php
                                            $id = $_SESSION["task_id"];
                                            $sqli = "SELECT * FROM question_tbl where fk_task_list_id = {$id}";
                                            $result = mysqli_query($conn, $sqli);
                                            while($row = mysqli_fetch_array($result)) {
                                                $question = $row['question_id'];
                                                // pass object to js
                                                $newRow = json_encode($row);
                                                  $newRow;
                                                //echo '<option value='.htmlspecialchars($newRow).'>' .$row['question_name']. '</option>';
                                            } 
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="">
                                <div id="show_alert"></div>

                                <form action="teacher.createEnumeration.inc.php" method="POST" id="add_form">
                                    <div class="mb-3">
                                        <h5>Question <?php  echo $_SESSION["questionCounter"] ?></h5>
                                        <input type="text" class="form-control" name="questioner" id="question-input">
                                    </div>
                                    <div id="show_item">
                                        <div class="row">
                                            <div class="class col-md-4 mb-3">
                                                <!-- storing multiple data in single name -->
                                                <input type="text" name="answer_key[]" class="form-control"
                                                    placeholder="Answer key" required>
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <button class="btn btn-success add_item_btn">Add</button>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-secondary" id="cancelEnumerationQuestionAnswerBtn"
                                            type="submit" name="cancelEnumeration">Cancel</button>
                                        <button class="btn btn-primary" id="nextEnumerationQuestionAnswerBtn"
                                            type="submit" name="addEnumeration">Next</button>
                                        <button class="btn btn-primary" id="updateEnumerationQuestionAnswerBtn"
                                            type="submit" name="updateEnumeration">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
<script src="createEnumarationAnswer.js"></script>
<script>
document.getElementById('nextEnumerationQuestionAnswerBtn').style.display = "inline-block";
document.getElementById('updateEnumerationQuestionAnswerBtn').style.display = "none";
</script>
<script>

</script>

</body>

</html>