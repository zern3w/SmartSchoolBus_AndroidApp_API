<?php
include("config.php");

// $email = $_POST['email'];
// $password = $_POST['password'];

$email = "zer.n3w@gmail.com";
$password = "1234";

try {
	$conn = new PDO("mysql:host=$DB_HOST;dbname=$DB_DATABASE", $DB_USERNAME, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM driver WHERE email='$email' AND password='$password'"); 
    $stmt->execute();
   
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $response["driver"] = $result;

    die(json_encode($response));
    
}
catch(PDOException $e) {

	$response["success"] = 0;
	$response["message"] = "Error: ". $e->getMessage();
	die(json_encode($response));

}


?>

