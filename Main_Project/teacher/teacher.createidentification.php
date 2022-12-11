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
            <div class="mt-4">
                <div class="custom-border">
                    <!-- Session Messages -->
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

                    <form method='POST' action='../../includes/teacher.createtask.inc.php' id="createQuestionForm">
                        <div class="row">

                            <div class="col-6">
                                <h5>Create Identification Question.</h5>
                                <!-- Session Testers -->
                                <p>Current question: <?php echo $_SESSION['questionCounter'] ?></p>
                                <?php 
                                    // echo'Question identification count: ' . $_SESSION["question_items"];
                                    // echo '<br>';
                                    // echo 'Task Name: '.$_SESSION["task_name"];
                                    // echo '<br>';
                                    // echo 'Task_list_ID: '.$_SESSION["task_id"];
                                    // echo '<br>';
                                    // if(isset($_SESSION['recentlyAdded'])){
                                    //     echo 'Recent question id: '.$_SESSION['recentlyAdded'];
                                    //     echo '<br>';
                                    // } else{
                                    //     echo 'not defined!';
                                    //     echo '<br>';
                                    // }
                                    // echo 'Recent question counter: '.$_SESSION['questionCounter'];
                                ?>

                                
                            </div>

                            <div class="col-6">

                                <div class="form-group mb-3">
                                    <select class="form-select" name="identificationSelect" aria-label="select answer"
                                        id="identificationSelect" onchange="fetchIdentification()">
                                        <option value="1">Select question</option>
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
                            <div class="col-12"> 

                                <div class="form-group mb-3 ps-0" id="taskcontentDiv">
                                    <label for="">Identification question: </label>
                                    <input class="form-control" type="hidden" name="identificationInputQuestionId"
                                        id="identificationInputQuestionId" >
                                    <input class="form-control" type="text" name="identificationInputQuestion"
                                        id="identificationInputQuestion">
                                </div>

                                <div class="form-group mb-3 ps-0" id="taskcontentDiv">
                                    <label for="">Identification answer: </label>
                                    <input class="form-control" type="hidden" name="identificationInputId"
                                        id="identificationInputId">
                                    <input class="form-control" type="text" name="identificationInputAnswer"
                                        id="identificationInputAnswer">
                                </div>


                            </div>

                            <div class="col-12 text-center">
                                <button class="btn btn-secondary" name="cancelIdentification">cancel</button>
                                <button type="submit" class="btn btn-primary ms-3"
                                    name="nextIdentification" id="nextBtn">next</button>
                                <button type="submit" name="updateIdentification" class="btn btn-primary ms-3"
                                    id="updateBtn">update</button>
                            </div>

                        </div>
                    </form>
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
document.getElementById('updateBtn').style.display = "none";
</script>

</body>

</html>