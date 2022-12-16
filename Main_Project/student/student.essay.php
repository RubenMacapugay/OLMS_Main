<?php include('assets../header.view.php') ?>

    <!--Body content -->

    <div class="container" id="content">

        <div class="row overflow-hidden">

            <!-- Left Side Nav global-->
            <!-- <div class="col-md-2 " id="sideNav">
                <?php //include('assets../sidebar.view.php') ?>
            </div> -->

            <!-- Main Content -->
            <div class="col-md-12 mt-5 border border-secondary rounded main-content d-flex justify-content-center" id="subjectMainContent">
                <?php 
                if(isset($_GET['msg'])){
                    if($_GET['msg'] == "missinganswer"){
                        echo "<p class='alert alert-danger mt-2'>Answer Required!</p>";
                    }
                }?>

                <div class="container-fluid p-4">
                    <h3 class="form-label fw-bold ms-2 mb-3">Essay </h3>
                    <form action="../../includes/student.process.php" method="POST">
                        <div class="row mx-0">
                            <input type="hidden" name="questionId">
                            <input type="hidden" name="taskId">
                            <div class="mb-5">
                                <h4>Questioner</h4>
                                <pre class="ms-3" style="font-style: inherit; font-size: .9rem; text-align: left;">This is question</pre>
                            </div>

                            <div>
                                <div class="mb-3">
                                    <h4>Your answer here</h4>
                                    <textarea class="form-control ms-3" id="" rows="5" name="questionContent"></textarea>
                                </div>
                            </div> 
                            
                            <div class="mb-3 ms-3">
                                <h4>Attach file</h4>
                                <input style="width: 270px;" type="file" name="file_upload" id="fileInput" class="form-control" > 
                            </div>
    
                            <div class="text-center">
                                <input class="btn btn-secondary" type="submit" name="submitAnswerCancel" value="Cancel">
                                <input class="btn btn-primary" type="submit" name="nextQuestion" value="Submit">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Banner -->
            <!-- <div class="custom-border col-md-2 mt-4" id="rightBanner">
               <?php //include('assets/banner.view.php')?>
            </div> -->

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