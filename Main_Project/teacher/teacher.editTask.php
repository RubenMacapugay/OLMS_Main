<?php 
include('assets/header.view.php');

// if(isset($_SESSION['subjectId'])){
//     echo 'Section: '.$_SESSION['section_id'];
// }else{
//     echo "failed";
// }
?>

<?php 
$subjectId = $_SESSION['subjectId'];
$teacherId = $_SESSION['teacher_id'];
$taskId = $_GET['taskId'];

$taskResult = taskExists($conn, $taskId);
?>  

<!-- Modal -->
<div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="update_btn" class="btn btn-primary">Update</button>
                </div>

            </form>

        </div>
    </div>
</div>
<!-- End of Modal -->

<!--Body content --> 
<div class="container-fluid " id="content">
    <div class="row overflow-hidden"> 
        
        <!-- Left Side Nav global-->
        <div class="col-md-2 " id="sideNav">
            <button class="btn btn-primary m-3" data-bs-toggle="modal" data-bs-target="#updateModalTask">Click me</button>
            <?php include('assets/sidebar.view.php') ?>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 py-4 main-content" id="teacherSubjectContent">
            <div class="row mx-0">

                <div class="container-fluid custom-border">
                    <div>
                        <h2><?php echo $taskResult['task_name'];?></h2>
                        
                        <button class="btn btn-primary my-2" id="new_question"><i class="fa fa-plus"></i> Add Question</button>
                    </div>
                    <div>
                        <div class="card col-md-12 " style="float:left">
                            <div class="card-header">
                                <h3>Questions</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover">
                                    <tbody>
                                    <?php
                                        $qry = $conn->query("SELECT * FROM question_tbl where fk_task_list_id = ".$_GET['taskId']);
                                        while($row=$qry->fetch_array()){
                                            ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex d-flex justify-content-between">
                                                        <p><?php echo $row['question_name'] ?></p>
                                                        <div>
                                                            <span class="d-none"><?php echo $row['question_id'];?></span>
                                                            <?php 
                                                                $taskType = $taskResult['sub_type'];
                                                                if ($taskType == "0"){
                                                                    // echo "Multiple choice";
                                                                    echo '<button class="btn edit_question_multipleChoice p-0" type="button"><i class="fa-regular fa-pen-to-square text-primary"></i></button>';
                                                                    echo '<button class="btn remove_question p-0" type="button"><i class="fa-solid fa-trash text-danger"></i></button>';
                                                                } else if($taskType == "1"){
                                                                    // echo "Identification";
                                                                    echo '<button class="btn edit_question_identification p-0" type="button"><i class="fa-regular fa-pen-to-square text-primary"></i></button>';
                                                                    echo '<button class="btn remove_question p-0" type="button"><i class="fa-solid fa-trash text-danger"></i></button>';
                                                                } else if($taskType == "2"){
                                                                    // echo "True or false";
                                                                    echo '<button class="btn edit_question_trueOrFalse p-0" type="button"><i class="fa-regular fa-pen-to-square text-primary"></i></button>';
                                                                    echo '<button class="btn remove_question p-0" type="button"><i class="fa-solid fa-trash text-danger"></i></button>';
                                                                } else if($taskType == "3"){
                                                                    // echo "Essay";
                                                                    echo '<button class="btn edit_question_essay p-0" type="button"><i class="fa-regular fa-pen-to-square text-primary"></i></button>';
                                                                    echo '<button class="btn remove_question p-0" type="button"><i class="fa-solid fa-trash text-danger"></i></button>';
                                                                }
                                                                echo "<br>";
                                                            ?>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>

                                </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
       
    </div>
</div>

<!-- Script Links Bootstrap/Jquery -->
<?php include('assets/scriptlink.view.php')?>


<script type="text/javascript">

    // script for updating question details - multiple choice
    $(document).ready(function (){
        $(document).on('click', '.edit_question_multipleChoice', function(){
            var moduleTaskGradingId = $(this).closest('div').find('#moduleGradingId').text();
            var moduleTaskId = $(this).closest('div').find('#moduleTaskId').text();
            var moduleTaskName = $(this).closest('div').find('#moduleTaskName').text();
            var moduleTaskDesc = $(this).closest('div').find('#moduleTaskDesc').text();

            $('#updateModuleSection').modal('show'); // load modal
            $('.updateModuleSectionGradingId').val(moduleTaskGradingId);
            $('.updateModuleSectionId').val(moduleTaskId);
            $('.updateModuleSectionName').val(moduleTaskName);
            $('.updateModuleSectinDesc').val(moduleTaskDesc);
        });
    });


    // script for deleting task - deleteTableTaskBtn
    $(document).ready(function (){
        $(document).on('click', '.deleteTableTaskBtn', function(){
            var moduleGGTaskId = $(this).closest('div').find('#taskId_DeleteEdit').text();
            $('#deleteModalTask').modal('show'); // load delete modal
            $('.deleteTaskId').val(moduleGGTaskId);
            $('#gg').val(moduleGGTaskId);
        });
    });
</script>



</body>

</html>