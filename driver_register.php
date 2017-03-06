<?php
require_once("config.php");

$driver_firstname = $_POST['firstName'];
$driver_lastname = $_POST['lastName'];
$email = $_POST['email'];
$password = $_POST['password'];
$mobile_tel = $_POST['phoneNum'];
$plate_number = $_POST['plateNum'];
$gender = $_POST['gender'];
$photo = $_POST['photo'];

//		DELETE $password and CHANGE hash to password

// $driver_firstname = "test";
// $driver_lastname = "test";
// $email = "zer.nn3ww@gmail.com";
// $password = "11223344";
// $mobile_tel = "0897654321";
// $plate_number = "pa445";
// $gender = "female";
// $photo = "";

$hash = password_hash($password, PASSWORD_DEFAULT);

try {
	$stmt = $conn->prepare("SELECT * FROM driver WHERE email = '$email' ");

	$stmt -> execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$row_count = $stmt->rowCount();

	$stmt2 = $conn->prepare("SELECT * FROM driver WHERE plate_number = '$plate_number' ");

	$stmt2 -> execute();
	$result = $stmt2->fetch(PDO::FETCH_ASSOC);
	$row_count2 = $stmt2->rowCount();

	if ($row_count == 1) {
           $response["status"] = 2; // EMAIL IS DUPLICATE
       }else if ($row_count2 == 1){
	$response["status"] = 3; // PLATE NUMBER IS DUPLICATE
}else{
	$sql = "INSERT INTO driver(driver_firstname,driver_lastname,email,password,hash,mobile_tel,plate_number,gender,photo) 
	VALUES ('$driver_firstname','$driver_lastname','$email','$password','$hash','$mobile_tel','$plate_number','$gender','$photo')";

    $conn -> exec($sql); // use exec() because no results are returned
    
    $response["status"] = 1;

}
die(json_encode($response));
}

catch(PDOException $e) {
	$response["status"] = 0;
	$response["error_message"] = $e->getMessage();
	die(json_encode($response));
}

$conn = null;

?>
