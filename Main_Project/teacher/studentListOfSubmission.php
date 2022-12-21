<?php include('assets/header.view.php')?>

    <?php 
    if(!isset($_GET['studentId'])) {
        //header ("location: teacher.subject.php");
        $_SESSION['msg'] = "";
    }
    #quesries
    $sectionId = $_SESSION['section_id'];
    $subjectId = $_SESSION['subjectId'];
    $teacherId = $_SESSION['teacher_id'];
    $taskId = $_GET['taskListId'];
    
    $currentSubjectData = teacherSubjectExist2($conn, $subjectId, $sectionId, $teacherId);
    
    //display Task List
    $resultStudentSubmissionList = getStudentSubnmissionList($conn, $taskId);
    
    if(isset($_GET['path'])) $path = $_GET['path'];
    
    if(isset($_GET['tab'])) $tab = $_GET['tab'];
    
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
                            <?php 
                                if(isset($_GET['tab'])){
                                    if($tab == "tocheck"){
                                        echo '<a href="teacher.subject.php?tab='.$tab.'">back</a>';
                                    }
                                }
                            ?>
                            <div class="d-flex align-items-end mt-3">
                                <h3 class="mb-0"><?php echo $currentSubjectData['subject_list_name']?></h3>
                                <p class="text-muted mb-0 ms-2"><?php echo $currentSubjectData['grade_level_name'].' - '.$currentSubjectData['section_name']?></p>
                            </div>
        
                        </div>
                        <div class="card ">
                            <div class="card-header d-flex justify-content-between">
                                <div class="d-flex align-items-end">
                                    <p class="mb-0"></p>
                                </div>
                            </div>
                            <div class="card-body p-2">
                                <table class="table table-hover px-4 section-table">
                                    <thead class="">
                                        <tr>
                                        <!-- $resultTaskList -->
                                            <th scope="col">Task List</th>
                                            <th scope="col" style="min-width: 180px;" class="text-center">No. of not graded</th>
        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- <td><a href="studentTaskAttempts.php?studentId=<?php //echo 1?>">01 Quiz 1</a></td> -->
                                        <?php while ($rowStudentSubmission = $resultStudentSubmissionList->fetch_assoc()) : 
                                                $rowStudenId = $rowStudentSubmission['id'];
                                                
                                            ?>
                                                <tr>
                                                    <td scope="col"  class="">
                                                        <a href="studentTaskAttempts.php?studentId=<?=$rowStudenId?>&&taskId=<?=$taskId?>&&tab=<?=$tab?>"><?=$rowStudentSubmission['student'];?></a>
                                                    </td>
                                                    <td>
                                                        <?=$rowStudentSubmission['myCount'];?>
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



</body>

</html>