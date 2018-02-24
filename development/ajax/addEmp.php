<?php 
require_once 'config'; // The mysql database connection script
print_r($_REQUEST);
if(isset($_REQUEST['fullname'])){
	$fullname = $mysqli->real_escape_string($_GET['fullname']);
	$status = "0";
	$created = date("Y-m-d", strtotime("now"));

	$query="INSERT INTO employees(fullname,created_at)  VALUES ('$fullname', '$created')";
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

	$result = $mysqli->affected_rows;

	echo $json_response = json_encode($result);
	}
?>