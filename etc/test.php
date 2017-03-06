<?php
$DB_HOST = "localhost";
$DB_USERNAME = "root";
$DB_PASSWORD = "";
$DB_DATABASE = "iSchoolBus";
$username = 'zer.nnn@gmail.com';
$password = 'new1596321478';
// For brevity, code to establish a database connection has been left out

try {
	$conn = new PDO("mysql:host=$DB_HOST;dbname=$DB_DATABASE", $DB_USERNAME, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// A higher "cost" is more secure but consumes more processing power
$cost = 10;

// Create a random salt
$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');

// Prefix information about the hash so PHP knows how to verify it later.
// "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
$salt = sprintf("$2a$%02d$", $cost) . $salt;

// Value:
// $2a$10$eImiTXuWVxfM37uY4JANjQ==

// Hash the password with the salt
$hash = crypt($password, $salt);

$sql = "INSERT INTO user(username,hash,salt) VALUES ('$username','$hash','$salt')";

    $conn -> exec($sql); // use exec() because no results are returned
echo "success";

 }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }



?>