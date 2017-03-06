<?php
require_once("config.php");
$DB_HOST = "localhost";
$DB_USERNAME = "root";
$DB_PASSWORD = "";
$DB_DATABASE = "smartdb";
// $ptID = $_POST["ptID"];

$ptID = "2";

try {
	$conn = new PDO("mysql:host=$DB_HOST;dbname=$DB_DATABASE", $DB_USERNAME, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT prdes,prdate FROM prescription WHERE ptid = '$ptID' ");

    $stmt -> execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $row_count = $stmt->rowCount();

    $response["persciption"] = $result;

    die(json_encode($response));    
}
    
catch(PDOException $e) {
	$response["status"] = 0;
    die(json_encode($response));
}
$conn = null;




?>