<?php
require_once("config.php");

$parent_firstname = $_POST['firstName'];
$parent_lastname = $_POST['lastName'];
$email = $_POST['email'];
$mobile_tel = $_POST['phoneNum'];
$gender = $_POST['gender'];
$photo = $_POST['photo'];
$driver_id = $_POST["driver_id"];

// $parent_firstname = "test";
// $parent_lastname = "test";
// $email = "testy2@test.com";
// $mobile_tel = "test";
// $gender = "Male";
// $photo = "";
// $driver_id = "12";

try {

	$stmt = $conn->prepare("SELECT * FROM parent WHERE email = '$email' ");

	$stmt -> execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$row_count = $stmt->rowCount();

	if ($row_count == 1) {
           $response["status"] = 2; // EMAIL IS DUPLICATE
    }else{
    $sql = "INSERT INTO parent(parent_firstname,parent_lastname,email,mobile_tel,gender,photo,driver_id) 
    VALUES ('$parent_firstname','$parent_lastname','$email','$mobile_tel','$gender','$photo','$driver_id')";

    $conn -> exec($sql); // use exec() because no results are returned
    
    $response["status"] = 1;
	
}
die(json_encode($response));
}

catch(PDOException $e) {
		// $response["message"] = $e->getMessage();
	$response["status"] = 0;
	die(json_encode($response));
}

$conn = null;

?>