<?php 
	require 'DbConnect.php';

	if(isset($_POST['gradingId'])) {
		$db = new DbConnect;
		$conn = $db->connect();
		$gradingId = $_POST['gradingId'];
		$subjectId = $_POST['subjectId'];
		$stmt = $conn->prepare("SELECT * FROM module_section_tbl WHERE fk_grading_id = $gradingId AND fk_subject_list_id  = $subjectId");
		$stmt->execute();
		$moduleSection = $stmt->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($moduleSection);
	}

	function loadModuleSection() {
		$db = new DbConnect;
		$conn = $db->connect();

		$stmt = $conn->prepare("SELECT * FROM grading_tbl");
		$stmt->execute();
		$grading = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $grading;
	}

 ?>