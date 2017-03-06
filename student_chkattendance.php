<?php
require_once("config.php");

$student_id = $_POST["student_id"];
$driver_id = $_POST["driver_id"];

// $student_id = 108;
// $driver_id = 5;

try {
	$stmt = $conn->prepare("SELECT atd_status FROM attendance_reports WHERE student_id = '$student_id' ORDER BY atd_id DESC LIMIT 1");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
 $atdstatus = $result['atd_status'];
    if ($atdstatus == 1){
        $atdstatus = 0;
    }else if ($atdstatus == 0){
        $atdstatus = 1;
    }else $atdstatus = "error";

    $sql = "INSERT INTO attendance_reports(atd_status, student_id, driver_id) VALUES ('$atdstatus','$student_id', '$driver_id')";
    $conn -> exec($sql); // use exec() because no results are returned

    $stmt = $conn->prepare("SELECT sbparents.phone
        FROM students 
        INNER JOIN sbparents ON students.parent_id=sbparents.parent_id 
        WHERE students.student_id = '$student_id' ");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $tel = $result['phone'];

    if ($tel == null){
        $status = 0;
    }else $status = 1;
    
    $response["status"] = $status;
    $response["atdstatus"] = $atdstatus;
    $response["tel"] = $tel;
    die(json_encode($response));
}

catch(PDOException $e) {
    $response["status"] = 0;
    $response["message"] = "Error: ". $e->getMessage();
    die(json_encode($response));

}$conn = null;

//function getPreviousStatus(sID){return status;}

//functiion createAtdReport(status, sID){}

//function getParentTel(sID){return mobile;}

?>