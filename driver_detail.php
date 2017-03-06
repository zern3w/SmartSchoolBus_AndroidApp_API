<?php
require_once("config.php");

$driver_id = $_POST["driver_id"];

// $driver_id = 0;

try {

    $stmt = $conn->prepare("SELECT driver_id, driver_firstname, driver_lastname, email, password, phone, platenum, photo FROM drivers WHERE driver_id = '$driver_id' "); 
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // $response["success"] = 1;
    $response["driver"] = $result;

    die(json_encode($response));    
}

catch(PDOException $e) {
    $response["success"] = 0;
    $response["message"] = "Error: ". $e->getMessage();
    die(json_encode($response));

}$conn = null;

?>
