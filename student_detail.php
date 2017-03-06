<?php
require_once("config.php");

$student_id = $_POST["student_id"];

// $student_id = 4;

try {

    $stmt = $conn->prepare("SELECT sbparents.phone as parent_phone, students.student_firstname, students.student_lastname, students.emergency_tel, students.phone, schools.school_name, students.student_nickname, sbparents.parent_firstname, sbparents.parent_lastname
        FROM students 
        INNER JOIN sbparents ON students.parent_id=sbparents.parent_id 
        INNER JOIN schools ON students.school_id=schools.school_id
        WHERE students.student_id = '$student_id' ");
    $stmt->execute();

// 
    // $stmt = $conn->prepare("SELECT student_id, student_firstname, student_lastname, student_nickname, school_name, mobile_tel, photo FROM students WHERE student_id = '$student_id' "); 

     //    $stmt = $conn->prepare("SELECT students.student_id, students.student_firstname, students.student_lastname, students.student_nickname, schools.school_name, students.phone, students.photo, students.emergency_tel, sbparents.phone 
    	// FROM students 
    	// INNER JOIN schools ON students.school_id=schools.school_id 
    	// INNER JOIN sbparents ON students.parent_id=sbparents.parent_id 
    	//  WHERE students.student_id = '$student_id' ");

	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // $response["success"] = 1;
	$response["student"] = $result;

	die(json_encode($response));    
}

catch(PDOException $e) {
	$response["success"] = 0;
	$response["message"] = "Error: ". $e->getMessage();
	die(json_encode($response));

}$conn = null;

?>
