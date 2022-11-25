<?php 
ini_set('display_errors',1); 
include ('../../includes/dbh.inc.php');
$id = $_POST["x"];

$answerSql = "SELECT * FROM answer_tbl WHERE fk_question_id = {$id}";
$answerResult = mysqli_query($conn, $answerSql);
while($answerRow = mysqli_fetch_array($answerResult)){
    // fetching the record $row = same from database
    $data['answerId'] = $answerRow['answer_id'];
    $data['answerKey'] = $answerRow['answer_key'];
}




echo json_encode($data);
