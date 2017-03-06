<?php
require_once("config.php");

$email = $_POST["email"];
$password = $_POST["password"];

// $email = "try@driver.com";
// $password = "123123";

try {

    $stmt = $conn->prepare("SELECT driver_id, password FROM drivers WHERE email = '$email' ");

    $stmt -> execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $row_count = $stmt->rowCount();

    if ($row_count == 1) {
           $pw =  $result['password'];

        if (password_verify($password, $pw)) {
            $response['status'] = 1;                            //   LOG-IN SUCCESSFULLY
            $response["driver_id"] =  $result['driver_id'];
            die(json_encode($response));
        } else {
            $response['status'] = 0;
            die(json_encode($response));
}
    } else {
        $response['status'] = 0;
        die(json_encode($response));
    }
}
catch(PDOException $e) {
    $response['status'] = 0;
    $response["error_message"] = $e->getMessage();
    die(json_encode($response));
}
$conn = null;

?>
