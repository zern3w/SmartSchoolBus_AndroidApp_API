<?php
require_once("connect.php");
error_reporting( error_reporting() & ~E_NOTICE );
// $firstName = $_POST['firstName'];
// $lastName = $_POST['lastName'];
// $email = $_POST['email'];
// $password = $_POST['password'];
// $phoneNum = $_POST['phoneNum'];

$firstName = "4545";
$lastName = "4545";
$email = "4545";
$password = "4545";
$phoneNum = "4545";

$sql ="INSERT INTO driver (firstName,lastName,email,password,phoneNum)";
$sql .= "VALUES('$firstName','$lastName','$email','$password','$phoneNum')";
$result = mysql_query($sql,$link);

if($result){
	$json['status'] = 1;
	// $json['fname'] = $firstName;
	// $json['lname'] = $lastName;

	die (json_encode($json));

}else{
$json['status'] = 0;
// $json['fname'] = null;
// $json['lname'] = null;
die (json_encode($json));
}

?>

