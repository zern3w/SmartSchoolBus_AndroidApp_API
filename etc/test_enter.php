<?php
$username = 'zer.nnn@gmail.com';
$password = 'new1596321478';
$DB_HOST = "localhost";
$DB_USERNAME = "root";
$DB_PASSWORD = "";
$DB_DATABASE = "iSchoolBus";
// For brevity, code to establish a database connection has been left out

try {
	$conn = new PDO("mysql:host=$DB_HOST;dbname=$DB_DATABASE", $DB_USERNAME, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // echo "Connected successfully"; 

$sth = $conn->prepare('
  SELECT
    hash
  FROM user
  WHERE
    username = :username
  LIMIT 1
  ');

$sth->bindParam(':username', $username);

$sth->execute();

$user = $sth->fetch(PDO::FETCH_OBJ);

// Hashing the password with its hash as the salt returns the same hash
if ( hash_equals($user->hash, crypt($password, $user->hash)) ) {
  // Ok!
	echo "OKOKOKK";
} echo "failed";
}catch(PDOException $e)  {
    echo "Connection failed: " . $e->getMessage();
    }

?>