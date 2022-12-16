<?php
include('assets/header.view.php')
?>
<!--Body content -->
<div class="container-fluid " id="content">
    <div class="row overflow-hidden">

        <!-- Left Side Nav global-->
        <div class="col-md-2 " id="sideNav">
            <?php include('assets/sidebar.view.php') ?>
        </div>

        <!-- Main Content -->


        <div class="col-md-8 mt-4">
            <div class="container-fluid save-task">
                <div class="custom-border">
                    <div class="text-center mb-3">

                        <?php if(isset($_GET['msg'])){ 
                            if($_GET['msg'] == 'identification'){ ?>
                            <h3>Do you want to save the task?</h3>
                            <form method='POST' action='../../includes/teacher.createtask.inc.php'>
                                <button type="submit" name="cancelIdenticationTaskSave" class="btn btn-secondary ms-3"
                                    id="cancelTaskBtn">Cancel</button>
                                <button type="submit" name="identificationtaskproceed" class="btn btn-primary ms-3"
                                    id="taskProceedBtn">Proceed</button>
                            </form>

                        <?php } else if($_GET['msg'] == 'trueorfalse'){ ?>

                            <h3>Do you want to save the task?</h3>

                            <form method='POST' action='../../includes/teacher.createtask.inc.php'>
                                <button type="submit" name="cancelTrueOrFalseTaskSave" class="btn btn-secondary ms-3"
                                    id="cancelTaskBtn">Cancel</button>
                                <button type="submit" name="taskProceed" class="btn btn-primary ms-3"
                                    id="taskProceedBtn">Proceed</button>
                            </form>
                        <?php } else if($_GET['msg'] == 'essay'){ ?>
                            <h3>Do you want to save the (Essay)task?</h3>

                            <form method='POST' action='../../includes/teacher.createtask.inc.php'>
                                <button type="submit" name="cancelEssayTaskSave" class="btn btn-secondary ms-3"
                                    id="cancelTaskBtn">Cancel</button>
                                <button type="submit" name="taskProceed" class="btn btn-primary ms-3"
                                    id="taskProceedBtn">Proceed</button>
                            </form>
                        <?php } else { ?>

                        <h3>Do you want to save the task?</h3>
                        <form method='POST' action='../../includes/teacher.createtask.inc.php'>
                            <button type="submit" name="cancelTaskSave" class="btn btn-secondary ms-3"
                                id="cancelTaskBtn">Cancel</button>
                            <button type="submit" name="taskProceed" class="btn btn-primary ms-3"
                                id="taskProceedBtn">Proceed</button>
                        </form>

                        <?php } } ?>

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

</body>

</html>