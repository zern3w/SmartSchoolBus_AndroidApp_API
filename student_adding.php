<?php
require_once("config.php");

$student_firstname = $_POST['firstName'];
$student_lastname = $_POST['lastName'];
$student_nickname = $_POST['nickName'];
$mobile_tel = $_POST['phoneNum'];
$school_name = $_POST['schoolName'];
$gender = $_POST['gender'];
$photo = $_POST['photo'];
$parent_id = $_POST["parent_id"];
$driver_id = $_POST["driver_id"];

// $student_firstname = "test";
// $student_lastname = "test";
// $student_nickname = "NIXK";
// $mobile_tel = "tesst";
// $school_name = "YRC";
// $gender = "male";
// $photo = "";
// $parent_id = 102;
// $driver_id = 5;

try {
    
    $sql = "INSERT INTO student(student_firstname,student_lastname,student_nickname,mobile_tel,school_name,gender,photo,parent_id,driver_id) 
    VALUES ('$student_firstname','$student_lastname','$student_nickname','$mobile_tel','$school_name','$gender','$photo','$parent_id','$driver_id')";

    $conn -> exec($sql); // use exec() because no results are returned
    
    $response["status"] = 1;
	die(json_encode($response));
}

catch(PDOException $e) {
		$response["status"] = 0;
    $response["error_message"] = $e->getMessage();
    die(json_encode($response));
}

$conn = null;

?>