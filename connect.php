<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smartschoolbus";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
mysql_query("SET NAMES TIS620");
mysqli_set_charset($conn, "utf8");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
error_reporting(E_ALL ^ E_NOTICE);

?>