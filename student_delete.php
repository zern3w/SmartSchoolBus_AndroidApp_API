<?php
require_once("config.php");

$student_id = $_POST["student_id"];

// $student_id = 35;

try {

	$stmt = $conn->prepare("DELETE FROM student WHERE student_id = '$student_id' ");
	$stmt -> execute();
	$response['status'] = 1;
	die(json_encode($response));
}
catch(PDOException $e) {
	$response["status"] = 0;
	$response["error_message"] = $e->getMessage();
	die(json_encode($response));
}
$conn = null;

?>