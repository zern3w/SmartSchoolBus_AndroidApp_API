<?php
require_once("config.php");

$driver_id = $_POST['driver_id'];
$driver_firstname = $_POST['firstName'];
$driver_lastname = $_POST['lastName'];
$password = $_POST['password'];
$mobile_tel = $_POST['phoneNum'];
$photo = $_POST['photo'];

// $driver_id = 7;
// $driver_firstname = "test";
// $driver_lastname = "test";
// $password = "11223344";
// $mobile_tel = "0897654321";
// $photo = "";

$hash = password_hash($password, PASSWORD_DEFAULT);

try {
	$stmt = $conn->prepare("UPDATE driver SET driver_firstname = '$driver_firstname' ,
		driver_lastname = '$driver_lastname' , password = '$password' , hash = '$hash' ,
		mobile_tel = '$mobile_tel' , photo = '$photo' WHERE driver_id = '$driver_id' ");
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
