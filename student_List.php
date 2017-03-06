<?php
require_once("config.php");

$driver_id = $_POST["driver_id"];

 // $driver_id = 0;

try {

    $stmt = $conn->prepare("SELECT students.student_id, students.student_firstname, students.student_lastname, students.student_nickname, schools.school_name, students.phone, students.photo
    	FROM students 
    	INNER JOIN schools ON students.school_id=schools.school_id  
    	WHERE students.driver_id = '$driver_id' ");

    $stmt->execute();

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