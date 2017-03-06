<?php
require_once("config.php");

$email = $_POST["email"];
$newPassword = $_POST["newPassword"];

// $email = 'driver@test.com';
// $newPassword = "af4";

$hash = password_hash($newPassword, PASSWORD_DEFAULT);

try {

	$stmt = $conn->prepare("UPDATE driver SET password = '$newPassword' , hash = '$hash' WHERE email = '$email' ");
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
