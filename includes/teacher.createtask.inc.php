<?php  session_start(); ?> 
<?php  
include_once 'dbh.inc.php';
include_once 'teacher.function.inc.php';


# -----CREATE TASK BUTTONS----- #
    if(isset($_POST["createEssay"])){
        $subjectId = $_POST["subjectid"];
        $grading = $_POST["grading"];
        $moduleSection = $_POST["moduleSection"];
        $taskname = $_POST["taskname"];
        $taskcontent = $_POST["taskcontent"];
        $tasktype = $_POST["tasktype"];
        $subtype = $_POST["subtype"];
        $datecreated = $_POST["datecreated"];
        $datedeadline = $_POST["datedeadline"];
        $time = $_POST["timelimit"];
        $maxscore = $_POST["maxscore"]; 
        $maxattempts = $_POST["maxattempts"];
        $allowlate = $_POST["submissionchoice"]; 
        
        
        # Error handlers
        if(emptyEssayTask($grading, $moduleSection, $taskname, $taskcontent, $tasktype, $subtype, $datecreated, $datedeadline, $time, $maxscore, $maxattempts, $allowlate) !== false){
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
        createNoQuestion($conn, $subjectId, $grading, $moduleSection, $taskname, $taskcontent, $tasktype, $subtype, $datecreated, $datedeadline, $time, $maxscore, $maxattempts, $allowlate);
        $_SESSION['msg'] = "taskcompleted";
        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.createtask.php?msg=taskessaycreated&&currentSubject=$subjectId");
        exit();
    }
    
    // creating Multiple Choice
    if(isset($_POST["createQuestionTask"])){
        $grading = $_POST["grading"];
        $moduleSection = $_POST["moduleSection"];
        $taskname = $_POST["taskname"];
        $questionitems = $_POST["questionitems"];
        $tasktype = $_POST["tasktype"];
        $subtype = $_POST["subtype"];
        $datecreated = $_POST["datecreated"];
        $datedeadline = $_POST["datedeadline"];
        $time = $_POST["timelimit"];
        $maxattempts = $_POST["maxattempts"];
        $allowlate = $_POST["submissionchoice"]; 

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
            header ("location: ../Main_Project/teacher/teacher.createtask.php?msg=tasknametaken&&currentSubject=$subjectId");
            exit();
        }

        # create the task - add max score
        createTask($conn, $subjectId, $grading, $moduleSection,  $taskname, $questionitems, $tasktype, $subtype, $datecreated, $datedeadline, $time, $maxattempts, $allowlate);
        
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
        $moduleSection = $_POST["moduleSection"];
        $taskname = $_POST["taskname"];
        $questionitems = $_POST["questionitems"]; 
        $tasktype = $_POST["tasktype"];
        $subtype = $_POST["subtype"];
        $datecreated = $_POST["datecreated"];
        $datedeadline = $_POST["datedeadline"];
        $time = $_POST["timelimit"];
        // $maxscore = $_POST["maxscore"]; THERES NO MAX SCORE
        $maxattempts = $_POST["maxattempts"];
        $allowlate = $_POST["submissionchoice"]; 

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
        createTask($conn, $subjectId, $grading, $moduleSection, $taskname, $questionitems, $tasktype, $subtype, $datecreated, $datedeadline, $time, $maxattempts, $allowlate);
        
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


    if(isset($_POST["createTrueOrFalse"])){
        $grading = $_POST["grading"];
        $moduleSection = $_POST["moduleSection"];
        $taskname = $_POST["taskname"];
        $questionitems = $_POST["questionitems"];
        $tasktype = $_POST["tasktype"];
        $subtype = $_POST["subtype"];
        $datecreated = $_POST["datecreated"];
        $datedeadline = $_POST["datedeadline"];
        $time = $_POST["timelimit"];
        $maxattempts = $_POST["maxattempts"];
        $allowlate = $_POST["submissionchoice"]; 

        $subjectId = $_POST["subjectid"];
        $_SESSION["subjectId"] = $_POST["subjectid"];
        if(isset($_SESSION["subjectId"])){
            $subjectId = $_SESSION["subjectId"];
        }else{
            $subjectId = $_POST["subjectid"];
        }
        
        # Error handlers
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
        createTask($conn, $subjectId, $grading, $moduleSection, $taskname, $questionitems, $tasktype, $subtype, $datecreated, $datedeadline, $time, $maxattempts, $allowlate);
        
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
        if(isset($_SESSION['gradingId'])){
            $gradingId = $_SESSION['gradingId'];
        }
        #error handlers
        // validate here

        # check if task is taken
        // validate here
        
        $id = createModuleSection($conn, $moduleSectionName, $moduleSectionDesc, $subjectId, $gradingId);
        unset($_SESSION['gradingId']);
        $_SESSION['moduleSectionCreated'] = 'yes';

        // echo 'ID: '.$id;
        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.subject.php");
        exit();
    }

    if(isset($_POST["createModuleSectionWithGrading"])){
        $moduleSectionName = $_POST['moduleSectionName'];
        $moduleSectionDesc = $_POST['moduleSectinDesc'];
        $subjectId = $_SESSION['subjectId'];
        $gradingId = $_POST['gradingModal'];


        # check if task is taken
        if(moduleNameExist($conn, $moduleSectionName, $subjectId, $gradingId) !== false){
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
# -----CREATE TASK BUTTONS-----end #

# --- Essay --- #
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
            header ("location: ../Main_Project/teacher/teacher.createquestioner.php?error=emptyinput");
            exit();
        }
        
        # Logic for next button -- comeback
        if($questionExists !== false){
            //$_SESSION['currentQuestion'] = $questionExists['question_id'];
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

        if(emptyInputQuestion($questioner, $answerselect, $choiceA, $choiceB, $choiceC, $choiceD) !== false){
            header ("location: ../Main_Project/teacher/teacher.createquestioner.php?error=emptyinput");
            exit();
        }
        
        # update quesitoner details
        updateAnswerKey($conn, $answerId, $answerselect);
        updateQuestion($conn, $questionerId, $questioner);
        updateChoices($conn, $choiceAId, $choiceA, $choiceAIsCorrect);
        updateChoices($conn, $choiceBId, $choiceB, $choiceBIsCorrect);
        updateChoices($conn, $choiceCId, $choiceC, $choiceCIsCorrect);
        updateChoices($conn, $choiceDId, $choiceD, $choiceDIsCorrect);

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
            header ("location: ../Main_Project/teacher/teacher.createidentification.php?error=emptyinput");
            exit();
        }

        # check if identification question exists?
        $identificationExists = questionerExist($conn, $taskId, $identificationQuestion);
        if($identificationExists !== false){
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
        $questionID = $_POST["identificationInputQuestionId"];
        $answerID = $_POST["identificationInputId"];
        $_SESSION['updatingIdentification'];
        
        # check inputs
        if(emptyInputIdentification($answer, $question) !== false){
            header ("location: ../Main_Project/teacher/teacher.createidentification.php?error=emptyinput");
            exit();
        }

        updateIdentificationQuestion($conn, $questionID, $question);
        updateIdentificationAnswer($conn, $answerID, $answer);

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
            header ("location: ../Main_Project/teacher/teacher.createTrueOrFalse.php?msg=emptyinput");
            exit();
        }

    
        # check if trueOrfalse  question exists?
        $trueOrFalseExists = questionerExist($conn, $taskId, $trueOrFalseQuestion);
        if($trueOrFalseExists !== false){
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

        // $_SESSION['updatingIdentification'];
        
        # check inputs
        # check fields if empty *****create function
        if(emptyInputTrueOrFalse($question, $answer) !== false){
            header ("location: ../Main_Project/teacher/teacher.createTrueOrFalse.php?msg=emptyinput");
            exit();
        }


        updateQuestion($conn, $questionID, $question);
        updateTrueOrFalseAnswer($conn, $_POST["submissionChoiceId"], $answer);
        
        header ("location: ../Main_Project/teacher/assets/header.view.php");
        header ("location: ../Main_Project/teacher/teacher.createTrueOrFalse.php?msg=updatesuccess&&test=$answer");
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
# --- Updates ---end #