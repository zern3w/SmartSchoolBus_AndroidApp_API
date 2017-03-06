<?php
require_once("config.php");

$email = $_POST["email"];
$otp = $_POST["oneTimePw"];

// $email = 'zer.n3w@gmail.com';
// $otp = "ee4ol3bz";

try {

	$stmt = $conn->prepare("SELECT * FROM driver WHERE email = '$email' AND OTP = '$otp' ");

	$stmt -> execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$row_count = $stmt->rowCount();

	if ($row_count == 1) {
		$response["status"] = 1;
		die(json_encode($response));

	} else {
		$response['status'] = 0;
		die(json_encode($response));
	}
}
catch(PDOException $e) {
	$response["status"] = 0;
	$response["error_message"] = $e->getMessage();
	die(json_encode($response));
}
$conn = null;

?>