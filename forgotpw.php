<?php
require_once("config.php");
require_once "Mail.php";

$email = $_POST['email'];
// $email = 'zer.n3w@gmail.com';

try {

    $stmt = $conn->prepare("SELECT * FROM driver WHERE email = '$email' ");

    $stmt -> execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $row_count = $stmt->rowCount();

    if ($row_count == 1) {
           $from = '<SmartSchoolBus>';
    $to = $email;
    $subject = 'SmartSchoolBus App Password Reset!';
    $Otp = random_string();

    $body = "Hello! We are SmartSchoolBus Application Team. We are here to help you. :)
    \nDon't worry about forgetting your password, all you have to do is:
    \n  1. Enter the OTP that we gave to you.
    2. Change your password.
    3. Enjoy. :)
    \n****** Your OTP is $Otp *******\n\nAll the best,\nThe SmartSchoolBus Team";

    $headers = array(
    'From' => $from,
    'To' => $to,
    'Subject' => $subject
    );

    $smtp = Mail::factory('smtp', array('host' => 'ssl://smtp.gmail.com','port' => '465','auth' => true,
                                    'username' => 'ischoolbusapp@gmail.com','password' => 'zErnEw159'
                                    ));

    $mail = $smtp->send($to, $headers, $body);

    if (PEAR::isError($mail)) {
        echo('<p>' . $mail->getMessage() . '</p>');
    } else {
     $response['status'] = 1;

    $stmt = $conn->prepare("UPDATE driver SET OTP = '$Otp'  WHERE email = '$email' ");
    $stmt -> execute();
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

function random_string() {
    $character_set_array = array();
    $character_set_array[] = array('count' => 6, 'characters' => 'abcdefghijklmnopqrstuvwxyz');
    $character_set_array[] = array('count' => 2, 'characters' => '0123456789');
    $temp_array = array();

    foreach ($character_set_array as $character_set) {
        for ($i = 0; $i < $character_set['count']; $i++) {
            $temp_array[] = $character_set['characters'][rand(0, strlen($character_set['characters']) - 1)];
        }
    }
    shuffle($temp_array);
    return implode('', $temp_array);
}

?>