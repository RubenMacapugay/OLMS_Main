<?php  session_start(); ?> 
<?php  
include_once 'dbh.inc.php';
include_once 'teacher.function.inc.php';

date_default_timezone_set('Asia/Manila');
$date_Today = date("Y-m-d");
$current_time = date("h:i A");
// echo $date_Today.' '.$current_time;

# -----CREATE TASK BUTTONS----- #
    if(isset($_POST["createEssay"])){
        $subjectId = $_POST["subjectid"];
        $grading = $_POST["grading"];
        $moduleSection = $_POST["moduleSection2"];
        $taskname = $_POST["taskname"];
        $taskcontent = $_POST["taskcontent"];
        $tasktype = $_POST["tasktype"];
        $subtype = $_POST["subtype"];
        // $datecreated = $date_Today;
        $datecreated = $_POST["datecreated"];
        $datedeadline = $_POST["datedeadline"];
        //set time created
        // $time_created = $current_time;
        $time_created = $_POST["timecreated"];
        $time = $_POST["timelimit"];
        $maxscore = $_POST["maxscore"]; 
        $maxattempts = $_POST["maxattempts"];
        $allowlate = $_POST["submissionchoice"];
        $taskinstruction = $_POST["taskinstruction"];
        
        # Error handlers
        if(emptyEssayTask($grading, $moduleSection, $taskname, $tasktype, $subtype, $datecreated, $datedeadline, $time, $maxscore, $maxattempts, $allowlate) !== false){
            $_SESSION['msg'] = "emptyinput";
            header ("location: ../Main_Project/teacher/teacher.createtask.php?msg=emptyinput&&currentSubject=$subjectId");
            exit();
        }


        # check if task is taken
        if(tasknameExist($conn, $taskname, $subjectId) !== false){
            $_SESSION['msg'] = "tasknametaken";
            header ("location: ../Main_Project/teacher/teacher.createtask.php?msg=tasknametaken&&currentSubject=$subjectId");
            exit();
        }
        
        # create the task
        createNoQuestion($conn, $subjectId, $grading, $moduleSection, $taskname, $tasktype, $subtype, $datecreated, $datedeadline, $time_created, $time, $maxscore, $maxattempts, $allowlate, $taskinstruction);
        // $_SESSION['msg'] = "taskcompleted";
        // header ("location: ../Main_Project/teacher/assets/header.view.php");
        // header ("location: ../Main_Project/teacher/teacher.createtask.php?msg=taskessaycreated&&currentSubject=$subjectId");
        // exit();

        # getting task_list details
        $taskExists = tasknameExist($conn, $taskname, $subjectId);
        $_SESSION["task_name"] = $taskExists["task_name"];
        $_SESSION["task_id"] = $taskExists["task_list_id"];

        # redrecting to creating questions
        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.createEssay.php");
        exit();
    }
    
    // creating Multiple Choice
    if(isset($_POST["createQuestionTask"])){
        $grading = $_POST["grading"];
        $moduleSection = $_POST["moduleSection2"];
        $taskname = $_POST["taskname"];
        $questionitems = $_POST["questionitems"];
        $tasktype = $_POST["tasktype"];
        $subtype = $_POST["subtype"];
        // $datecreated = $_POST["datecreated"];
        // $datecreated = $date_Today;
        $datecreated = $_POST["datecreated"];
        $datedeadline = $_POST["datedeadline"];
        // time created
        // $time_created = $current_time;
        $time_created = $_POST["timecreated"];
        $time = $_POST["timelimit"];
        $maxattempts = $_POST["maxattempts"];
        $allowlate = $_POST["submissionchoice"]; 

        $subjectId = $_POST["subjectid"];
        $_SESSION["subjectId"] = $_POST["subjectid"];
        $taskinstruction = $_POST["taskinstruction"];

        if(isset($_SESSION["subjectId"])){
            $subjectId = $_SESSION["subjectId"];
        }else{
            $subjectId = $_POST["subjectid"];
        }

        # Error handlers
        if(emptyWithAnswerTask($grading, $moduleSection, $taskname, $questionitems, $tasktype, $subtype, $datecreated, $datedeadline, $time, $maxattempts, $allowlate) !== false){ # comeback
            $_SESSION['msg'] = "emptyinput";
            header ("location: ../Main_Project/teacher/teacher.createtask.php?msg=emptyinput&&currentSubject=$subjectId");
            exit();
        } 

        # check if task is taken
        if(tasknameExist($conn, $taskname, $subjectId) !== false){
            $_SESSION['msg'] = "tasknametaken";
            header ("location: ../Main_Project/teacher/teacher.createtask.php?msg=tasknametaken&&currentSubject=$subjectId");
            exit();
        }

        # create the task - add max score
        createTask($conn, $subjectId, $grading, $moduleSection,  $taskname, $questionitems, $tasktype, $subtype, $datecreated, $datedeadline, $time_created, $time, $maxattempts, $allowlate, $taskinstruction);
        
        # getting task_list details
        $taskExists = tasknameExist($conn, $taskname, $subjectId);
        $_SESSION["question_items"] = $questionitems; // ito
        $_SESSION["task_name"] = $taskExists["task_name"];
        $_SESSION["task_id"] = $taskExists["task_list_id"];
        $_SESSION["questionCounter"] = 1;
        $taskid = $taskExists["task_list_id"];

        # redrecting to creating questions
        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.createquestioner.php");
        exit();

    }

    // creating identification
    if(isset($_POST["createIdentificationTask"])){
        $grading = $_POST["grading"];
        $moduleSection = $_POST["moduleSection2"];
        $taskname = $_POST["taskname"];
        $questionitems = $_POST["questionitems"]; 
        $tasktype = $_POST["tasktype"];
        $subtype = $_POST["subtype"];
        // $datecreated = $_POST["datecreated"];
        // $datecreated = $date_Today;
        $datecreated = $_POST["datecreated"];
        $datedeadline = $_POST["datedeadline"];
        // time created
        // $time_created = $current_time;
        $time_created = $_POST["timecreated"];
        $time = $_POST["timelimit"];
        // $maxscore = $_POST["maxscore"]; THERES NO MAX SCORE
        $maxattempts = $_POST["maxattempts"];
        $allowlate = $_POST["submissionchoice"]; 
        $taskinstruction = $_POST["taskinstruction"];

        $subjectId = $_POST["subjectid"];
        $_SESSION["subjectId"] = $_POST["subjectid"];
        if(isset($_SESSION["subjectId"])){
            $subjectId = $_SESSION["subjectId"];
        }else{
            $subjectId = $_POST["subjectid"];
        }

        # Error handlers
        if(emptyWithAnswerTask($grading, $moduleSection, $taskname, $questionitems, $tasktype, $subtype, $datecreated, $datedeadline, $time, $maxattempts, $allowlate) !== false){ # comeback
            $_SESSION['msg'] = "emptyinput";
            header ("location: ../Main_Project/teacher/teacher.createtask.php?msg=emptyinput&&currentSubject=$subjectId");
            exit();
        }

        # check if task is taken
        if(tasknameExist($conn, $taskname, $subjectId) !== false){
            $_SESSION['msg'] = "tasknametaken";
            header ("location: ../Main_Project/teacher/teacher.createtask.php?error=tasknametaken&&currentSubject=$subjectId");
            exit();
        }

        # create the task
        createTask($conn, $subjectId, $grading, $moduleSection, $taskname, $questionitems, $tasktype, $subtype, $datecreated, $datedeadline, $time_created, $time, $maxattempts, $allowlate, $taskinstruction);
        
        # getting task_list details
        $taskExists = tasknameExist($conn, $taskname, $subjectId);
        $_SESSION["question_items"] = $questionitems; // ito
        $_SESSION["task_name"] = $taskExists["task_name"];
        $_SESSION["task_id"] = $taskExists["task_list_id"];
        $_SESSION["questionCounter"] = 1;
        $taskid = $taskExists["task_list_id"];

        # redrecting to creating questions
        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.createidentification.php"); 
        exit();
    }

    if(isset($_POST["createTrueOrFalse"])){
        $grading = $_POST["grading"];
        $moduleSection = $_POST["moduleSection2"];
        $taskname = $_POST["taskname"];
        $questionitems = $_POST["questionitems"]; 
        $tasktype = $_POST["tasktype"];
        $subtype = $_POST["subtype"];
        $datecreated = $_POST["datecreated"];
        $datecreated = $date_Today;
        $datedeadline = $_POST["datedeadline"];
        // time created
        $time_created = $_POST["timecreated"];
        $time = $_POST["timelimit"];
        $maxattempts = $_POST["maxattempts"];
        $allowlate = $_POST["submissionchoice"]; 
        $taskinstruction = $_POST["taskinstruction"];

        $subjectId = $_POST["subjectid"];
        $_SESSION["subjectId"] = $_POST["subjectid"];
        if(isset($_SESSION["subjectId"])){
            $subjectId = $_SESSION["subjectId"];
        }else{
            $subjectId = $_POST["subjectid"];
        }
        
        // # Error handlers
        if(emptyWithAnswerTask($grading, $moduleSection, $taskname, $questionitems, $tasktype, $subtype, $datecreated, $datedeadline, $time, $maxattempts, $allowlate) !== false) { # comeback
            $_SESSION['msg'] = "emptyinput";
            header ("location: ../Main_Project/teacher/teacher.createtask.php?msg=emptyinput&&currentSubject=$subjectId");
            exit();
        }

        # check if task is taken
        if(tasknameExist($conn, $taskname, $subjectId) !== false){
            $_SESSION['msg'] = "tasknametaken";
            header ("location: ../Main_Project/teacher/teacher.createtask.php?msg=tasknametaken&&currentSubject=$subjectId");
            exit();
        }

        # create the task
        createTask($conn, $subjectId, $grading, $moduleSection, $taskname, $questionitems, $tasktype, $subtype, $datecreated, $datedeadline, $time_created, $time, $maxattempts, $allowlate, $taskinstruction);
        
        # getting task_list details
        $taskExists = tasknameExist($conn, $taskname, $subjectId);
        $_SESSION["question_items"] = $questionitems; // ito
        $_SESSION["task_name"] = $taskExists["task_name"];
        $_SESSION["task_id"] = $taskExists["task_list_id"];
        $_SESSION["questionCounter"] = 1;
        $taskid = $taskExists["task_list_id"];

        # redrecting to creating questions
        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.createTrueOrFalse.php");
        exit(); 
    }

    if (isset($_POST["createModuleSection"])){
        $moduleSectionName = $_POST['moduleSectionName'];
        $moduleSectionDesc = $_POST['moduleSectinDesc'];
        $subjectId = $_SESSION['subjectId'];
        $gradingId = $_POST['moduleSectionGradingId'];
    
        #error handlers
        // validate here

        # check if task is taken
        if(moduleNameExist($conn, $moduleSectionName, $gradingId, $subjectId) !== false){
            $_SESSION['msg'] = "modulenametaken";
            header ("location: ../Main_Project/teacher/teacher.subject.php");
            exit();
        }
        
        //Create the module section
        $id = createModuleSection($conn, $moduleSectionName, $moduleSectionDesc, $subjectId, $gradingId);
        $_SESSION['moduleSectionCreated'] = 'yes';
        
        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.subject.php");
        exit();
    }

    if(isset($_POST["createModuleSectionWithGrading"])){
        $moduleSectionName = $_POST['moduleSectionName'];
        $moduleSectionDesc = $_POST['moduleSectinDesc'];
        $subjectId = $_SESSION['subjectId'];
        $gradingId = $_POST['gradingModal'];

        // Remove the white space
        $trimModuleSectionName = rtrim($moduleSectionName);

        # check if task is taken
      

        if(moduleNameExist($conn, $moduleSectionName, $gradingId, $subjectId) !== false){
            $_SESSION['msg'] = "modulenametaken";
            header ("location: ../Main_Project/teacher/teacher.createtask.php?currentSubject=$subjectId");
            exit();
        }
        
        $id = createModuleSection($conn, $moduleSectionName, $moduleSectionDesc, $subjectId, $gradingId);
        $_SESSION['moduleSectionCreated'] = 'yes';

        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.createtask.php?currentSubject=$subjectId");
        exit();
    }

    #region
    // to drop
    // if(isset($_POST["createEnumeration"])){
    //     $grading = $_POST["grading"];
    //     $taskname = $_POST["taskname"];
    //     $questionitems = $_POST["questionitems"]; 
    //     $tasktype = $_POST["tasktype"];
    //     $subtype = $_POST["subtype"];
    //     $datecreated = $_POST["datecreated"];
    //     $datedeadline = $_POST["datedeadline"];
    //     $time = $_POST["timelimit"];
    //     $maxscore = $_POST["maxscore"]; 
    //     //$maxattempts = $_POST["maxattempts"];
    //     $allowlate = $_POST["submissionchoice"]; 

    //     $subjectId = $_POST["subjectid"];
    //     $_SESSION["subjectId"] = $_POST["subjectid"];
    //     if(isset($_SESSION["subjectId"])){
    //         $subjectId = $_SESSION["subjectId"];
    //     }else{
    //         $subjectId = $_POST["subjectid"];
    //     }

    //     # Error handlers
    //     if(emptyInputTask($grading, $taskname) !== false){ # comeback
    //         # , $taskcontent, $questionitems, $tasktype, $subtype, $datecreated, $datedeadline, $time, $maxscore, $maxattempts, $allowlate
    //         header ("location: ../Main_Project/teacher/teacher.createtask.php?msg=emptyinput&&currentSubject=$subjectId");
    //         exit();
    //     }

    //     # check if task is taken
    //     if(tasknameExist($conn, $taskname, $subjectId) !== false){
    //         header ("location: ../Main_Project/teacher/teacher.createtask.php?msg=tasknametaken&&currentSubject=$subjectId");
    //         exit();
    //     }

    //     # create the task
    //     createTask($conn, $grading, $taskname, $questionitems, $tasktype, $subtype, $datecreated, $datedeadline, $time, $maxattempts, $allowlate);
        
    //     # getting task_list details
    //     $taskExists = tasknameExist($conn, $taskname, $subjectId);
    //     $_SESSION["question_items"] = $questionitems; // ito
    //     $_SESSION["task_name"] = $taskExists["task_name"];
    //     $_SESSION["task_id"] = $taskExists["task_list_id"];
    //     $_SESSION["questionCounter"] = 1;
    //     $taskid = $taskExists["task_list_id"];

    //     # redrecting to creating enumeration
    //     header ("location: ../Main_Project/teacher/assets/header.view.php");
    //     header ("location: ../Main_Project/teacher/teacher.createenumeration.php");
    //     exit();
    // }
    #endregion

# -----CREATE TASK BUTTONS-----end #

# --- Essay --- #
if(isset($_POST['createEssayContent'])){
    $teacherId = $_SESSION["teacher_id"];
    $subjectId = $_SESSION['subjectId'];
    $taskListId = $_SESSION["task_id"];
    $questionContent = $_POST["questionContent"];
    $filename = $_FILES['file_upload']['name'];
    
    
    $filepath = '../upload/' . $teacherId . $subjectId . $taskListId;
    
    $size = getFileSize($_FILES['file_upload']['size']);
    

    ## check if the essay content exist -- comeback
    $essayContentExists = essayContentExist($conn, $taskListId, $questionContent);
    
    $essayFileExists = essayFileExist($conn, $taskListId, $filename);
    
    # check empty feilds 
    if(emptyEssayContent($questionContent) !== false){
        $_SESSION['msg'] = "missingfeilds";
        header ("location: ../Main_Project/teacher/teacher.createEssay.php?error=emptyinput");
        exit();
    }

    # Check it questioners exists
    if($essayFileExists !== false){
        //$_SESSION['currentQuestion'] = $questionExists['question_id'];
        $_SESSION['msg'] = "essayFileTaken";
        header ("location: ../Main_Project/teacher/teacher.createEssay.php?error=questiontaken");
        exit();
    } 
    
    // saving file
    if($size < 1000.0){
        if(!file_exists($filepath)){
            //create folder
            mkdir($filepath, 0777, true);
        } 
    
        $temp_file = $_FILES['file_upload']['tmp_name'];
       
        
        if($temp_file != ""){
            
            // concatinating the file
            $newfilepath = $filepath."/". $filename;
            
            if(move_uploaded_file($temp_file, $newfilepath)){
                
                createEssayContent($conn, $taskListId, $questionContent, $filename, $filepath);
                $_SESSION['msg'] = "taskcompleted";
                header ("location: ../Main_Project/teacher/assets/header.view.php");
                header ("location: ../Main_Project/teacher/teacher.taskproceed.php?msg=essay");
                exit();
            } else{
            
                echo 'Upload error encounter : ' . $_FILES['file_upload']['error'];
                
            }
        } else{
            createEssayContentNoFile($conn, $taskListId, $questionContent);
            $_SESSION['msg'] = "taskcompleted";
            header ("location: ../Main_Project/teacher/assets/header.view.php");
            header ("location: ../Main_Project/teacher/teacher.taskproceed.php?msg=essay");
            exit();
        
        }
    
      
    } else{
        echo 'File to Large';
    }

    
}

if(isset($_POST['saveEssayScore'])){
    $tab = $_POST['tab_input'];
    $submissionId = $_POST['submissionId'];
    $score = $_POST['submmisionScore'];
    $studentId = $_POST['studentIdHidden'];
    $taskId = $_POST['taskIdHidden'];
    $attemptCount = $_POST['attemptCount'];
    $maxscore = $_POST['maxScoreHidden'];
  
    saveEssayScore($conn, $score, $submissionId);
    
    $_SESSION['msg'] = "taskgraded";
    header ("location: ../Main_Project/teacher/assets/header.view.php");
    header ("location: ../Main_Project/teacher/studentTaskView.php?studentId=$studentId&&taskId=$taskId&&submissionId=$submissionId&&attemptCount=$attemptCount&&tab=$tab");
    exit();
}

if(isset($_POST['editEssayScore'])){
    $tab = $_POST['tab_input'];
    $submissionId = $_POST['submissionId'];
    $score = $_POST['submmisionScore'];
    $studentId = $_POST['studentIdHidden'];
    $taskId = $_POST['taskIdHidden'];
    $attemptCount = $_POST['attemptCount'];
    $maxscore = $_POST['maxScoreHidden'];
  
    if($score > $maxscore){
        $_SESSION['msg'] = "scorelimitreached";
        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/studentTaskView.php?studentId=$studentId&&taskId=$taskId&&submissionId=$submissionId&&attemptCount=$attemptCount");
        exit();
    
    }
    saveEssayScore($conn, $score, $submissionId);
    
    $_SESSION['msg'] = "taskgradeedited";
    header ("location: ../Main_Project/teacher/assets/header.view.php");
    header ("location: ../Main_Project/teacher/studentTaskView.php?studentId=$studentId&&taskId=$taskId&&submissionId=$submissionId&&attemptCount=$attemptCount&&tab=$tab");
    exit();

}
# --- Essay --- end #

# --- Multiple choice --- #
    if(isset($_POST["nextQuestion"]) || isset($_POST["previousQuestion"])){
        $subjectId = $_POST["currentSubject"];
        $questioner = $_POST['questioner'];
        $answerselect = $_POST['answerselect'];
        $questionNumber = $_SESSION["questionCounter"];

        $choiceA = $_POST['choiceA'];
        $choiceB = $_POST['choiceB'];
        $choiceC = $_POST['choiceC'];
        $choiceD = $_POST['choiceD'];

        $choiceAIsCorrect = $_POST['choiceIsCorrectA'];
        $choiceBIsCorrect = $_POST['choiceIsCorrectB'];
        $choiceCIsCorrect = $_POST['choiceIsCorrectC'];
        $choiceDIsCorrect = $_POST['choiceIsCorrectD'];
        
        ## check if the question exist -- comeback
        $taskListId = $_SESSION["task_id"];
        $questionExists = questionerExist($conn, $taskListId, $questioner);
        $questionerCounter = $_SESSION["questionCounter"];

        # check empty feilds 
        if(emptyInputQuestion($questioner, $answerselect, $choiceA, $choiceB, $choiceC, $choiceD) !== false){
            $_SESSION['msg'] = "missingfeilds";
            header ("location: ../Main_Project/teacher/teacher.createquestioner.php?error=emptyinput");
            exit();
        }
        
        # Logic for next button -- comeback
        if($questionExists !== false){
            //$_SESSION['currentQuestion'] = $questionExists['question_id'];
            $_SESSION['msg'] = "questionertaken";
            header ("location: ../Main_Project/teacher/teacher.createquestioner.php?error=questiontaken");
            exit();
        } 


        ## create question if not exist-- comeback
        createQuestion($conn, $taskListId, $questioner, $questionNumber);

        ## save the recentlyadded question id to session
        $recentlyAdded = questionerExist($conn, $taskListId, $questioner);
        $_SESSION['recentlyAdded'] = $recentlyAdded['question_id'];
        $_SESSION["questionCounter"] = $_SESSION["questionCounter"] + 1;
        $_SESSION['currentQuestion'] = $_SESSION['recentlyAdded'];

        ## create answer
        createAnswer($conn, $recentlyAdded['question_id'], $answerselect);
        
        ## create choices modifying
        createChoices($conn, $recentlyAdded['question_id'], $choiceA, $choiceAIsCorrect);
        createChoices($conn, $recentlyAdded['question_id'], $choiceB, $choiceBIsCorrect);
        createChoices($conn, $recentlyAdded['question_id'], $choiceC, $choiceCIsCorrect);
        createChoices($conn, $recentlyAdded['question_id'], $choiceD, $choiceDIsCorrect);

        $_SESSION['msg'] = "questionercreated";

        ## redirect to creating question when limit reached
        if($questionerCounter >= $_SESSION["question_items"]){
            header ("location: ../Main_Project/teacher/teacher.taskproceed.php?msg=multiplechoice");
            exit();
        } 
        
        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.createquestioner.php?msg=questioncreated");
        exit();
    }

    # Updating question
    if(isset($_POST["updateQuestion"])){
        $questioner = $_POST['questioner'];
        $answerselect = $_POST['answerselect'];
        $choiceA = $_POST['choiceA'];
        $choiceB = $_POST['choiceB'];
        $choiceC = $_POST['choiceC'];
        $choiceD = $_POST['choiceD'];

        # ID's 
        $questionerId = $_POST['questionerId'];
        $answerId = $_POST['answerId'];
        $choiceAId = $_POST['choiceAId'];
        $choiceBId = $_POST['choiceBId'];
        $choiceCId = $_POST['choiceCId'];
        $choiceDId = $_POST['choiceDId'];

        #correct choice
        $choiceAIsCorrect = $_POST['choiceIsCorrectA'];
        $choiceBIsCorrect = $_POST['choiceIsCorrectB'];
        $choiceCIsCorrect = $_POST['choiceIsCorrectC'];
        $choiceDIsCorrect = $_POST['choiceIsCorrectD'];

        $taskListId = $_SESSION["task_id"];
        $questionExists = questionerExist($conn, $taskListId, $questioner);
        $currentQuestion = getQuestionName($conn, $questionerId);

      
        
        if(emptyInputQuestion($questioner, $answerselect, $choiceA, $choiceB, $choiceC, $choiceD) !== false){
            $_SESSION['msg'] = "missingfeilds";
            header ("location: ../Main_Project/teacher/teacher.createquestioner.php?error=emptyinput");
            exit();
        }
        
        
        # update quesitoner details
        if($currentQuestion['question_name'] == $questioner){
            updateAnswerKey($conn, $answerId, $answerselect);
            updateQuestion($conn, $questionerId, $questioner);
            updateChoices($conn, $choiceAId, $choiceA, $choiceAIsCorrect);
            updateChoices($conn, $choiceBId, $choiceB, $choiceBIsCorrect);
            updateChoices($conn, $choiceCId, $choiceC, $choiceCIsCorrect);
            updateChoices($conn, $choiceDId, $choiceD, $choiceDIsCorrect);
            $_SESSION['msg'] = "questionupdated";

            header ("location: ../Main_Project/teacher/assets/header.view.php");
            header ("location: ../Main_Project/teacher/teacher.createquestioner.php?msg=questionupdated");
            exit();
        }
        
        if($questionExists !== false){
            $_SESSION['msg'] = "questionertaken";
            header ("location: ../Main_Project/teacher/teacher.createquestioner.php?taskId=$taskListId");
            exit();
        }
        
        updateAnswerKey($conn, $answerId, $answerselect);
        updateQuestion($conn, $questionerId, $questioner);
        updateChoices($conn, $choiceAId, $choiceA, $choiceAIsCorrect);
        updateChoices($conn, $choiceBId, $choiceB, $choiceBIsCorrect);
        updateChoices($conn, $choiceCId, $choiceC, $choiceCIsCorrect);
        updateChoices($conn, $choiceDId, $choiceD, $choiceDIsCorrect);
        $_SESSION['msg'] = "questionupdated";

        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.createquestioner.php?msg=questionupdated");
        exit();

    }

    if(isset($_POST["cancelQuestion"])){
        // deleteting task data
        $taskListId = $_SESSION["task_id"];
        deleteTask($conn, $taskListId);

        unset($_SESSION["question_items"]);
        unset($_SESSION["task_name"]);
        unset($_SESSION["task_id"]);
        unset($_SESSION['recentlyAdded']);
        unset($_SESSION['questionCounter']);
        $currentSubject = $_SESSION['subjectId'];
        header ("location: ../Main_Project/teacher/teacher.createtask.php?msg=multiplechoicecancelled&&currentSubject=$currentSubject");
        exit();
    }
# --- Multiple choice ---end#

# --- Identification --- #
    if(isset($_POST["nextIdentification"])){
        $identificationAnswer = $_POST["identificationInputAnswer"];
        $identificationQuestion = $_POST["identificationInputQuestion"];
        $questionerCounter = $_SESSION["questionCounter"];
        $taskId = $_SESSION["task_id"];
        $questionNumber = $_SESSION['questionCounter'];
    


        # Check if feilds is empty
        if(emptyInputIdentification($identificationAnswer, $identificationQuestion) !== false){
            $_SESSION['msg'] = "missingfeilds";
            header ("location: ../Main_Project/teacher/teacher.createidentification.php?error=emptyinput");
            exit();
        }

        # check if identification question exists?
        $identificationExists = questionerExist($conn, $taskId, $identificationQuestion);
        if($identificationExists !== false){
            $_SESSION['msg'] = "questionertaken";
            header ("location: ../Main_Project/teacher/teacher.createidentification.php?error=questiontaken");
            exit();
        }

        # sava the data to database 
        createQuestion($conn, $taskId, $identificationQuestion ,$questionNumber);

        ## save the recentlyadded question id to session
        $recentlyAdded = questionerExist($conn, $taskId, $identificationQuestion);
        $_SESSION['recentlyAdded'] = $recentlyAdded['question_id'];
        $_SESSION['questionCounter'] = $_SESSION['questionCounter'] + 1;
        $_SESSION['currentQuestion'] = $_SESSION['recentlyAdded'];

        createAnswer($conn, $recentlyAdded['question_id'], $identificationAnswer);

        $_SESSION['msg'] = "questionercreated";

        # if the question count reach the target number of question, stop
        if($questionerCounter >= $_SESSION["question_items"]){
            header ("location: ../Main_Project/teacher/assets/header.view.php");
            header ("location: ../Main_Project/teacher/teacher.taskproceed.php?msg=identification");
            exit();
        } 

        # head to next question if question count hasn't reach the target
        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.createidentification.php?msg=questionsaved");
        exit();

    }

    if(isset($_POST["updateIdentification"])){ 
        $question = $_POST["identificationInputQuestion"];
        $answer = $_POST["identificationInputAnswer"];
        $questionerId = $_POST["identificationInputQuestionId"];
        $answerID = $_POST["identificationInputId"];
        $_SESSION['updatingIdentification'];
        
        $taskListId = $_SESSION["task_id"];
        $questionExists = questionerExist($conn, $taskListId, $question);
        $currentQuestion = getQuestionName($conn, $questionerId);

        # check inputs
        if(emptyInputIdentification($answer, $question) !== false){
            $_SESSION['msg'] = "missingfeilds";
            header ("location: ../Main_Project/teacher/teacher.createidentification.php?error=emptyinput");
            exit();
        }

        if($currentQuestion['question_name'] == $question){
            updateIdentificationQuestion($conn, $questionerId, $question);
            updateIdentificationAnswer($conn, $answerID, $answer);
            $_SESSION['msg'] = "questionupdated";

            header ("location: ../Main_Project/teacher/assets/header.view.php");
            header ("location: ../Main_Project/teacher/teacher.createidentification.php?msg=questionupdated");
            exit();
        }
        
        if($questionExists !== false){
            $_SESSION['msg'] = "questionertaken";
            header ("location: ../Main_Project/teacher/teacher.createidentification.php?taskId=$taskListId");
            exit();
        }
        
        updateIdentificationQuestion($conn, $questionerId, $question);
        updateIdentificationAnswer($conn, $answerID, $answer);
        $_SESSION['msg'] = "questionupdated";

        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.createidentification.php?msg=updatesuccess");
        exit();
    }

    if(isset($_POST["cancelIdentification"])){

        # delete the task_list here before unsetting the session
        # delete all the recently added question and answer
        $taskListId = $_SESSION["task_id"];
        deleteTask($conn, $taskListId);

        // unset sessions
        unset($_SESSION["question_items"]);
        unset($_SESSION["task_name"]);
        unset($_SESSION["task_id"]);
        unset($_SESSION['recentlyAdded']);
        unset($_SESSION['questionCounter']);
        $currentSubject = $_SESSION['subjectId'];

        header ("location: ../Main_Project/teacher/teacher.createtask.php?msg=identificationcreationcancelled&&currentSubject=$currentSubject");
        exit();
    }

   
    
# --- Identification --- end#

# --- TRUE OR FALSE --- #
    if(isset($_POST["nextTrueOrFalseQuestion"])){
        if(isset($_POST['submissionchoice'])){
            $trueOrFalseAnswer = $_POST['submissionchoice'];
        } else{
            $trueOrFalseAnswer = "";
        }
        $trueOrFalseQuestion = $_POST["trueOrFalseQuestioner"];
        $questionerCounter = $_SESSION["questionCounter"];
        $taskId = $_SESSION["task_id"];  

        # check fields if empty *****create function
        if(emptyInputTrueOrFalse($trueOrFalseQuestion, $trueOrFalseAnswer) !== false){
            $_SESSION['msg'] = "missingfeilds";
            header ("location: ../Main_Project/teacher/teacher.createTrueOrFalse.php?msg=emptyinput");
            exit();
        }

    
        # check if trueOrfalse  question exists?
        $trueOrFalseExists = questionerExist($conn, $taskId, $trueOrFalseQuestion);
        if($trueOrFalseExists !== false){
            $_SESSION['msg'] = "questionertaken";
            header ("location: ../Main_Project/teacher/teacher.createTrueOrFalse.php?msg=questiontaken");
            exit();
        }

        # sava the data to database then save answer
        createQuestion($conn, $taskId, $trueOrFalseQuestion ,$questionerCounter);

        ## save the recentlyadded question id to session
        $recentlyAdded = questionerExist($conn, $taskId, $trueOrFalseQuestion);
        $_SESSION['recentlyAdded'] = $recentlyAdded['question_id'];
        $_SESSION['questionCounter'] = $_SESSION['questionCounter'] + 1;
        $_SESSION['currentQuestion'] = $_SESSION['recentlyAdded'];

        echo  'Qeustion ID'.$recentlyAdded['question_id'];

        # save answer
        createAnswer($conn, $recentlyAdded['question_id'], $trueOrFalseAnswer);

        $_SESSION['msg'] = "questionercreated";

        # if the question count reach the target number of question, stop
        if($questionerCounter >= $_SESSION["question_items"]){
            header ("location: ../Main_Project/teacher/assets/header.view.php");
            header ("location: ../Main_Project/teacher/teacher.taskproceed.php?msg=trueorfalse");
            exit();
        }

        # head to next question if question count hasn't reach the target
        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.createTrueOrFalse.php?msg=questionsaved");
        exit();

    }
    
    if(isset($_POST["cancelTrueOrFalseQuestion"])){
        // deleteting task data
        $taskListId = $_SESSION["task_id"];
        deleteTask($conn, $taskListId);

        // unset sessions
        unset($_SESSION["question_items"]);
        unset($_SESSION["task_name"]);
        unset($_SESSION["task_id"]);
        unset($_SESSION['recentlyAdded']);
        unset($_SESSION['questionCounter']);
        $currentSubject = $_SESSION['subjectId'];

        header ("location: ../Main_Project/teacher/teacher.createtask.php?msg=createTrueOrFalsecancelled&&currentSubject=$currentSubject");
        exit();
    }

    if(isset($_POST["updateTrueOrFalseQuestion"])){
        $taskId = $_SESSION["task_id"];
        $question = $_POST["trueOrFalseQuestioner"];
        $questionID = $_POST["trueOrFalseQuestionerId"];
        
        if(isset($_POST['submissionchoice'])){
            $answer = $_POST['submissionchoice'];
        } else{
            $answer = "";
        }
        $answerID = $_POST["submissionChoiceId"];

        $questionExists = questionerExist($conn, $taskId, $question);
        $currentQuestion = getQuestionName($conn, $questionID);

        // $_SESSION['updatingIdentification'];
        
        # check inputs
        # check fields if empty *****create function
        if($currentQuestion['question_name'] == $question){
            updateQuestion($conn, $questionID, $question);
            updateTrueOrFalseAnswer($conn, $_POST["submissionChoiceId"], $answer);
            $_SESSION['msg'] = "questionupdated";
            
            header ("location: ../Main_Project/teacher/assets/header.view.php");
            header ("location: ../Main_Project/teacher/teacher.createTrueOrFalse.php?msg=updatesuccess&&test=$answer");
            exit();
        }

        if($questionExists !== false){
            $_SESSION['msg'] = "questionertaken";
            header ("location: ../Main_Project/teacher/teacher.createTrueOrFalse.php");
            exit();
        }

        if(emptyInputTrueOrFalse($question, $answer) !== false){
            $_SESSION['msg'] = "questionertaken";
            header ("location: ../Main_Project/teacher/teacher.createTrueOrFalse.php?msg=emptyinput");
            exit();
        }


        updateQuestion($conn, $questionID, $question);
        updateTrueOrFalseAnswer($conn, $_POST["submissionChoiceId"], $answer);
        $_SESSION['msg'] = "questionupdated";
        
        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.createTrueOrFalse.php?msg=updatesuccess");
        exit();
    }
# --- TRUE OR FALSE --- end#

# --- Enumeration --- #
# --- Enumeration --- end#


# --- Cancel buttons outside the main pages --- #
    if(isset($_POST["cancelTaskSave"])){
        $taskListId = $_SESSION["task_id"];
        $questionId = $_SESSION['recentlyAdded'];
        deleteAnswer($conn, $questionId);
        deleteChoices($conn, $questionId);
        deleteQuestion($conn, $taskListId);
        deleteTask($conn, $taskListId);
        $subjectId = $_SESSION["subjectId"];
        header ("location: ../Main_Project/teacher/teacher.createtask.php?msg=taskcancelled&&currentSubject=$subjectId");
        exit();
    }

    if(isset($_POST["cancelEssayTaskSave"])){
        $taskListId = $_SESSION["task_id"];
        deleteTask($conn, $taskListId);
        $_SESSION['msg'] = "createEssayCancelled";

        header ("location: ../Main_Project/teacher/teacher.createtask.php?msg=taskcancelled&&currentSubject=$subjectId");
        exit();

    }

    if(isset($_POST["cancelQuestionSave"])){
        $currentSubject = $_POST['subjectId'];
        $_SESSION["questionCounter"] = $_SESSION["questionCounter"] - 1;
        $questionId =  $_SESSION['recentlyAdded'];
        $taskListId = $_SESSION["task_id"];
        deleteChoices($conn, $questionId);
        deleteAnswer($conn, $questionId);
        deleteQuestion($conn, $questionId);
        header ("location: ../Main_Project/teacher/teacher.createquestioner.php?msg=questioncancelled");
        exit();
    }

    if(isset($_POST['cancelUpdateQuestion'])){
        $currentSubject = $_POST['subjectId'];
        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.createquestioner.php");
        exit();
    }

    if(isset($_POST["cancelIdentificationSave"])){
        $_SESSION["questionCounter"] = $_SESSION["questionCounter"] - 1;
        $questionId =  $_SESSION['recentlyAdded'];
        $taskListId = $_SESSION["task_id"];
        deleteAnswer($conn, $questionId);
        deleteQuestion($conn, $questionId);
        header ("location: ../Main_Project/teacher/teacher.createidentification.php?none");
        exit();
    }

    if(isset($_POST['cancelIdentificationUpdate'])){
        $_SESSION['updatingIdentification'] = false;
        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.createidentification.php?msg=updatecancelled");
        exit();
    }

    if(isset($_POST["cancelIdenticationTaskSave"])){
        // unset the identification session
        $subjectId = $_SESSION["subjectId"];
        
        $taskListId = $_SESSION["task_id"];
        deleteTask($conn, $taskListId);

        unset($_SESSION['task_id']);
        unset($_SESSION['indentificationTask']);
        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.createtask.php?msg=identificationtaskcreationcancelled&&currentSubject=$subjectId");
        exit();

    }
# --- Cancel buttons outside the main pages --- end #



# --- Proceed Buttons --- #
    if(isset($_POST["identificationtaskproceed"])){
        $subjectId = $_SESSION["subjectId"];
        unset($_SESSION["question_items"]);
        unset($_SESSION["task_name"]);
        unset($_SESSION["task_id"]);
        unset($_SESSION['recentlyAdded']);
        unset($_SESSION['questionCounter']);
        $_SESSION['msg'] = "taskcompleted";
        header ("location: ../Main_Project/teacher/teacher.createtask.php?currentSubject=$subjectId");
        exit();
    }

    if(isset($_POST["identificationProceed"])){
        $subjectId = $_SESSION["subjectId"];
        $_SESSION['updatingIdentification'] = true;
        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.createidentification.php?currentSubject=$subjectId");
        exit();
    }

    if(isset($_POST["questionProceed"])){
        $currentSubject = $_POST['subjectId'];
        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.createquestioner.php");
        exit();

    }

    if(isset($_POST["taskProceed"])){
        unset($_SESSION["question_items"]);
        unset($_SESSION["task_name"]);
        unset($_SESSION["task_id"]);
        unset($_SESSION['recentlyAdded']);
        unset($_SESSION['questionCounter']);
        $subjectId = $_SESSION["subjectId"];
        $_SESSION['msg'] = "taskcompleted";
        header ("location: ../Main_Project/teacher/teacher.createtask.php?msg=taskessaycreated&&currentSubject=$subjectId");
        exit();
    }

# --- Proceed Buttons --- end #


# --- Updates --- #
    if(isset($_POST['updateTaskGive'])){
        echo 'Im here..';
        $subjectId = $_SESSION["subjectId"];
        $_SESSION["taskGiven"] = "taskGiven";
        $taskId = $_POST['taskId'];
        $isGiven = $_POST['isGiven'];

        //update task given on task_list_tbl
        updateTaskGiven($conn, $isGiven, $taskId);

         // get task
         $resultTask = taskExists($conn, $taskId);
        $taskGiven = $resultTask['given'];

        if($taskGiven == "Yes"){
            $_SESSION['taskGivenStatus'] = "Yes";
        } else if($taskGiven == "No" || $taskGiven = ""){
            $_SESSION['taskGivenStatus'] = "No";
        }

        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.subject.php?msg=taskGiven&&tab=moduleTab&&currentSubject=$subjectId");
        exit();
        
    }

    if(isset($_POST['updateTaskGiveTaskTab'])){
        echo 'Im here 2..';
        $subjectId = $_SESSION["subjectId"];
        $_SESSION["taskGiven"] = "taskGiven";
        $taskId = $_POST['taskId'];
        $isGiven = $_POST['isGivenTaskTab'];

        // valiate if empty fields

        //update task given on task_list_tbl
        updateTaskGiven($conn, $isGiven, $taskId);

        // get task
        $resultTask = taskExists($conn, $taskId);
        $taskGiven = $resultTask['given'];

        if($taskGiven == "Yes"){
            $_SESSION['taskGivenStatus'] = "Yes";
        } else if($taskGiven == "No" || $taskGiven = ""){
            $_SESSION['taskGivenStatus'] = "No";
        }

        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.subject.php?msg=taskGiven&&tab=taskTab&&currentSubject=$subjectId");
        exit();
        
    }

    #update grading module section teacher.subject.php
    if(isset($_POST['updateModuleSection'])){
        $gradingId = $_POST['updateModuleSectionGradingId'];
        $moduleSectionId = $_POST['updateModuleSectionId'];
        $moduleSectionName = $_POST['updateModuleSectionName'];
        $moduleSectionDesc = $_POST['updateModuleSectionDesc'];
        $subjectId = $_SESSION['subjectId'];

        // compare the name
        $moduleName = getModuleName($conn, $moduleSectionId);
        
        $trimModuleSectionName = rtrim($moduleSectionName);
        echo $trimModuleSectionName;

        if($moduleName['module_section_name'] == $trimModuleSectionName){
            // update ur data
            updateModuleSection($conn, $moduleSectionId, $trimModuleSectionName, $moduleSectionDesc);
            $_SESSION['msg'] = "modulesectionupdated";
            header ("location: ../Main_Project/teacher/teacher.subject.php?1");
            exit();
        } else if(moduleNameExist($conn, $trimModuleSectionName, $gradingId, $subjectId) !== false){
            // check if the task exist
            $_SESSION['msg'] = "modulenametaken";
            header ("location: ../Main_Project/teacher/teacher.subject.php?2");
            exit();
        }

        // update function here
        updateModuleSection($conn, $moduleSectionId, $trimModuleSectionName, $moduleSectionDesc);
        
        $_SESSION['msg'] = "modulesectionupdated";

        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.subject.php?3");
        exit();

    }

    if(isset($_POST['updateModalTaskWithQuestion'])){
        echo 'update multiple choice';
        $taskId = $_POST['updateTaskId'];
        $subType = $_POST['inputSubType'];

        $taskname = $_POST['taskname'];
        $datedeadline = $_POST['datedeadline'];
        $timelimit = $_POST['timelimit'];
        $maxattempts = $_POST['maxattempts'];
        $submissionchoice = $_POST['submissionchoice'];
        $timeCreated = $_POST['timestart'];
        $dateCreated = $_POST['datestart'];
        $taskinstruction = $_POST['taskinstruction'];

        // check if the task name exist
        updateModalTaskWithQuestion($conn, $taskId, $taskname, $datedeadline, $timelimit, $maxattempts, $submissionchoice, $timeCreated, $dateCreated, $taskinstruction);

        // set session message that update success
        $_SESSION['msg'] = "taskupdated";
        // set session message that update failed

        // header location to teacher.subject.php
        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.subject.php?tab=taskTab");
        exit();
        
    }

    if(isset($_POST['updateModalIdentification'])){
        echo 'update multiple choice';
        $taskId = $_POST['updateTaskId'];
        $subType = $_POST['inputSubType'];

        $taskname = $_POST['taskname'];
        $datedeadline = $_POST['datedeadline'];
        $timelimit = $_POST['timelimit'];
        $maxattempts = $_POST['maxattempts'];
        $submissionchoice = $_POST['submissionchoice'];

        // check if the task name exist
        updateTaskMultipleChoice($conn, $taskId, $taskname, $datedeadline, $timelimit, $maxattempts, $submissionchoice);

        // set session message that update success
        $_SESSION['msg'] = "taskupdated";
        // set session message that update failed

        // header location to teacher.subject.php
        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.subject.php?tab=taskTab");
        exit();
        
    }

    if(isset($_POST['updateModalTrueOrFalse'])){
        echo 'update multiple choice';
        $taskId = $_POST['updateTaskId'];
        $subType = $_POST['inputSubType'];

        $taskname = $_POST['taskname'];
        $datedeadline = $_POST['datedeadline'];
        $timelimit = $_POST['timelimit'];
        $maxattempts = $_POST['maxattempts'];
        $submissionchoice = $_POST['submissionchoice'];

        // check if the task name exist
        updateTaskMultipleChoice($conn, $taskId, $taskname, $datedeadline, $timelimit, $maxattempts, $submissionchoice);

        // set session message that update success
        $_SESSION['msg'] = "taskupdated";
        // set session message that update failed

        // header location to teacher.subject.php
        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.subject.php?tab=taskTab");
        exit();
        
    }

    if(isset($_POST['updateModalEssay'])){
        echo 'update multiple choice';
        $taskId = $_POST['updateTaskId'];
        $subType = $_POST['inputSubType'];

        $taskname = $_POST['taskname'];
        $datedeadline = $_POST['datedeadline'];
        $timelimit = $_POST['timelimit'];
        $maxattempts = $_POST['maxattempts'];
        $maxscore = $_POST['maxscore'];
        $submissionchoice = $_POST['submissionchoice'];
        $timeCreated = $_POST['timestart'];
        $dateCreated = $_POST['datestart'];
        $taskinstruction = $_POST['taskinstruction'];

        // check if the task name exist
        updateTaskEssay($conn, $taskId, $taskname, $datedeadline, $timelimit, $maxattempts, $maxscore, $submissionchoice, $timeCreated, $dateCreated, $taskinstruction);

        // set session message that update success
        $_SESSION['msg'] = "taskupdated";
        // set session message that update failed

        // header location to teacher.subject.php
        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.subject.php?tab=taskTab");
        exit();
        
    }

#region    --- teacher.editTask.php
if(isset($_POST["createQuestion_EditTask"])){
    $questioner = $_POST['createQuestioner'];
    $answerselect = $_POST['createAnswerselect'];
    $questionNumber = $_POST['createEditTaskQuestionCount'];

    $choiceA = $_POST['createChoiceA'];
    $choiceB = $_POST['createChoiceB'];
    $choiceC = $_POST['createChoiceC'];
    $choiceD = $_POST['createChoiceD'];

    $choiceAIsCorrect = $_POST['createChoiceIsCorrectA'];
    $choiceBIsCorrect = $_POST['createChoiceIsCorrectB'];
    $choiceCIsCorrect = $_POST['createChoiceIsCorrectC'];
    $choiceDIsCorrect = $_POST['createChoiceIsCorrectD'];
    
    ## check if the question exist -- comeback
    $taskListId =  $_POST["insertTaskId"];
    $questionExists = questionerExist($conn, $taskListId, $questioner);

    # Logic for next button -- comeback

    if($questionExists !== false){
        //$_SESSION['currentQuestion'] = $questionExists['question_id'];
        $_SESSION['msg'] = "questionertaken";
        header ("location: ../Main_Project/teacher/teacher.editTask.php?msg=questiontaken&&taskId=$taskListId");
        exit();
    }

    
    ## create question if not exist-- comeback
    createQuestion($conn, $taskListId, $questioner, $questionNumber);
    
    ## save the recentlyadded question
    $recentlyAdded = questionerExist($conn, $taskListId, $questioner);

    ## create answer
    createAnswer($conn, $recentlyAdded['question_id'], $answerselect);
    
    ## create choices modifying
    createChoices($conn, $recentlyAdded['question_id'], $choiceA, $choiceAIsCorrect);
    createChoices($conn, $recentlyAdded['question_id'], $choiceB, $choiceBIsCorrect);
    createChoices($conn, $recentlyAdded['question_id'], $choiceC, $choiceCIsCorrect);
    createChoices($conn, $recentlyAdded['question_id'], $choiceD, $choiceDIsCorrect);

    // update task question count
    updateTaskQuestionCount($conn, $taskListId, $questionNumber);

    $_SESSION['msg'] = "questionercreated";

    header ("location: ../Main_Project/teacher/assets/header.view.php");
    header ("location: ../Main_Project/teacher/teacher.editTask.php?taskId=$taskListId");
    exit();
}

if(isset($_POST["updateQuestion_EditTask"])){
    $taskId = $_POST['updateTaskId'];
    $questioner = $_POST['questionNameMultipleChoice'];
    $answerselect = $_POST['answerselectMultipleChoice'];
    $choiceA = $_POST['choiceA'];
    $choiceB = $_POST['choiceB'];
    $choiceC = $_POST['choiceC'];
    $choiceD = $_POST['choiceD'];

    # ID's 
    $questionerId = $_POST['questionerMultipleChoiceId'];
    $answerId = $_POST['updateAnswerId'];
    $choiceAId = $_POST['updateChoiceAId'];
    $choiceBId = $_POST['updateChoiceBId'];
    $choiceCId = $_POST['updateChoiceCId'];
    $choiceDId = $_POST['updateChoiceDId'];

    #correct choice
    $choiceAIsCorrect = $_POST['choiceIsCorrectA'];
    $choiceBIsCorrect = $_POST['choiceIsCorrectB'];
    $choiceCIsCorrect = $_POST['choiceIsCorrectC'];
    $choiceDIsCorrect = $_POST['choiceIsCorrectD'];

    $questionExists = questionerExist($conn, $taskId, $questioner);
    $currentQuestion = getQuestionName($conn, $questionerId);
    
    # Logic for next button -- comeback
    if($currentQuestion['question_name'] == $questioner){
        # update quesitoner details
        updateAnswerKey($conn, $answerId, $answerselect);
        updateQuestion($conn, $questionerId, $questioner);
        updateChoices($conn, $choiceAId, $choiceA, $choiceAIsCorrect);
        updateChoices($conn, $choiceBId, $choiceB, $choiceBIsCorrect);
        updateChoices($conn, $choiceCId, $choiceC, $choiceCIsCorrect);
        updateChoices($conn, $choiceDId, $choiceD, $choiceDIsCorrect);

        $_SESSION['msg'] = "taskupdated";

        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.editTask.php?taskId=$taskId");
        exit();
    }

    if($questionExists !== false){
        $_SESSION['msg'] = "questionertaken";
        header ("location: ../Main_Project/teacher/teacher.editTask.php?taskId=$taskId");
        exit();
    }
    # update quesitoner details
    updateAnswerKey($conn, $answerId, $answerselect);
    updateQuestion($conn, $questionerId, $questioner);
    updateChoices($conn, $choiceAId, $choiceA, $choiceAIsCorrect);
    updateChoices($conn, $choiceBId, $choiceB, $choiceBIsCorrect);
    updateChoices($conn, $choiceCId, $choiceC, $choiceCIsCorrect);
    updateChoices($conn, $choiceDId, $choiceD, $choiceDIsCorrect);

    $_SESSION['msg'] = "taskupdated";
    
    header ("location: ../Main_Project/teacher/assets/header.view.php");
    header ("location: ../Main_Project/teacher/teacher.editTask.php?taskId=$taskId&&1");
    exit();

}

if(isset($_POST["createIdentfication_EditTask"])){
    $taskListId =  $_POST["createTaskId"];
    $questioner = $_POST['identificationInputQuestion'];
    $answerkey = $_POST['identificationInputAnswer'];
    $questionNumber = $_POST['createEditTaskQuestionCount'];

    ## check if the question exist -- comeback
    $questionExists = questionerExist($conn, $taskListId, $questioner);

    # Logic for next button -- comeback

    if($questionExists !== false){
        //$_SESSION['currentQuestion'] = $questionExists['question_id'];
        $_SESSION['msg'] = "questionertaken";
        header ("location: ../Main_Project/teacher/teacher.editTask.php?msg=questiontaken&&taskId=$taskListId");
        exit();
    }
    
    ## create question if not exist-- comeback
    createQuestion($conn, $taskListId, $questioner, $questionNumber);
    
    ## save the recentlyadded question
    $recentlyAdded = questionerExist($conn, $taskListId, $questioner);

    ## create answer
    createAnswer($conn, $recentlyAdded['question_id'], $answerkey);
    
    // update task question count
    updateTaskQuestionCount($conn, $taskListId, $questionNumber);

    $_SESSION['msg'] = "questionercreated";

    header ("location: ../Main_Project/teacher/assets/header.view.php");
    header ("location: ../Main_Project/teacher/teacher.editTask.php?taskId=$taskListId");
    exit();
}

if(isset($_POST['updateIdentification_EditTask'])){
    $taskId = $_POST['updateTaskId'];
    $questionerId = $_POST['identificationInputQuestionId'];
    $questioner = $_POST['identificationInputQuestion'];
    $answerId = $_POST['identificationInputId'];
    $answer = $_POST['identificationInputAnswer'];

    $questionExists = questionerExist($conn, $taskId, $questioner);
    $currentQuestion = getQuestionName($conn, $questionerId);
    
    # Logic for next button -- comeback
    if($currentQuestion['question_name'] == $questioner){
        # update quesitoner details
        updateIdentificationQuestion($conn, $questionerId, $questioner);
        updateIdentificationAnswer($conn, $answerId, $answer);
        $_SESSION['msg'] = "taskupdated";

        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.editTask.php?taskId=$taskId");
        exit();
    }

    if($questionExists !== false){
        $_SESSION['msg'] = "questionertaken";
        header ("location: ../Main_Project/teacher/teacher.editTask.php?taskId=$taskId");
        exit();
    }
    # update quesitoner details
    updateIdentificationQuestion($conn, $questionerId, $questioner);
    updateIdentificationAnswer($conn, $answerId, $answer);

    $_SESSION['msg'] = "taskupdated";
    
    header ("location: ../Main_Project/teacher/assets/header.view.php");
    header ("location: ../Main_Project/teacher/teacher.editTask.php?taskId=$taskId");
    exit();
}

if(isset($_POST['createTrueOrFalse_EditTask'])){
    if(isset($_POST['submissionchoice'])){
            $trueOrFalseAnswer = $_POST['submissionchoice'];
    } else{
        $trueOrFalseAnswer = "";
    }

    $taskId = $_POST["createTaskId"];  
    $trueOrFalseQuestion = $_POST["trueOrFalseInputQuestion"];
    $questionNumber = $_POST['createEditTaskQuestionCount'];

    # check if trueOrfalse  question exists?
    $questionExists = questionerExist($conn, $taskId, $trueOrFalseQuestion);

    if($questionExists !== false){
        $_SESSION['msg'] = "questionertaken";
        header ("location: ../Main_Project/teacher/teacher.editTask.php?msg=questiontaken&&taskId=$taskId");
        exit();
    }

    # sava the data to database then save answer
    createQuestion($conn, $taskId, $trueOrFalseQuestion ,$questionNumber);

    ## save the recentlyadded question id to session
    $recentlyAdded = questionerExist($conn, $taskId, $trueOrFalseQuestion);
    
    # save answer
    createAnswer($conn, $recentlyAdded['question_id'], $trueOrFalseAnswer);

    $_SESSION['msg'] = "questionercreated";
    updateTaskQuestionCount($conn, $taskId, $questionNumber);


    # head to next question if question count hasn't reach the target
    header ("location: ../Main_Project/teacher/assets/header.view.php");
    header ("location: ../Main_Project/teacher/teacher.editTask.php?taskId=$taskId");
    exit();
}

if(isset($_POST['updateTrueOrFalse_EditTask'])){
    $taskId = $_POST["createTaskId"];
    $questionID = $_POST["trueOrFalseQuestionerId"];
    $question = $_POST["trueOrFalseInputQuestion"];
    
    $answerID = $_POST["submissionChoiceId"];
    if(isset($_POST['submissionchoice'])){
        $answer = $_POST['submissionchoice'];
    } else{
        $answer = "";
    }

    $questionExists = questionerExist($conn, $taskId, $question);
    $currentQuestion = getQuestionName($conn, $questionID);

    // $_SESSION['updatingIdentification'];
    
    # check inputs
    # check fields if empty *****create function
    if($currentQuestion['question_name'] == $question){
        updateQuestion($conn, $questionID, $question);
        updateTrueOrFalseAnswer($conn, $answerID, $answer);
        $_SESSION['msg'] = "taskupdated";
        
        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.editTask.php?msg=questionupdated&&taskId=$taskId");
        exit();
    }

    if($questionExists !== false){
        $_SESSION['msg'] = "questionertaken";
        header ("location: ../Main_Project/teacher/teacher.editTask.php?msg=questiontaken&&taskId=$taskId");
        exit();
    }

    updateQuestion($conn, $questionID, $question);
    updateTrueOrFalseAnswer($conn, $_POST["submissionChoiceId"], $answer);
    $_SESSION['msg'] = "taskupdated";
    
    header ("location: ../Main_Project/teacher/assets/header.view.php");
    header ("location: ../Main_Project/teacher/teacher.editTask.php?msg=questionupdated&&taskId=$taskId");
    exit();
}

if(isset($_POST['updateEssay_EditTask'])){
    $teacherId = $_SESSION["teacher_id"];
    $subjectId = $_SESSION['subjectId'];
    $taskId = $_POST['updateTaskId'];
    
    $questionerId = $_POST['essayQuestionerId'];
    $questioner = $_POST['essayInputQuestion'];
    
    // $filepath = $_POST['essayInputFilepath'];
    
    // if ($filepath == "" || $filepath == null){
    // }
    $filepath = '../upload/' . $teacherId . $subjectId . $taskId;
    
    echo $filepath;
    
    $oldFilename = $_POST['essayOldInputFilename'];
    $newFilename = $_FILES['essayNewInputFile']['name'];
    $size = getFileSize($_FILES['essayNewInputFile']['size']);
    
    
   
    $questionExists = questionerExist($conn, $taskId, $questioner);
    $currentQuestion = getQuestionName($conn, $questionerId);
    
 
    // updating file
    if($size < 1000.0){
        if(!file_exists($filepath)){
            //create folder
            mkdir($filepath, 0777, true);
        } 
    
        $temp_file = $_FILES['essayNewInputFile']['tmp_name'];
       
        
        if($temp_file != ""){
            
            // concatinating the file
            $newfilepath = $filepath."/". $newFilename;
            
            if(move_uploaded_file($temp_file, $newfilepath)){
                
                updateEssayQuestion($conn, $questionerId, $questioner, $newFilename, $filepath);
                
                $_SESSION['msg'] = "taskupdated";
                
                // deleting file
                $removeFile =  $filepath."/". $oldFilename;
                $status = unlink($removeFile);
                            
                header ("location: ../Main_Project/teacher/assets/header.view.php");
                header ("location: ../Main_Project/teacher/teacher.editTask.php?taskId=$taskId");
                exit();
            } else{
            
                echo 'Upload error encounter : ' . $_FILES['essayNewInputFile']['error'];
            }
        }else{
                updateEssayQuestion($conn, $questionerId, $questioner, $oldFilename);
                
                $_SESSION['msg'] = "taskupdated";
                
                header ("location: ../Main_Project/teacher/assets/header.view.php");
                header ("location: ../Main_Project/teacher/teacher.editTask.php?taskId=$taskId");
                exit();
        
        }
    
      
    } else{
        echo 'File to Large';
    }
}
#endregion --- teacher.editTask.php end
# --- Updates ---end #

# --- Delete ---
if(isset($_POST['deleteModalTaskBtn'])){
    $taskId = $_POST["inputDeleteTaskId"];
    // echo $taskId;
    // echo 'inside the delete';
    //delete query
    // sql to delete a record
    $sql = "DELETE FROM task_list_tbl WHERE task_list_id = $taskId";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
        $_SESSION['msg'] = "taskDeleted";
    } else {
        echo "Error deleting record: " . $conn->error;  
        $_SESSION['msg'] = "taskDeletedFailed";
    }

    header ("location: ../Main_Project/teacher/assets/header.view.php");
    header ("location: ../Main_Project/teacher/teacher.subject.php");
    exit();

    $conn->close();

}

if(isset($_POST['deleteQuestion_EditTask'])){
    $taskId = $_POST['deleteTaskId'];
    $questionId = $_POST['inputDeleteTaskId'];
    $questionNumber = $_POST['deleteEditTaskQuestionCount'];

    deleteQuestion($conn, $questionId);
    
    $_SESSION['msg'] = "questionerdeleted";

    // update taski list question item
    updateTaskQuestionCount($conn, $taskId, ($questionNumber - 1));


    header ("location: ../Main_Project/teacher/assets/header.view.php");
    header ("location: ../Main_Project/teacher/teacher.editTask.php?taskId=$taskId");
    exit();

}
# --- Delete --- end #