<?php 
ini_set('display_errors',1);
include ('../../includes/dbh.inc.php');
$id = $_POST["x"];

$questionSql = "SELECT * FROM question_tbl WHERE question_id = {$id}";
$questionResult = mysqli_query($conn, $questionSql);

while($questionRow = mysqli_fetch_array($questionResult)){
    // fetching the record $row = same from database
    $data['questionId'] = $questionRow['question_id'];
    $data['questionerName'] = $questionRow['question_name'];
    $data['questionerNumber'] = $questionRow['question_number'];
}

echo json_encode($data);