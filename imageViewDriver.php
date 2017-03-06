<?php
	$conn = mysql_connect("localhost", "root", "");
    mysql_select_db("smartschoolbus") or die(mysql_error());
    if(isset($_GET['image_id'])) {
        $sql = "SELECT photo FROM driver WHERE driver_id=" . $_GET['image_id'];
		$result = mysql_query("$sql") or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysql_error());
		$row = mysql_fetch_array($result);
		header('Content-Type:image/jpeg'); 
        echo base64_decode($row["photo"]);
	}
	mysql_close($conn);
?>