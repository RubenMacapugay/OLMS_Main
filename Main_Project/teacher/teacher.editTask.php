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
                                                            <button class="btn edit_question p-0" data-id="<?php echo $row['question_id']?>" type="button"><i class="fa-regular fa-pen-to-square text-primary"></i></button>
                                                            <button class="btn remove_question p-0" data-id="<?php echo $row['question_id']?>" type="button"><i class="fa-solid fa-trash text-danger"></i></button>
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

<script>

    //Module collapse
    let hideContent = document.querySelectorAll("#teacherSubjectContent .content-collapse");
    let customHideTable = document.querySelectorAll(".section-table-content");

    for (let i = 0; i < hideContent.length; i++) {
        hideContent[i].addEventListener("click", function() {
            customHideTable[i].classList.toggle("custom-hide");
        });
    }



    //Change task type (modal - create_tas_modals.php)
    var lookup = {
        '1': ['No subtask'],
        '2': ['Multiple Choice', 'Identification', 'Enumiration', 'Essay'],
        '3': ['Multiple Choice', 'Identification', 'Enumiration'],
        '4': ['Multiple Choice', 'Identification', 'Enumiration'],
    };

    // When an option is changed, search the above for matching choices
    $('#options').on('change', function() {
        // Set selected option as variable
        var selectValue = $(this).val();

        // Empty the target field
        $('#choices').empty();

        // For each chocie in the selected option
        for (i = 0; i < lookup[selectValue].length; i++) {
            // Output choice in the target field
            $('#choices').append("<option value='" + lookup[selectValue][i] + "'>" + lookup[selectValue][i] +
                "</option>");
        }
    });

    // Change update and create button for modalCreateUpdateGradingSection
    $('#btnFirstGrading').on('click', function(e){
        createDisplay();
    });

    $('#modalCreateUpdateGradingSection').on('click', function(e){
        updateDisplay();
    });

    //  create button
    function createDisplay(){
        $('#modalUpdateGradingSection').hide();
        $('#modalCreateGradingSection').show();
    }

    // update button
    function updateDisplay(){
        $('#modalCreateGradingSection').hide();
        $('#modalUpdateGradingSection').show();
    }

</script>

<script type="text/javascript">

    // script for updating  module_section
    $(document).ready(function (){
        $(document).on('click', '.editGradingModuleSection', function(){
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

    // script for update task - updateModalTask
    $(document).ready(function (){
        $(document).on('click', '.updateTableTaskBtn', function(){
            var moduleGGTaskId = $(this).closest('div').find('#taskId_DeleteEdit').text();
            $('#updateModalTask').modal('show'); // load update modal
            $('.updateTaskId').val(moduleGGTaskId);
            $('#gg').val(moduleGGTaskId);
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

<script type="text/javascript">
    $(document).ready(function (){
        $(document).on('click', '#btnFirstGrading', function(){
            var id = 1;

            $('#moduleSectionGradingId').val(id);
        });
        $(document).on('click', '#btnSecondGrading', function(){
            var id = 2;

            $('#moduleSectionGradingId').val(id);
        });
        $(document).on('click', '#btnThirdGrading', function(){
            var id = 3;

            $('#moduleSectionGradingId').val(id);
        });
        $(document).on('click', '#btnFourthGrading', function(){
            var id = 4;

            $('#moduleSectionGradingId').val(id);
        });
    });
</script>

</body>

</html>