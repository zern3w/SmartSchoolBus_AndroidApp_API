<?php
$link=mysql_connect("localhost","root","");
mysql_select_db("iSchoolBus",$link);
mysql_query("SET NAMES UTF8");
if (!$link) {
	echo "Connection Fail";
}

?>