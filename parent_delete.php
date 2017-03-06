<?php
require_once("config.php");

$parent_id = $_POST["parent_id"];

// $parent_id = 77;

try {

	$stmt = $conn->prepare("DELETE FROM parent WHERE parent_id = '$parent_id' ");
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