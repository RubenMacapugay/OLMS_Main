<?php
include('assets/header.view.php');
ini_set('display_errors',1);
?>

<!-- create modal for adding Essay -->

<!-- modal end -->

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

                            if($_SESSION['msg'] == "essayContentCreated"){
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            Questioner/s has been Created!
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

                            if($_SESSION['msg'] == "essayContentTaken"){
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            Questioner/s has been taken!
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
                                
                            }
                            unset($_SESSION['msg']);
                        }
                    ?>

                    <form method='POST' action='../../includes/teacher.createtask.inc.php' id="createEssayForm">
                        <div class="row">

                            <div class="col-6">
                                <h2>Create Essay</h2>
                                <!-- Session Testers -->
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

                            <div class="col-12">
                                
                                <div class="card mb-3">
                                    <div>
                                        <h3 class="m-3">Instruction or Question</h3>
                                        <div class="mx-3">
                                            <textarea class="form-control" id="" rows="5" name="questionContent"></textarea>
                                        </div>
                                    </div> 
                                    
                                    <div class="m-3">
                                        <h3>Attach file</h3>
                                        <input style="width: 270px;" type="file" name="file_upload" id="fileInput" class="form-control" > 
                                    </div>
                                </div>
                               
                            </div>

                            <div class="col-12 text-center">
                                <button class="btn btn-secondary" name="cancelIdentification">cancel</button>
                                <button type="submit" class="btn btn-primary ms-3"
                                    name="createEssayContent" id="createEssayContentId">Create</button>
                                
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