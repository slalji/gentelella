<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "roots";
$dbname = "selcom_dashboard";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;
$utility_code = $requestData['utility_code'];
$month = $requestData['month'];
$sql = "SELECT DAY(fulltimestamp) onDay, type, utility_code, sum(amount) amnt, count(amount) cnt FROM `transactions` WHERE type = 'DEBIT' and utility_code = '".$utility_code."' and MONTH(fulltimestamp) = ".$month." group by DAY(fulltimestamp)";
$query=mysqli_query($conn, $sql) or die(mysqli_error($conn).' '.$sql);
//print_r($sql);
	$rows = array();
	$data_amnt = array();
	$data_num = array();	
	$nested_amnt = array();
	$nested_cnt = array();
	$wk='';
	while( $rows=mysqli_fetch_assoc($query) ) {  // preparing an array
			  
			$data_amnt[] = array ($rows['onDay'], $rows['amnt']);
			$data_num[] = array ($rows['onDay'], $rows['cnt']);
			 
	}
	 
	
		
		
$json = array();
$json[]=$data_amnt;
$json[]=$data_num;	
 echo  json_encode($json);
 //echo $data;

?>
