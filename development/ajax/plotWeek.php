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
$sql = "SELECT WEEK(fulltimestamp,1) wk, DAY(fulltimestamp) inter, type, utility_code, sum(amount) amnt, count(amount) cnt FROM `transactions` WHERE type = 'DEBIT' and utility_code = '".$utility_code."' and MONTH(fulltimestamp) = ".$month." group by DAY(fulltimestamp)";
$query=mysqli_query($conn, $sql) or die(mysqli_error($conn).' '.$sql);
//print_r($sql);
	$rows = array();
	$data_amnt = array();
	$data_num = array();	
	$nested_amnt = array();
	$nested_cnt = array();
	$wk='';
	while( $rows=mysqli_fetch_assoc($query) ) {  // preparing an array
		
			if($wk != $rows['wk']){
				$wk = $rows['wk'];
				unset($data_amnt);
			}
			
			//$data_amnt[] = array ($rows['inter'], number_format((float)$rows['amnt'],0));
			//$data_num[] = array ($rows['inter'], number_format((float)$rows['cnt'],0));
			$data_amnt[] = array ($rows['inter'], $rows['amnt'],0);
			$data_num[] = array ($rows['inter'], $rows['cnt'],0);
			$nested_amnt[$wk] = $data_amnt;
			$nested_cnt[$wk] = $data_num;
		
	}
	$series_amnt = array();
	foreach ($nested_amnt as $key => $item){
		$series_amnt[][]=array("label"=>"Week ".$key,"data"=>$item);
		
	}
	$series_cnt = array();
	foreach ($nested_cnt as $key => $item){
		$series_cnt[][]=array("label"=>"Week ".$key,"data"=>$item);
		
	}
	
		
		
$json = array();
$json[]=$series_amnt;
$json[]=$series_cnt;	
 echo  json_encode($json);
 //echo $data;

?>
