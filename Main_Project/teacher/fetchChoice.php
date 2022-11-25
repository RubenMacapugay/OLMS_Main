<?php 
ini_set('display_errors', 1);
include ('../../includes/dbh.inc.php');
$id = $_POST["x"];

$choicesSql = "SELECT * FROM choices_tbl WHERE fk_question_id = {$id}";
$choicesResult = mysqli_query($conn, $choicesSql);
$choicesList = [];
$chocesIdList = [];
while($choiceRow = mysqli_fetch_array($choicesResult)){
     array_push($chocesIdList, $choiceRow['choices_id']);
     array_push($choicesList, $choiceRow['choices_name']);
}
$data['choiceA'] = $choicesList[0];
$data['choiceB'] = $choicesList[1];
$data['choiceC'] = $choicesList[2];
$data['choiceD'] = $choicesList[3];

$data['choiceAId'] = $chocesIdList[0];
$data['choiceBId'] = $chocesIdList[1];
$data['choiceCId'] = $chocesIdList[2];
$data['choiceDId'] = $chocesIdList[3];

echo json_encode($data);
