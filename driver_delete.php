<?php
require_once("config.php");

// $driver_id = $_POST["driver_id"];

$driver_id = 03;

try {

	$stmt = $conn->prepare("DELETE FROM driver WHERE driver_id = '$driver_id' ");
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