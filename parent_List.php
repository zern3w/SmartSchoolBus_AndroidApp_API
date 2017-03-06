<?php
require_once("config.php");

// $driver_id = $_POST["driver_id"];

 $driver_id = 5;

try {

    $stmt = $conn->prepare("SELECT parent_id, parent_firstname, parent_lastname, mobile_tel, photo FROM parent WHERE driver_id = '$driver_id' "); 
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // $response["success"] = 1;
    $response["parent"] = $result;

    die(json_encode($response));    
}

catch(PDOException $e) {
    $response["success"] = 0;
    $response["message"] = "Error: ". $e->getMessage();
    die(json_encode($response));

}$conn = null;

?>
