<?php include('assets/header.view.php')?>

    <?php 
    if(!isset($_GET['studentId'])) {
        //header ("location: teacher.subject.php");
        $_SESSION['msg'] = "missingparameter";
    }
    #quesries
    $sectionId = $_SESSION['section_id'];
    $subjectId = $_SESSION['subjectId'];
    $teacherId = $_SESSION['teacher_id'];
    $studentId = $_GET['studentId'];
    
    $currentSubjectData = teacherSubjectExist2($conn, $subjectId, $sectionId, $teacherId);
    
    $studentData = getStudent($conn, $studentId);
    
    //display Task List
    $resultTaskList =  getTasks($conn, $subjectId, $teacherId);
    
    ?>

    <!--Body content -->

    <div class="container-fluid " id="content">

        <div class="row overflow-hidden">

            <!-- Left Side Nav global-->
            <div class="col-md-2 " id="sideNav">
                <?php include('assets/sidebar.view.php') ?>
            </div>

            <!-- Main Content -->
            <div class="col-md-8 py-4 main-content" id="teacherSubjectContent">
                <div>
                    <?php
                        if(isset($_SESSION['msg'])){
                            if($_SESSION['msg'] == "missingparameter"){
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            Theres something wrong on url, please try again!
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
                            }
                            unset($_SESSION['msg']);
                        }
                    ?>
                    <div class="custom-border">
                        <div class="mx-3">
                            <a href="teacher.subject.php">back</a>
                            <div class="d-flex align-items-end mt-3">
                                <h3 class="mb-0"><?php echo $currentSubjectData['subject_list_name']?></h3>
                                <p class="text-muted mb-0 ms-2"><?php echo $currentSubjectData['grade_level_name'].' - '.$currentSubjectData['section_name']?></p>
                            </div>
        
                        </div>
                        <div class="card ">
                            <div class="card-header d-flex justify-content-between">
                                <div class="d-flex align-items-end">
                                    <p class="mb-0"><?php echo $studentData['student_name'];?></p>
                                </div>
                            </div>
                            <div class="card-body p-2">
                                <table class="table table-hover px-4 section-table">
                                    <thead class="">
                                        <tr>
                                        <!-- $resultTaskList -->
                                            <th scope="col">Task List</th>
                                            <th scope="col" class="text-center">Attempts</th>
                                            <th scope="col" class="text-center ">Status</th>
        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- <td><a href="studentTaskAttempts.php?studentId=<?php //echo 1?>">01 Quiz 1</a></td> -->
                                        <?php while ($rowTaskList = $resultTaskList->fetch_assoc()) : 
                                                $taskId = $rowTaskList['task_list_id'];
                                                $maxAttempt = getMaxAttempt2($conn, $taskId, $studentId);
                                        
                                        ?>
                                            <tr>
                                                <td scope="col"  class="">
                                                    <a href="studentTaskAttempts.php?studentId=<?=$studentId?>&&taskId=<?=$taskId?>"><?php echo $rowTaskList['task_name']; ?></a>
                                                </td>
                                                <td>
                                                    <?php
                                                        if($maxAttempt[0] == null){
                                                            echo "-";
                                                        } else if($maxAttempt[0] >= 0){
                                                            echo $maxAttempt[0];
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if($maxAttempt[0] == null){
                                                            echo "No submitted";
                                                        } else if($maxAttempt[0] >= 0){
                                                            echo "Submitted";

                                                        }
                                                    ?>
                                                
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                        
                                    </tbody>
                                </table>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>

    <!-- J-query -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/main.js"></script>


    <script>
    //Tabpane
    let tabHeader = document.getElementsByClassName("tab-header")[0];
    let tabIndicator = document.getElementsByClassName("tab-indicator")[0];
    let tabBody = document.getElementsByClassName("tab-body")[0];

    let tabsPane = tabHeader.getElementsByTagName("div");

    for (let i = 0; i < tabsPane.length; i++) {
        tabsPane[i].addEventListener("click", function() {
            tabHeader.getElementsByClassName("active")[0].classList.remove("active");
            tabsPane[i].classList.add("active");
            tabBody.getElementsByClassName("active")[0].classList.remove("active");
            tabBody.getElementsByClassName("tab-content")[i].classList.add("active");

            tabIndicator.style.left = `calc(calc(100% / 4) * ${i})`;
        });
    }

    //Tester
    function showTab() {
        tabHeader.getElementsByClassName("active")[0].classList.remove("active");
        tabsPane[1].classList.add("active");
        tabBody.getElementsByClassName("active")[0].classList.remove("active");
        tabBody.getElementsByTagName("div")[1].classList.add("active");

        tabIndicator.style.left = `calc(calc(100% / 4) * ${1})`;
    }


    //Module collapse
    let hideContent = document.querySelectorAll("#teacherSubjectContent .content-collapse");
    let customHideTable = document.querySelectorAll(".section-table-content");

    for (let i = 0; i < hideContent.length; i++) {
        hideContent[i].addEventListener("click", function() {
            customHideTable[i].classList.toggle("custom-hide");
        });
    }

    //Change task type (modal - create_tas_modals.php)
    </script>

</body>

</html>